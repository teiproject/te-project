<?php

namespace App\Http\Controllers;

use App\Models\DemoApproval;
use App\Models\Invoice;
use App\Models\ProjectRequest;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectRequestController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $requests = ProjectRequest::latest()->paginate(12);

        return view('admin.requests.index', compact('requests'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'company' => ['nullable', 'string', 'max:255'],
            'service' => ['required', 'string', 'max:255'],
            'platform' => ['nullable', 'string', 'max:255'],
            'features' => ['nullable', 'array'],
            'features.*' => ['string', 'max:255'],
            'timeline_weeks' => ['required', 'integer', 'min:2', 'max:52'],
            'pages' => ['required', 'integer', 'min:1', 'max:100'],
            'budget_range' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:4000'],
        ]);

        [$basePrice, $estimatedPrice] = $this->calculatePrice($data);

        $projectRequest = ProjectRequest::create($data + [
            'user_id' => auth()->id(),
            'reference' => 'TE-'.now()->format('ymd').'-'.Str::upper(Str::random(5)),
            'base_price' => $basePrice,
            'estimated_price' => $estimatedPrice,
            'status' => 'submitted',
        ]);

        $quotation = Quotation::create([
            'project_request_id' => $projectRequest->id,
            'quote_number' => 'QTE-'.now()->format('ymd').'-'.$projectRequest->id,
            'line_items' => [
                ['label' => $projectRequest->service.' discovery and build', 'amount' => $basePrice],
                ['label' => 'Selected feature modules', 'amount' => max(0, $estimatedPrice - $basePrice)],
            ],
            'subtotal' => $estimatedPrice,
            'tax' => 0,
            'total' => $estimatedPrice,
            'status' => 'sent',
            'valid_until' => now()->addDays(14),
        ]);

        Invoice::create([
            'project_request_id' => $projectRequest->id,
            'quotation_id' => $quotation->id,
            'invoice_number' => 'INV-'.now()->format('ymd').'-'.$projectRequest->id,
            'amount' => $estimatedPrice,
            'advance_amount' => $projectRequest->advanceAmount(),
            'status' => 'awaiting_demo_approval',
            'due_date' => now()->addDays(7),
        ]);

        DemoApproval::create([
            'project_request_id' => $projectRequest->id,
            'status' => 'pending',
        ]);

        session(['last_project_request_id' => $projectRequest->id]);

        return redirect()->route('project.requests.show', $projectRequest)->with('success', 'Project request submitted. Your quotation and 30% advance invoice are ready.');
    }

    public function show(ProjectRequest $projectRequest)
    {
        $this->authorizeAccess($projectRequest);
        $projectRequest->load(['quotation', 'invoice', 'payments', 'demoApproval']);

        return view('project-requests.show', compact('projectRequest'));
    }

    public function approveDemo(Request $request, ProjectRequest $projectRequest)
    {
        $this->authorizeAccess($projectRequest);
        $data = $request->validate(['client_feedback' => ['nullable', 'string', 'max:2000']]);

        $projectRequest->update([
            'status' => 'demo_approved',
            'demo_approved_at' => now(),
        ]);

        $projectRequest->demoApproval()->updateOrCreate(
            ['project_request_id' => $projectRequest->id],
            ['status' => 'approved', 'client_feedback' => $data['client_feedback'] ?? null, 'approved_at' => now()]
        );

        $projectRequest->invoice?->update(['status' => 'advance_due']);

        return redirect()->route('payments.checkout', $projectRequest)->with('success', 'Demo approved. You can now pay the 30% advance securely with Razorpay.');
    }

    public function adminUpdate(Request $request, ProjectRequest $projectRequest)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);
        $data = $request->validate([
            'status' => ['required', 'string', 'max:255'],
            'demo_url' => ['nullable', 'url', 'max:2048'],
        ]);

        $projectRequest->update([
            'status' => $data['status'],
            'demo_submitted_at' => $data['status'] === 'demo_submitted' ? now() : $projectRequest->demo_submitted_at,
        ]);

        if (! empty($data['demo_url'])) {
            $projectRequest->demoApproval()->updateOrCreate(
                ['project_request_id' => $projectRequest->id],
                ['demo_url' => $data['demo_url'], 'status' => 'pending']
            );
        }

        return back()->with('success', 'Project workflow updated.');
    }

    private function authorizeAccess(ProjectRequest $projectRequest): void
    {
        if (auth()->check() && (auth()->user()->isAdmin() || $projectRequest->user_id === auth()->id())) {
            return;
        }

        if (! auth()->check() && session('last_project_request_id') === $projectRequest->id) {
            return;
        }

        abort(403);
    }

    private function calculatePrice(array $data): array
    {
        $base = match ($data['service']) {
            'Custom Web Application' => 180000,
            'Mobile App Development' => 240000,
            'CRM / ERP Solution' => 320000,
            'SaaS Product MVP' => 420000,
            default => 120000,
        };

        $features = count($data['features'] ?? []);
        $estimated = $base + ($features * 35000) + ((int) $data['pages'] * 5000);

        if ((int) $data['timeline_weeks'] <= 4) {
            $estimated = (int) round($estimated * 1.15);
        }

        return [$base, $estimated];
    }
}

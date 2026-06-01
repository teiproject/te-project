<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function checkout(ProjectRequest $projectRequest)
    {
        $this->authorizePayment($projectRequest);
        $projectRequest->load(['invoice', 'demoApproval']);
        abort_unless($projectRequest->demoApproval?->status === 'approved', 403, 'Please approve the demo before payment.');

        return view('payments.checkout', compact('projectRequest'));
    }

    public function initiate(Request $request, ProjectRequest $projectRequest)
    {
        $this->authorizePayment($projectRequest);
        abort_unless($projectRequest->demoApproval?->status === 'approved', 403);

        $payment = Payment::create([
            'project_request_id' => $projectRequest->id,
            'invoice_id' => $projectRequest->invoice?->id,
            'provider' => 'razorpay',
            'provider_order_id' => 'order_TE_'.Str::upper(Str::random(10)),
            'amount' => $projectRequest->invoice?->advance_amount ?? $projectRequest->advanceAmount(),
            'currency' => 'INR',
            'status' => 'initiated',
            'metadata' => ['mode' => 'sandbox-ready', 'note' => 'Replace simulated confirmation with Razorpay signature verification in production.'],
        ]);

        return view('payments.razorpay', compact('projectRequest', 'payment'));
    }

    public function confirm(Request $request, Payment $payment)
    {
        $projectRequest = $payment->projectRequest;
        $this->authorizePayment($projectRequest);

        $payment->update([
            'provider_payment_id' => 'pay_TE_'.Str::upper(Str::random(10)),
            'status' => 'paid',
            'metadata' => array_merge($payment->metadata ?? [], ['confirmed_at' => now()->toDateTimeString()]),
        ]);

        $projectRequest->update(['status' => 'advance_paid']);
        $projectRequest->invoice?->update(['status' => 'advance_paid']);

        return redirect()->route('project.requests.show', $projectRequest)->with('success', '30% advance payment marked as paid. Production Razorpay keys can be enabled from .env.');
    }

    private function authorizePayment(ProjectRequest $projectRequest): void
    {
        abort_unless(auth()->check() && (auth()->user()->isAdmin() || $projectRequest->user_id === auth()->id()), 403);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\ProjectRequest;

class DashboardController extends Controller
{
    public function client()
    {
        $requests = auth()->user()->projectRequests()->with(['quotation', 'invoice', 'demoApproval'])->latest()->get();
        $stats = [
            'active' => $requests->whereNotIn('status', ['completed', 'cancelled'])->count(),
            'awaiting_approval' => $requests->where('status', 'demo_submitted')->count(),
            'advance_due' => $requests->filter(fn ($request) => $request->invoice?->status === 'advance_due')->count(),
        ];

        return view('dashboard.client', compact('requests', 'stats'));
    }

    public function admin()
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $requests = ProjectRequest::with(['quotation', 'invoice', 'demoApproval'])->latest()->get();
        $payments = Payment::latest()->take(8)->get();
        $stats = [
            'requests' => $requests->count(),
            'approved_demos' => $requests->where('status', 'demo_approved')->count(),
            'revenue' => $payments->where('status', 'paid')->sum('amount'),
            'pending_advances' => $requests->filter(fn ($request) => $request->invoice?->status === 'advance_due')->count(),
        ];

        return view('dashboard.admin', compact('requests', 'payments', 'stats'));
    }
}

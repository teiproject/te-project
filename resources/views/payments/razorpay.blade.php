@extends('layouts.app')
@section('title', 'Razorpay Payment')
@section('content')
<section class="section-pad"><div class="container"><div class="row justify-content-center"><div class="col-lg-7"><div class="trust-card p-4"><span class="badge-soft">Razorpay sandbox-ready</span><h1 class="fw-bold text-trust mt-3">Complete payment</h1><p class="text-secondary">Order {{ $payment->provider_order_id }} has been created. Add production Razorpay keys and signature verification before going live.</p><div class="invoice-box mb-4"><div class="d-flex justify-content-between"><span>Amount</span><strong>₹{{ number_format($payment->amount) }}</strong></div><div class="d-flex justify-content-between"><span>Currency</span><strong>{{ $payment->currency }}</strong></div></div><form method="post" action="{{ route('payments.confirm',$payment) }}">@csrf<button class="btn btn-primary btn-lg rounded-pill px-5">Simulate Successful Razorpay Payment</button></form></div></div></div></div></section>
@endsection

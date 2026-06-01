@extends('layouts.app')
@section('title', 'Payment Checkout')
@section('content')
<section class="section-pad"><div class="container"><div class="row justify-content-center"><div class="col-lg-7"><div class="trust-card p-4"><span class="badge-soft">30% advance payment flow</span><h1 class="fw-bold text-trust mt-3">Razorpay checkout</h1><p class="text-secondary">Your demo is approved. Pay the advance to move the project into active development.</p><div class="invoice-box mb-4"><div class="d-flex justify-content-between"><span>Project</span><strong>{{ $projectRequest->reference }}</strong></div><div class="d-flex justify-content-between"><span>Advance amount</span><strong>₹{{ number_format($projectRequest->invoice->advance_amount) }}</strong></div></div><form method="post" action="{{ route('payments.initiate',$projectRequest) }}">@csrf<button class="btn btn-primary btn-lg rounded-pill px-5">Proceed to Razorpay</button></form></div></div></div></div></section>
@endsection

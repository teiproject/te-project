@extends('layouts.app')
@section('title', 'Contact')
@section('content')
<section class="section-pad">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-5"><span class="badge-soft">Contact / request demo</span><h1 class="display-5 fw-bold text-trust mt-3">Tell us what you want to launch.</h1><p class="lead text-secondary">Use the request form to book a discovery call, request a product demo or submit a high-level software idea.</p><div class="trust-card p-4 mt-4"><strong>Email</strong><p class="mb-2 text-secondary">hello@trustedgeinfotech.com</p><strong>Response time</strong><p class="mb-0 text-secondary">Within one business day</p></div></div>
            <div class="col-lg-7">@include('partials.quick-request-form')</div>
        </div>
    </div>
</section>
@endsection

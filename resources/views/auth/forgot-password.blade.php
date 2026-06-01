@extends('layouts.app')
@section('title', 'Forgot Password')
@section('content')
<section class="section-pad"><div class="container"><div class="row justify-content-center"><div class="col-md-6"><form class="trust-card p-4" method="post" action="{{ route('password.email') }}">@csrf<h1 class="fw-bold text-trust">Forgot password</h1><p class="text-secondary">Enter your email and we will send a reset link.</p><input type="email" name="email" class="form-control mb-3" required><button class="btn btn-primary rounded-pill px-4">Send reset link</button></form></div></div></div></section>
@endsection

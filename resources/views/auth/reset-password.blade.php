@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')
<section class="section-pad"><div class="container"><div class="row justify-content-center"><div class="col-md-6"><form class="trust-card p-4" method="post" action="{{ route('password.update') }}">@csrf<h1 class="fw-bold text-trust">Reset password</h1><input type="hidden" name="token" value="{{ $token }}"><label class="form-label">Email</label><input type="email" name="email" value="{{ $email }}" class="form-control mb-3" required><label class="form-label">Password</label><input type="password" name="password" class="form-control mb-3" required><label class="form-label">Confirm password</label><input type="password" name="password_confirmation" class="form-control mb-3" required><button class="btn btn-primary rounded-pill px-4">Reset password</button></form></div></div></div></section>
@endsection

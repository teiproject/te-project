@extends('layouts.app')
@section('title', 'Project Builder')
@section('content')
<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <span class="badge-soft">Project request submission flow</span>
                <h1 class="display-5 fw-bold text-trust mt-3">Build your project brief and get a live quotation.</h1>
                <form data-calculator class="trust-card p-4 mt-4" method="post" action="{{ route('project.requests.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Name</label><input name="client_name" value="{{ old('client_name', auth()->user()->name ?? '') }}" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label">Phone</label><input name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Company</label><input name="company" value="{{ old('company', auth()->user()->company ?? '') }}" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Service</label><select name="service" class="form-select" required>@foreach(['Custom Web Application','Mobile App Development','CRM / ERP Solution','SaaS Product MVP','Website & Landing System'] as $service)<option>{{ $service }}</option>@endforeach</select></div>
                        <div class="col-md-6"><label class="form-label">Platform</label><select name="platform" class="form-select"><option>Web</option><option>Web + Mobile</option><option>API + Admin Panel</option><option>Enterprise Portal</option></select></div>
                        <div class="col-md-6"><label class="form-label">Timeline in weeks</label><input type="number" min="2" max="52" name="timeline_weeks" value="4" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label">Estimated pages/screens</label><input type="number" min="1" max="100" name="pages" value="8" class="form-control" required></div>
                        <div class="col-12"><label class="form-label">Feature modules</label><div class="row g-2">@foreach(['Login & roles','Admin dashboard','Client dashboard','Payments','Reports','Notifications','API integrations','Quotation & invoice'] as $feature)<div class="col-sm-6"><label class="form-check trust-card p-3"><input class="form-check-input" type="checkbox" name="features[]" value="{{ $feature }}"> <span class="form-check-label">{{ $feature }}</span></label></div>@endforeach</div></div>
                        <div class="col-md-6"><label class="form-label">Budget range</label><input name="budget_range" class="form-control" placeholder="₹2L - ₹5L"></div>
                        <div class="col-12"><label class="form-label">Project goals</label><textarea name="message" rows="5" class="form-control" placeholder="Tell us about your goals, users and business workflow.">{{ old('message') }}</textarea></div>
                        <div class="col-12"><button class="btn btn-primary btn-lg rounded-pill px-5">Submit Request</button></div>
                    </div>
                </form>
            </div>
            <div class="col-lg-5">
                <div class="calculator-panel trust-card p-4">
                    <span class="badge-soft">Live price calculator</span>
                    <h2 class="fw-bold text-trust mt-3" data-price-output>₹0</h2>
                    <p class="text-secondary">Indicative project estimate based on service, modules, timeline and screens.</p>
                    <div class="invoice-box"><div class="d-flex justify-content-between"><span>30% advance after demo approval</span><strong data-advance-output>₹0</strong></div><hr><p class="small text-secondary mb-0">Payment is requested only after the demo approval workflow is completed.</p></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

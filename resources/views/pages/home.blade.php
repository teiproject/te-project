@extends('layouts.app')
@section('title', 'Home')
@section('content')
<section class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="badge-soft">Premium Laravel & business software agency</span>
                <h1 class="display-4 fw-bold mt-4 text-trust">Secure software systems that move your business faster.</h1>
                <p class="lead text-secondary mt-3">TrustEdge Infotech builds modern web applications, SaaS MVPs, CRM/ERP platforms and mobile experiences with transparent quotations, demo approval and Razorpay-ready advance payment workflows.</p>
                <div class="d-flex flex-column flex-sm-row gap-3 mt-4">
                    <a class="btn btn-primary btn-lg rounded-pill px-4" href="{{ route('project.builder') }}">Create Live Estimate</a>
                    <a class="btn btn-outline-primary btn-lg rounded-pill px-4" href="{{ route('contact') }}">Request Demo</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-card p-4 p-lg-5">
                    <div class="d-flex justify-content-between align-items-center mb-4"><h3 class="fw-bold text-trust mb-0">Project command center</h3><span class="status-pill">Live</span></div>
                    <div class="row g-3">
                        <div class="col-6"><div class="metric"><small class="text-secondary">Demo workflow</small><h4 class="fw-bold mb-0">Approve → Pay</h4></div></div>
                        <div class="col-6"><div class="metric"><small class="text-secondary">Advance</small><h4 class="fw-bold mb-0">30%</h4></div></div>
                        <div class="col-12"><div class="invoice-box"><div class="d-flex justify-content-between"><span>Quotation</span><strong>QTE-ready</strong></div><hr><div class="d-flex justify-content-between"><span>Razorpay checkout</span><strong class="text-primary">Enabled</strong></div></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-pad">
    <div class="container">
        <div class="row text-center mb-5"><div class="col-lg-8 mx-auto"><span class="badge-soft">Services</span><h2 class="section-title fw-bold mt-3">Built for professional teams that need reliability.</h2></div></div>
        <div class="row g-4">
            @foreach(['Custom Web Application'=>'Tailored Laravel portals, marketplaces and operations platforms.','Mobile App Development'=>'API-first mobile product builds with scalable backend panels.','CRM / ERP Solution'=>'Sales, inventory, finance and team workflows in one system.','SaaS Product MVP'=>'Launch subscription-ready SaaS products with dashboards and billing flows.'] as $name => $copy)
                <div class="col-md-6 col-xl-3"><div class="trust-card h-100 p-4"><div class="service-icon mb-3">↗</div><h5 class="fw-bold text-trust">{{ $name }}</h5><p class="text-secondary mb-0">{{ $copy }}</p></div></div>
            @endforeach
        </div>
    </div>
</section>
<section class="section-pad bg-white">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-5"><span class="badge-soft">Workflow</span><h2 class="section-title fw-bold mt-3">From idea to invoice without confusion.</h2><p class="text-secondary">Every request creates an estimate, quotation, invoice and demo approval checkpoint before collecting a 30% advance.</p></div>
            <div class="col-lg-7"><div class="row g-3">
                @foreach(['Submit requirements','Receive quotation','Review demo','Approve and pay 30% advance'] as $i => $step)
                    <div class="col-md-6"><div class="workflow-step trust-card p-4 h-100" data-step="{{ $i+1 }}"><h5 class="fw-bold">{{ $step }}</h5><p class="text-secondary mb-0">Transparent status tracking in the client and admin dashboards.</p></div></div>
                @endforeach
            </div></div>
        </div>
    </div>
</section>
@endsection

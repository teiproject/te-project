@extends('layouts.app')
@section('title', 'Services')
@section('content')
<section class="section-pad">
    <div class="container">
        <div class="row mb-5"><div class="col-lg-8"><span class="badge-soft">What we build</span><h1 class="display-5 fw-bold text-trust mt-3">End-to-end software delivery for growth teams.</h1><p class="lead text-secondary">Choose a focused module or combine discovery, UX, development, integrations and long-term support.</p></div></div>
        <div class="row g-4">
            @foreach([
                ['Custom Web Application','Laravel platforms, dashboards, booking systems and workflow automation.'],
                ['CRM / ERP Solution','Lead pipelines, inventory, finance approvals and role-based reports.'],
                ['SaaS Product MVP','Multi-tenant architecture, onboarding flows and subscription-ready foundations.'],
                ['Mobile App Development','Mobile APIs, admin panels and launch-ready app backend infrastructure.'],
                ['Cloud & DevOps','Deployment, backups, queue workers, observability and performance hardening.'],
                ['UI/UX Design','Premium responsive Blade interfaces with conversion-focused journeys.']
            ] as $service)
            <div class="col-md-6 col-lg-4"><div class="trust-card p-4 h-100"><div class="service-icon mb-3">✓</div><h4 class="fw-bold text-trust">{{ $service[0] }}</h4><p class="text-secondary">{{ $service[1] }}</p><a href="{{ route('project.builder') }}" class="fw-bold text-decoration-none">Estimate this service →</a></div></div>
            @endforeach
        </div>
    </div>
</section>
@endsection

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TrustEdge Infotech') | Premium Software Agency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top trust-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}"><span class="brand-mark">TE</span> TrustEdge Infotech</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"><span class="navbar-toggler-icon"></span></button>
        <div id="mainNav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="{{ route('services') }}">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('project.builder') }}">Project Builder</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Request Demo</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('client.dashboard') }}">Dashboard</a></li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post">@csrf<button class="btn btn-sm btn-outline-primary rounded-pill">Logout</button></form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="btn btn-primary rounded-pill px-4" href="{{ route('register') }}">Start Project</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<main class="page-shell">
    @include('partials.flash')
    @yield('content')
</main>
<footer class="footer-cta text-white">
    <div class="container py-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-8"><h2 class="fw-bold mb-2">Ready to build dependable software?</h2><p class="mb-0 text-white-50">TrustEdge Infotech designs secure, scalable web apps, SaaS products, CRM/ERP platforms and mobile experiences.</p></div>
            <div class="col-lg-4 text-lg-end"><a href="{{ route('project.builder') }}" class="btn btn-light rounded-pill px-4">Build My Quote</a></div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

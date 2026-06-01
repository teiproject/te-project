<div class="container flash-zone">
    @if(session('success'))<div class="alert alert-success shadow-sm">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="alert alert-danger shadow-sm"><strong>Please fix:</strong><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
</div>

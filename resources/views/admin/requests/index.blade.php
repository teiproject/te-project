@extends('layouts.app')
@section('title', 'Project Requests')
@section('content')
<section class="section-pad"><div class="container"><h1 class="fw-bold text-trust">All project requests</h1><div class="trust-card p-4"><div class="table-responsive"><table class="table"><thead><tr><th>Reference</th><th>Client</th><th>Service</th><th>Status</th><th>Total</th></tr></thead><tbody>@foreach($requests as $request)<tr><td><a href="{{ route('project.requests.show',$request) }}">{{ $request->reference }}</a></td><td>{{ $request->client_name }}</td><td>{{ $request->service }}</td><td>{{ $request->status }}</td><td>₹{{ number_format($request->estimated_price) }}</td></tr>@endforeach</tbody></table></div>{{ $requests->links() }}</div></div></section>
@endsection

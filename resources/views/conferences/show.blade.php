@extends('layout.app')

@section('content')
<div class="container conference-details">
	<h1 class="conference-title">{{ $conference['title'] }}</h1>
	<p class="conference-date"><strong>Date:</strong> {{ $conference['date'] }}</p>
	<p class="conference-status"><strong>Status:</strong> {{ $conference['status'] }}</p>

	@if(session('user_role') === 'Employee' || session('user_role') === 'Admin')
	<h2 class="registered-clients-title">Registered Clients</h2>
	@if(isset($conference['registered_clients']) && count($conference['registered_clients']) > 0)
	<ul class="list-group registered-clients-list">
		@foreach ($conference['registered_clients'] as $index => $client)
		<li class="list-group-item">
			{{ $index + 1 }}. {{ $client['name'] }} {{ $client['surname'] }}
		</li>
		@endforeach
	</ul>
	@else
	<p>No registered clients for this conference.</p>
	@endif
	@elseif(session('user_role') === 'Client')
	<p class="permission-warning">You do not have permission to view registered clients for this conference.</p>
	@endif
</div>
@endsection
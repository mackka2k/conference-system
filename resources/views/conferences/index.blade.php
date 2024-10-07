@extends('layout.app')

@section('content')
<h2 class="conferences-title">Conferences</h2>

<div class="container">
	<!-- Display success message -->
	@if (session('success'))
	<p class="text-success">{{ session('success') }}</p>
	@endif

	<!-- Display error message -->
	@if (session('error'))
	<p class="text-danger">{{ session('error') }}</p>
	@endif

	<!-- Client Role Section -->
	@if (session('user_role') === 'Client')
	@foreach($conferences as $conference)
	@if(isset($conference['status']) && $conference['status'] === 'scheduled')
	<div class="conference-card">
		<h3 class="conference-title">{{ $conference['title'] }}</h3>
		<p class="conference-date">{{ $conference['date'] }}</p>
		<form action="{{ route('conference.register', $loop->index) }}" method="POST" class="registration-form">
			@csrf
			<input type="text" name="client_name" placeholder="Your Name" required class="form-input">
			<input type="text" name="client_surname" placeholder="Your Surname" required class="form-input">
			<input type="email" name="client_email" placeholder="Your Email" required class="form-input">
			<button type="submit" class="btn mb-2 btn-register">Register</button>
		</form>
		<a href="{{ route('conferences.show', $conference['id']) }}" class="btn btn-secondary">Preview</a>
	</div>
	@endif
	@endforeach

	<!-- Employee Role Section -->
	@elseif (session('user_role') === 'Employee')
	@foreach($conferences as $conference)
	<div class="conference-card">
		<h3 class="conference-title">{{ $conference['title'] }}</h3>
		<p class="conference-date">{{ $conference['date'] }} - {{ $conference['status'] ?? 'Unknown Status' }}</p>
		<p class="registered-clients">Registered Clients: {{ isset($conference['registered_clients']) ?
			count($conference['registered_clients']) : 0 }}</p>
		<a href="{{ route('conferences.show', $conference['id']) }}" class="btn btn-secondary">Preview</a>
	</div>
	@endforeach

	<!-- Admin Role Section -->
	@elseif (session('user_role') === 'Admin')
	<a href="{{ route('conference.create') }}" class="btn btn-secondary mb-3">Create New Conference</a>
	@foreach($conferences as $conference)
	<div class="conference-card">
		<h3 class="conference-title">{{ $conference['title'] }}</h3>
		<p class="conference-date">{{ $conference['date'] }} - {{ $conference['status'] ?? 'Unknown Status' }}</p>
		<p class="registered-clients">Registered Clients: {{ isset($conference['registered_clients']) ?
			count($conference['registered_clients']) : 0 }}</p>
		<a href="{{ route('conferences.show', $conference['id']) }}" class="btn btn-secondary">Preview</a>
		<a href="{{ route('conference.edit', $conference['id']) }}" class="btn btn-edit">Edit</a>
		<form method="POST" action="{{ route('conference.destroy', $conference['id']) }}"
			onsubmit="return confirm('Are you sure you want to delete this conference?');" class="delete-form">
			@csrf
			@method('DELETE')
			<button type="submit" class="btn btn-delete">Delete</button>
		</form>
	</div>
	@endforeach

	@else
	<p>Please select a role to view content.</p>
	@endif
</div>
@endsection
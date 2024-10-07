@extends('layout.app')

@section('content')
<h2 class="create-conference-title">Create New Conference</h2>

@if (session('success'))
<p class="text-success">{{ session('success') }}</p>
@endif

<form action="{{ route('conference.store') }}" method="POST" class="conference-form">
	@csrf
	<div class="mb-3">
		<label for="title" class="form-label">Conference Title</label>
		<input type="text" class="form-control" id="title" name="title" required>
	</div>
	<div class="mb-3">
		<label for="date" class="form-label">Date</label>
		<input type="date" class="form-control" id="date" name="date" required>
	</div>
	<div class="mb-3">
		<label for="status" class="form-label">Status</label>
		<select class="form-select" id="status" name="status" required>
			<option value="scheduled">Scheduled</option>
			<option value="completed">Completed</option>
			<option value="canceled">Canceled</option>
		</select>
	</div>
	<button type="submit" class="btn btn-primary">Create Conference</button>
</form>

@endsection
@extends('layout.app')

@section('content')
<h2 class="edit-conference-title">Edit Conference</h2>

@if (session('success'))
<p class="text-success">{{ session('success') }}</p>
@endif

@if (session('error'))
<p class="text-danger">{{ session('error') }}</p>
@endif

<form action="{{ route('conference.update', $conference['id']) }}" method="POST" class="conference-form">
	@csrf
	<div class="mb-3">
		<label for="title" class="form-label">Conference Title</label>
		<input type="text" class="form-control" id="title" name="title" value="{{ $conference['title'] }}" required>
	</div>
	<div class="mb-3">
		<label for="date" class="form-label">Date</label>
		<input type="date" class="form-control" id="date" name="date" value="{{ $conference['date'] }}" required>
	</div>
	<div class="mb-3">
		<label for="status" class="form-label">Status</label>
		<select class="form-select" id="status" name="status" required>
			<option value="scheduled" {{ $conference['status']==='scheduled' ? 'selected' : '' }}>Scheduled</option>
			<option value="completed" {{ $conference['status']==='completed' ? 'selected' : '' }}>Completed</option>
			<option value="canceled" {{ $conference['status']==='canceled' ? 'selected' : '' }}>Canceled</option>
		</select>
	</div>
	<button type="submit" class="btn btn-primary">Update Conference</button>
</form>

@endsection
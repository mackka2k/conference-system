@extends('layout.app')

@section('content')
<h2 class="role-heading text-center mb-4">Select Your Role</h2>

<div class="d-flex justify-content-center">
	<form method="POST" action="{{ route('setUserRole') }}" class="role-form p-4 rounded shadow-sm bg-light">
		@csrf
		<div class="form-group mb-3">
			<label for="role" class="form-label" style="color: rgb(49, 48, 48)">Choose a role:</label>
			<select name="role" id="role" class="form-select role-select">
				<option value="Client">Client</option>
				<option value="Employee">Employee</option>
				<option value="Admin">Admin</option>
			</select>
		</div>
		<div class="text-center">
			<button type="submit" class="btn conference-btn btn-primary px-4">Set Role</button>
		</div>
	</form>
</div>

@if(session('user_role'))
<div class="text-center mt-4">
	<p class="current-role text-success">Current Role: <strong>{{ session('user_role') }}</strong></p>
	<p class="student-info">Student: Evaldas Mackonis</p>
	<p class="group-info">Group: PIT-22-NL</p>

	<a href="{{ route('conferences.index') }}" class="btn btn-secondary view-conferences mt-3">View Conferences</a>

	@if(session('user_role') === 'Admin')
	<a href="{{ route('admin.dashboard') }}" class="btn btn-primary admin-dashboard mt-3">Admin Dashboard</a>
	@endif
</div>
@endif
@endsection
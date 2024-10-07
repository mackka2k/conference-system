<!-- resources/views/admin/dashboard.blade.php -->
@extends('layout.app')

@section('content')
<h1>Registered Users</h1>
@if(session('error'))
<div class="alert alert-danger">
	{{ session('error') }}
</div>
@endif

<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Surname</th>
			<th>Email</th>
		</tr>
	</thead>
	<tbody>
		{{-- @foreach($users as $user)
		<tr>
			<td>{{ $user['name'] }}</td>
			<td>{{ $user['surname'] }}</td>
			<td>{{ $user['email'] }}</td>
		</tr>
		@endforeach --}}
	</tbody>
</table>
@endsection
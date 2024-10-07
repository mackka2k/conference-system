<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ config('app.name') }}</title>
	<link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark">
		<a class="navbar-brand" href="{{ route('dashboard') }}">{{ config('app.name') }}</a>
		<div class="collapse navbar-collapse">
			<ul class="navbar-nav ml-auto">
				@if (session('user_role'))
				<li class="nav-item">
					<span class="nav-link current-role">{{ session('user_role') }} Role</span>
				</li>
				<li class="nav-item">
					<a class="nav-link logout-link disabled" href="#">Logout</a>
				</li>
				@endif
			</ul>
		</div>
	</nav>

	<main class="container py-4 main-content">
		@yield('content')
	</main>

	<script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
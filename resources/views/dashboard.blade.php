<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ config('app.name') }}</title>
	<link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>
	<header>
		<h1>Welcome to {{ config('app.name') }}</h1>
	</header>

	<main>
		@yield('content')
	</main>

	<footer>
		<p>&copy; {{ date('Y') }}</p>
	</footer>

	<script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
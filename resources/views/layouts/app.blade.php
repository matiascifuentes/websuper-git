<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport"
		content="width=device-width, initial-scale=1, user-scalable=yes">

		<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/lumen/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('css/main.css') }}">

		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
		
	</head>
	<body>
 		@if(\Session::has('message'))
 			@include('inc.message')
 		@endif
 		@include('inc.navbar')
		@yield('content')
		<!-- Aqui incluir footer  -->

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="{{ asset('js/pinterest_grid.js') }}"></script>
		<script src="{{ asset('js/main.js') }}"></script>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		
	</body>
</html>
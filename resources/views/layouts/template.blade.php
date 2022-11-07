<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Screen Boutique</title>
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
	<link rel="icon" type="image/x-icon" href="{{ asset('images/assets/favicon.ico')}}" />
	@livewireStyles
</head>
<body>

	@yield('content')

	@livewireScripts
	<script src="{{asset('js/app.js')}}"></script>
	<script src="{{asset('js/jquery.js')}}"></script>
	<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>	
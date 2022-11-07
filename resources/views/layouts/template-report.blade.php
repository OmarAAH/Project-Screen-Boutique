<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Screen Boutique</title>
</head>
<body>
	<style>
		img {
			position: absolute;
			top: 0;
			left: 0;
			width: 120px;
			height: 120px;
		}
		div {
			position: absolute;
			top: 0;
			right: 0;
			padding-top: 25px; 
		}
		p{
			padding: 0;
			margin: 0;
			align-content: flex-end;
		}
		h1{
			margin:50px 0px; 
			text-align: center;
		}
		table {
			width: 100%;
			border-collapse: collapse;
		}
		td {
			text-align: center;
		}
		table, th, td {
			border: 1px solid #000;
		}
		
	</style>
		<img src="{{ asset('images/logo.png')}}"> 
	<div>
		<p>Fecha: <strong>{{$date}}</strong></p>
		<p>Hora: <strong>{{$time}}</strong></p>		
	</div>
	<h1><u>Registro de {{$type}}</u></h1>

	@yield('content')

</body>
</html>
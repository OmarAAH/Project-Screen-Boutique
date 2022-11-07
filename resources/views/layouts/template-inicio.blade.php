<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Screen Boutique | Inicio</title>
        
        <link rel="icon" type="image/x-icon" href="{{ asset('images/assets/favicon.ico')}}" />
        
        <link rel="stylesheet" href="{{ asset('css/styles-index.css') }}">
    </head>

    <body id="page-top">

        @yield('content')

	    @livewireScripts

        <script src="{{asset('js/jquery.js')}}"></script>
        
	    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
        
        <script src="{{asset('js/scripts.js')}}"></script>

        <script src="{{asset('js/bootstrap.js')}}"></script>

    </body>
</html>

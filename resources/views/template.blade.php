<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<title>Promass | @if(isset($home)) {{$home}} @endif @yield('site_title', '')</title>
<meta name="description" content="@yield('site_meta_desc', '')">
<meta name="keywords" content="@yield('site_meta_key', '')">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/fav.png') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('fonts/flaticon.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/rsmenu-main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/rsanimations.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/rs-spacing.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --> 
<!-- WARNING: Respond.js doesn't work if you view the page via file:// --> 
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]--> 


</head>
<body>

@include('secciones.nav')
@yield('content')
@include('secciones.footer')
</body>
</html>

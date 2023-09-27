<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		{{-- styles --}}
		<!-- Title -->
		<title>@yield('title')</title>
		<!-- Favicon -->
		<link rel="icon" href="{{URL::asset('assets/img/brand/favicon.png')}}" type="image/x-icon"/>
		<!-- Icons css -->
		<link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
		<!--  Custom Scroll bar-->
		<link href="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
		<!--  Sidebar css -->
		<link href="{{URL::asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">

		<!-- Sidemenu css -->
		<link rel="stylesheet" href="{{URL::asset('assets/css-rtl/sidemenu.css')}}">
		@yield('css')
		<!--- Style css -->
		<link href="{{URL::asset('assets/css-rtl/style.css')}}" rel="stylesheet">
		<!--- Dark-mode css -->
		<link href="{{URL::asset('assets/css-rtl/style-dark.css')}}" rel="stylesheet">
		<!---Skinmodes css-->
		<link href="{{URL::asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet">
		{{-- font --}}
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Almarai:wght@400;700&family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<style>
			body, h1, h2, h3, h4, h5, h6{
				font-family: 'Almarai', sans-serif !important;
			}
		</style>

	</head>
	
	<body class="main-body bg-primary-transparent">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
		@yield('content')		
		@include('layouts.footer-scripts')	
	</body>
</html>
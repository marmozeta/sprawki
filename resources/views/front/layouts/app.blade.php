<!DOCTYPE HTML>
<html class="no-js" lang="pl">
    <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sprawki.pl - portal tylko dla katolików</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta name="keywords" content="" />
	<meta name="author" content="" />

        @if(!empty($element))
            <meta name="description" content="{{ $element->text_for_social }}" />
            <meta property="og:title" content="{{ $element->text_for_social }}"/>
            <meta property="og:image" content="{{ asset('images/elements/'.$element->image) }}" />
            <meta property="og:url" content="{{ url()->current() }}"/>
            <meta property="og:site_name" content=""/>
            <meta property="og:description" content="{{ $element->description }}"/>
            <meta name="twitter:title" content="{{ $element->text_for_social }}" />
            <meta name="twitter:image" content="{{ asset('images/elements/'.$element->image) }}" />
            <meta name="twitter:url" content="{{ url()->current() }}" />
            <meta name="twitter:card" content="" />
        @endif

	<link rel="shortcut icon" href="favicon.ico">

	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('css/icomoon.css')}}">
	<link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{asset('css/salvattore.css')}}">
	<link rel="stylesheet" href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css')}}">   
        <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{asset('https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.0.0/css/flag-icons.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
	<link rel="stylesheet" href="{{asset('css/app.css')}}?20240320">
        <link rel="stylesheet" href="{{asset('css/ct-ultimate-gdpr.min.css')}}" />
	<script src="{{asset('js/modernizr-2.6.2.min.js')}}"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
        @yield('styles')
        <x-head.tinymce-config/>
	</head>
	<body>
            <!-- Load Facebook SDK for JavaScript -->
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
		
	@include('front.layouts.partials.header')    
	
	<div id="fh5co-main">
             @yield('content')
        </div>

	@include('front.layouts.partials.footer')    

	<!-- jQuery -->
	<script src="{{ asset('admin/js/jquery.min.js') }}"></script>
	<!-- jQuery Easing -->
	<script src="{{asset('js/jquery.easing.1.3.js')}}"></script>
	<!-- Bootstrap -->
	<script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>  
	<!-- Waypoints -->
	<script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
	<!-- Magnific Popup -->
	<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('js/bootstrap-autocomplete.min.js')}}"></script>
	<!-- Salvattore -->
	<script src="{{asset('js/salvattore.min.js')}}"></script>
        
	<script src="https://unpkg.com/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
        <script src="https://unpkg.com/@yaireo/tagify"></script>
        <script src="https://unpkg.com/@yaireo/tagify@3.1.0/dist/tagify.polyfills.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

	<script src="{{asset('js/ct-ultimate-gdpr.min.js')}}"></script>
	<script src="{{asset('js/init_PL.js')}}"></script>

	<!-- Main JS -->
        <script src="{{asset('js/custom.js')}}?v=20240318"></script>
	<script src="{{asset('js/main.js')}}"></script>
        @yield('scripts')
        @yield('after_scripts')
    </body>
</html>

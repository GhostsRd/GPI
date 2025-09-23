<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GPI') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('/monjs.js') }}"></script>
    

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="{{asset('niceadmin/css/style.css')}}" rel="stylesheet">

    <!-- Styles -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/style.css') }}" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
	<link rel="stylesheet" href="vendors/linericon/style.css">
	<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('vendors/owl-carousel/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
	<link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
	<!-- main css -->
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
    {{-- aos --}}

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @livewireStyles
</head>
<body >
    <div id="app">
        
<header class="header_area">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<!-- <a class="navbar-brand logo_h" href="index.html"><h1 style="color: #760A8A;">GPI client</h1></a> -->
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav justify-content-end">
							<li class="nav-item active"><a class="nav-link" href="{{route("utilisateur")}}">Home</a></li>
							<li class="nav-item"><a class="nav-link" href="#contact">A propos</a></li>
							<li class="nav-item"><a class="nav-link" href="">Documentation</a></li>
							<li class="nav-item"><a class="nav-link" href="">Profil</a></li>
							
							
							<li class="nav-item"><a class="nav-link" href="#">Membre</a></li>
							<li class="nav-item"><img src="img/favicon.png" style="border-raduis: 20%;margin-top:40px;width:50%;box-shadow:0 0 10 dark"  alt=""></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</header>


  

        <div class="container-fluid">
                <div >
                    <main >
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>

    </div>



    <footer class="footer_area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-12">
					<div class="footer_top flex-column">
						<div class="footer_logo">
							<a href="#">
								<h1>GPI</h1>
								<!-- <img src="img/logo.png" alt=""> -->
							</a>
							<h4>Follow Me</h4>
						</div>
						<div class="footer_social">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row footer_bottom justify-content-center">
				<p class="col-lg-8 col-sm-12 footer-text">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
			</div>
		</div>
	</footer>
    @livewireScripts


    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('js/popper.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/stellar.js')}}"></script>
	<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('vendors/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{asset('vendors/isotope/imagesloaded.pkgd.min.js')}}"></script>
	<script src="{{asset('vendors/isotope/isotope-min.js')}}"></script>
	<script src="{{asset('vendors/owl-carousel/owl.carousel.min.js')}}"></script>
	<script src="{{asset('js/jquery.ajaxchimp.min.js')}}"></script>
	<script src="{{asset('js/mail-script.js')}}"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="{{asset('js/gmaps.min.js')}}"></script>
	<script src="{{asset('js/theme.js')}}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script> --}}
    <script> </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      once: false,
      mirror: false,
      useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
      disableMutationObserver: false,
      disable: false, 
    });
  </script>
   
    
</body>
</html>

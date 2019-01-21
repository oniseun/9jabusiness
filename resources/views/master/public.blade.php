<?php
use App\Auth;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="user-scalable = yes" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	@yield('seo')
	
	<title>
	@yield('title') | 9jabusiness
	</title>
	
    <!--================================FAVICON================================-->
	

	<link rel="apple-touch-icon"  href="{{ url('images/favicon/9jb-logo.png') }}">
	<link rel="icon" type="image/png" href="{{ url('images/favicon/9jb-logo.png') }}">
	<link rel="shortcut icon" href="{{ url('images/favicon/9jb-logo.png') }}" type="image/x-icon">
	<link rel="icon" href="{{ url('images/favicon/9jb-logo.png') }}" type="image/x-icon">
	<link rel="manifest" href="{{ url('images/favicon/manifest.json') }}">
	<meta name="msapplication-TileColor" content="seagreen">
	<meta name="msapplication-TileImage" content="{{ url('images/favicon/ms-icon-144x144.png') }}">
	<meta name="theme-color" content="seagreen">
	
    <!--================================BOOTSTRAP STYLE SHEETS================================-->
        
	<link rel="stylesheet" type="text/css" href="{{ url('bootstrap/css/bootstrap.min.css') }}">
	
    <!--================================ Main STYLE SHEETs====================================-->
	
	<link rel="stylesheet" type="text/css" href="{{ url('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('css/menu.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('css/color/color.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/testimonial/css/style.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ url('assets/testimonial/css/elastislide.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ url('css/responsive.css') }}">

	<!--================================FONTAWESOME==========================================-->
		
    <link rel="stylesheet" type="text/css" href="{{ url('css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('slider/slider.css') }}">
        
	<!--================================GOOGLE FONTS=========================================-->
	<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Montserrat:400,700|Lato:300,400,700,900'>  
		
	<!--================================SLIDER REVOLUTION =========================================-->
	
	<link rel="stylesheet" type="text/css" href="{{ url('assets/revolution_slider/css/revslider.css') }}" media="screen" />
		
</head>
<body>
	<!-- <div class="preloader"><span class="preloader-gif"></span></div> -->
	<div class="theme-wrap clearfix">
		<!--================================responsive log and menu==========================================-->
		<div class="wsmenucontent overlapblackbg"></div>
		<div class="wsmenuexpandermain slideRight">
			<a id="navToggle" class="animated-arrow slideLeft"><span></span></a>
			<a href="{{ url('/') }}" class="smallogo"><img src="{{ url('images/logo.png') }}" width="120" alt="9jabusiness" /></a>
		</div>
		<!--================================HEADER==========================================-->
		<div class="header">
			<div class="top-toolbar"><!--header toolbar-->
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-12 col-xs-12 pull-left">
							<div class="social-content">
								<ul class="social-links">
									<li><a class="linkedin" href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
									<li><a class="twitter" href="https://www.twitter.com/9jabusiness1/" target="_blank"><i class="fa fa-twitter"></i></a></li>
									<li><a class="facebook" href="https://web.facebook.com/9jabusiness-884905974904713/" target="_blank"><i class="fa fa-facebook"></i></a></li>
									<li><a class="instagram" href="https://www.instagram.com/9jabusiness1/" target="_blank"><i class="fa fa-instagram"></i></a></li>
								
								</ul>
							</div>
						</div>
						<div class="col-md-6 col-sm-12 col-xs-12 pull-right">
							<div class="top-contact-info">
								<ul>
									<li class="toolbar-email"><i class="fa fa-envelope-o"></i> info@9jabusiness.com</li>
									<li class="toolbar-contact"><i class="fa fa-phone"></i> +(234)-8030793434</li>
								
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div><!--header toolbar end-->
			<div class="nav-wrapper"><!--main navigation-->
				<div class="container">
					<!--Main Menu HTML Code-->
					<nav class="wsmenu slideLeft clearfix">
						<div class="logo pull-left"><a href="{{ url('/') }}" title="9jabusiness"><img src="{{ url('images/logo.png') }}" alt="" /></a></div>
						<ul class="mobile-sub wsmenu-list pull-right">
							<li><a {!! set_active_url('/') !!} href="{{ url('/') }}" class="">Home</a></li>
							<li><a {!! set_active_url('search') !!} href="{{ url('search') }}">Search Listings</a></li>
							<li><a {!! set_active_url('categories') !!} href="{{ url('categories') }}">Categories </a></li>
							<li><a {!! set_active_url('locations') !!} href="{{ url('locations') }}">Locations</a></li>
						  <li><a {!! set_active_url('contact') !!} href="{{ url('contact') }}">Contact Us</a></li>
						  @if(Auth::check())
						  <li><a  href="{{ url('dashboard') }}">Admin Panel</a></li>
						  @endif
						</ul>
					</nav>
				</div>
			</div><!--main navigation end-->
		</div><!-- header end -->

		@yield('top')

		@yield('content')

		@hasSection('sidebar')
				<section class="aside-layout-section padding-bottom-20">
					<div class="container"><!-- section container -->
						<div class="row"><!-- row -->
							<div class="col-md-9 col-sm-8 col-xs-12 main-wrap"><!-- content area column -->
									@yield('main')
							</div>
							<div class="col-md-3 col-sm-4 col-xs-12"><!-- sidebar column -->
								<div class="sidebar sidebar-wrap">

									@yield('sidebar')
									
								</div>
							</div>		
						</div>
					</div><!-- section container end -->
				</section>

		@endif

		@yield('bottom')
		
		<!--================================SOCIAL SECTION==========================================-->
		
		<section class="social-section  style-2">
			<div class="container"><!-- section container -->
				<div class="row social-wrap clearfix">
					<div class="col-md-2 col-sm-4 col-xs-12 social-connect pull-left">
						<h5>let's connect</h5>
					</div>
					<div class="col-md-10 col-sm-8 col-xs-12 social-links">
						<ul class="pull-right clearfix">
							<li class="item">
								<a class="https://www.twitter.com/9jabusiness1/" href="#"><i class="fa fa-twitter-square"></i></a>
							</li><!-- .ITEM -->
							<li class="item">
								<a class="" href="#"><i class="fa fa-linkedin-square"></i></a>
							</li><!-- .ITEM -->
							<li class="item">
								<a class="" href="https://web.facebook.com/9jabusiness-884905974904713/"><i class="fa fa-facebook-square"></i></a>
							</li>
							<li class="item">
								<a class="https://www.instagram.com/9jabusiness1/" href="#"><i class="fa fa-instagram"></i></a>
							</li>
						</ul>
					</div>
				</div>
			</div><!-- container end -->
		</section>
		
		
		<!--================================ FOOTER AREA ==========================================-->
		
		<footer class="footer style-1 padding-top-60 bg222">
			<div class="container">
				<div class="footer-main padding-bottom-10">
					<div class="row">
						<div class="col-md-6 margin-bottom-30">
							<!-- <div class="footer-widget-title">
								<h5>LATEST NEWS</h5>
							</div> -->
							<div class="footer-logo">
								<a href="{{ url('/') }}"><img src="{{ url('images/logo.png') }}" alt="footer logo"></a>
							</div>
							<div class="footer-intro" style="width:100%">
								<p><p><strong>Finding a business cannot be easier!</strong></p>
<p>We provide a platform where you can easily find a business near you. Whether you a looking for a hotel, a gym, an electrical store, a yoga class or a carpenter, 9jabusiness is the place to find them. We connect local businesses with their potential customers and vice versa.
								</p>
								
							</div>
						</div>
						<div class="col-md-6 margin-bottom-30">
							<div class="footer-widget-title">
								<h5>@9jabusiness1</h5>
							</div>
							<div class="footer-flikr-widget">
								<p>
								<a href="https://twitter.com/9jabusiness1?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-size="large" data-show-count="false">Follow @9jabusiness1</a>
								</p>
								<br>
								<p>
								<a class="twitter-timeline" href="https://twitter.com/9jabusiness1?ref_src=twsrc%5Etfw">Tweets by 9jabusiness1</a> 
								</p>

								<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
							</div>
						</div>
					</div>
				</div>
			</div><!-- .container end -->
			<div class="footer-bottom">
				<div class="container">
					<div class="row clearfix">
						<div class="col-md-8 col-sm-12 col-xs-12 pull-right margin-bottom-20">
							<nav class="footer-menu wsmenu clearfix">
								<ul class="wsmenu-list pull-right">
								  	<li><a href="{{ url('/') }}" class="">Home</a></li>
									<li><a href="{{ url('search') }}">Search Listings</a></li>							
									<li><a href="{{ url('categories') }}">Categories </a></li>
									<li><a href="{{ url('locations') }}">Locations</a></li>
								  	<li><a href="{{ url('contact') }}">Contact Us</a></li>
								  	@if(Auth::check())
									  <li><a  href="{{ url('dashboard') }}">Admin Panel ( {{ Auth::info('name') }} )</a></li>
									  @endif
								</ul>
							</nav>
						</div>
						<div class="col-md-4 col-sm-12 col-xs-12 pull-left margin-bottom-20">
							<div class="footer-copyright">
								<p>&copy; 2018, 9jabusiness All Rights Reserved </p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<!--================================MODAL WINDOWS FOR REGISTER AND LOGIN FORMS ===========================================-->

	<!--================================JQuery===========================================-->
        
	<script type="text/javascript" src="{{ url('js/jquery-1.11.3.min.js') }}"></script>
	<script src="{{ url('js/jquery.js') }}"></script><!-- jquery 1.11.2 -->
	<script src="{{ url('js/jquery.easing.min.js') }}"></script>
	<script src="{{ url('js/modernizr.custom.js') }}"></script>
	
	<!--================================BOOTSTRAP===========================================-->
        
	<script src="{{ url('bootstrap/js/bootstrap.min.js') }}"></script>	
	
	<!--================================NAVIGATION===========================================-->
	
	<script type="text/javascript" src="{{ url('js/menu.js') }}"></script>
	
	<!--================================SLIDER REVOLUTION===========================================-->
		
	<script type="text/javascript" src="{{ url('assets/revolution_slider/js/revolution-slider-tool.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/revolution_slider/js/revolution-slider.js') }}"></script>
	
	@yield('scripts')
	
	<!--================================OWL CARESOUL=============================================-->
		
	<script src="{{ url('js/owl.carousel.js') }}"></script>
    <script src="{{ url('js/triger.js') }}" type="text/javascript"></script>
		
	<!--================================FunFacts Counter===========================================-->
		
	<script src="{{ url('js/jquery.countTo.js') }}"></script>
	
	<!--================================jquery cycle2=============================================-->
	
	<script src="{{ url('js/jquery.cycle2.min.js') }}" type="text/javascript"></script>	
	
	<!--================================waypoint===========================================-->
		
	<script type="text/javascript" src="{{ url('js/jquery.waypoints.min.js') }}"></script><!-- Countdown JS FILE -->
	
	<!--================================RATINGS===========================================-->	
	
	<script src="{{ url('js/jquery.raty-fa.js') }}"></script>
	<script src="{{ url('js/rate.js') }}"></script>
	
	<!--================================ testimonial ===========================================-->
	<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
			
			<div class="rg-image-wrapper">
				<div class="rg-image"></div>
				<div class="rg-caption-wrapper">
					<div class="rg-caption" style="display:none;">
						<p></p>
						<h5></h5>
						<div class="caption-metas">
							<p class="position"></p>
							<p class="orgnization"></p>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</script>	
	<script type="text/javascript" src="{{ url('assets/testimonial/js/jquery.tmpl.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/testimonial/js/jquery.elastislide.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/testimonial/js/gallery.js') }}"></script>
	
	<!--================================custom script===========================================-->
		
	<script type="text/javascript" src="{{ url('js/custom.js') }}"></script>
	<script type="text/javascript" src="{{ url('slider/slider.js') }}"></script>
</body>
</html>
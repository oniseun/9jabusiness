@extends('master.public')
@section('title')
{{ $info->title }} , {{ $info->city_name }} , {{ $info->state_name }} 	
@endsection	

@section('seo')
    <meta name="description" content="{{ $info->title }} Office in {{ $info->physical_address }}. Find Address, Phone Number, Contact Details, customer care, email office address, reviews & ratings. Visit 9jabusiness.com for {{ $info->title }} in {{ $info->city_name }}, {{ $info->state_name }}."/>
    <meta name="keywords" content="{{ $info->title }}, {{ $info->title }} in {{ $info->city_name }}, {{ $info->title }} in {{ $info->state_name }}, {{ $info->title }} address, {{ $info->title }} phone number, {{ $info->title }} contact details" />
    <meta name="Robots" content="index,follow" />

    <link rel="alternate" media="only screen and (max-width)" href="{{ url('listing/'.$info->url) }}" />

<meta name="fragment" content="!">
<link rel="canonical" href="{{ url('listing/'.$info->url) }}" />
   <!--  <meta property="fb:app_id" content="" /> -->
    <meta property="og:url" content="{{ url('listing/'.$info->url) }}" />
    <meta property="og:title" content="{{ $info->title }} Office in {{ $info->physical_address }} | 9jabusiness" />
    <meta property="og:type" content="business" />
    <meta property="og:image" content="{{ url($info->featured_image) }}" />
    <meta property="og:site_name" content="9jabusiness" id="ogsitename" />
    <meta property="og:description" content="{{ $info->title }} in {{ $info->physical_address }}. Find Address, Phone Number, Contact Details, customer care, email office address, reviews &amp; ratings. Visit 9jabusiness for {{ $info->title }} in {{ $info->city_name }}, {{ $info->state_name }}." />
    <meta property="og:locale" content="en_US" />

<script type="application/ld+json">
    {
  "@context": "https://schema.org",
  "@id": "{{ url('listing/'.$info->url) }}",
  "name": "{{ $info->title }} Office in {{ $info->physical_address }} , {{ $info->city_name }} , {{ $info->state_name }}  | 9jabusiness",
  "image": "{{ url($info->featured_image) }}",
  "@type": "LocalBusiness",
  "address": {
    "type": "PostalAddress",
    "addressLocality": "{{ $info->city_name }}",
    "addressRegion": "{{ $info->state_name }}",
    "streetAddress": "{{ $info->physical_address }}"
  },
  "description": "{{ $info->title }} Office in {{ $info->physical_address }}. Find Address, Phone Number, Contact Details, customer care, email office address, reviews & ratings. Visit 9jabusiness.com for {{ $info->title }} in {{ $info->city_name }}, {{ $info->state_name }}.",
  "telephone": "{{ $info->primary_phone }}",
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "{{ $info->latitude }}",
    "longitude": "{{ $info->longitude }}"
  }
}
    
</script>

@endsection

@section('top')	
		
		<!--================================PAGE TITLE==========================================-->
		<div class="page-title-wrap bgorange-1 padding-top-30 padding-bottom-30 margin-bottom-30"><!-- section title -->
			<h4 class="white">{{ $info->category_name }}</h4>
		</div><!-- section title end -->
		
		<!--================================listing SECTION==========================================-->
@endsection		

@section('main')
<div class="listing-single padding-bottom-40">
							<div class="single-listing-wrap">
								<div class="single-listing-scroller  bgwhite shadow-1">
									<!-- declare a slideshow -->
									<div class="cycle-slideshow" data-cycle-fx=scrollHorz data-cycle-timeout=0 data-cycle-pager="#adv-custom-pager"  data-cycle-pager-template="<a href='#'><img src='<?='{{src}}'?>'></a>">
										
										@if(strlen($info->image1) < 4)
										<img src="{{ url('images/listings/details/01.jpg') }}" alt="item">
										@endif

										@for($i = 1; $i <= 10 ; $i++)

										<?php
											$image_field = 'image'.$i;
											
										?>
											@if(strlen($info->$image_field) > 3)
												<img src="{{ url(image_url_encode($info->$image_field)) }}" alt="item">
											@endif
										@endfor
										<a class="cat-tag bg{{ $info->color }}-1 white" href="{{ url('categories/'.$info->category_url) }}"><i class="fa {{ $info->icon }}"></i></a>
										<div class="listing-main-content">
											<h4>{{ $info->title }}</h4>
											<p><i class="fa fa-map-marker yallow-1"></i>{{ $info->city_name }} , {{ $info->state_name }}</p>
											<div class="social">
												<ul>
													<li><a class="bggreen-1 white" href="{{ $info->facebook }}"><i class="fa fa-facebook"></i></a></li>
													<li><a class="bgblue-1 white" href="{{ $info->twitter }}"><i class="fa fa-twitter"></i></a></li>
													<li><a class="bgbrown-1 white" href="{{ $info->instagram }}"><i class="fa fa-instagram"></i></a></li>
													<li><a class="bgblue-2 white" href="{{ $info->linkedin }}"><i class="fa fa-linkedin"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<!-- empty element for pager links -->
									<div id="adv-custom-pager" class="center external"></div>

								</div>
								<div class="listing-details">
									<div class="row tabs">
										<div class="col-md-4 col-sm-4 col-xs-12">
											<div class="tab-link current" data-tab="tab-1">
												<div class="link-top bgblue-1"></div>
												<i class="fa fa-home bgblue-1 white"></i>DESCRIPTION
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<div class="tab-link" data-tab="tab-2">
												<div class="link-top bggreen-1"></div>
												<i class="fa fa-map-marker bggreen-1 white"></i>map view
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<div class="tab-link" data-tab="tab-3">
												<div class="link-top bgyallow-1"></div>
												<i class="fa fa-star bgyallow-1 white"></i>REVIEWS
											</div>
										</div>
									</div>
									<div id="tab-1" class="tab-content current">
										<h5>PRODUCT DISCRIPTION</h5>
										<p>
											{!! nl2br(htmlentities($info->description)) !!}
										</p>
									</div>
									<div id="tab-2" class="tab-content">
										<h5>MAP</h5>
										

										<div style="width:100%; ">
											<!-- New York, NY, USA (40.7127837, -74.00594130000002) -->
											@if(strlen($info->map_url) > 5 && !str_contains($info->map_url,'<iframe'))
											<iframe width="100%" height="450" frameborder="0" style="border:0" src="{{ $info->map_url }}&amp;key=AIzaSyBueyERw9S41n4lblw5fVPAc9UqpAiMgvM"></iframe>
											@elseif(str_contains($info->map_url,'<iframe'))
											{!! $info->map_url !!}
											@elseif($info->latitude > 0)
											<div id="map" style="overflow:visible !important;"></div>
											@endif
										</div>
									</div>
									<div id="tab-3" class="tab-content">
										<p>No review yet.</p>
									</div>	
								</div>
								
								<div class="listing-contact-detail-wrap">
									<div class="listing-contact-section-title">
										<h5>contact</h5>
									</div>
									<div class="listing-contact-section-table">
										<div class="listing-contact-table-field">
											<ul>
												<li class="info">Address</li>
												<li class="details">{{ $info->physical_address }} </li>
											</ul>
										</div>
										<div class="listing-contact-table-field">
											<ul>
												<li class="info">Mobile</li>
												<li class="details">{{ $info->primary_phone }}</li>
											</ul>
										</div>
										<div class="listing-contact-table-field">
											<ul>
												<li class="info">Other phone numbers</li>
												<li class="details">{{ $info->other_phones }}</li>
											</ul>
										</div>
										<div class="listing-contact-table-field">
											<ul>
												<li class="info">E-mail Address</li>
												<li class="details">{{ $info->primary_email }}</li>
											</ul>
										</div>
										</div>
										<div class="listing-contact-table-field">
											<ul>
												<li class="info">Other E-mail Address</li>
												<li class="details">{{ $info->other_emails }}</li>
											</ul>
										</div>
										<div class="listing-contact-table-field">
											<ul>
												<li class="info">Website</li>
												<li class="details">{{ $info->website }}</li>
											</ul>
										</div>
										<div class="listing-contact-table-field">
											<ul>
												<li class="info">Category</li>
												<li class="details">{{ $info->category_name }}</li>
											</ul>
										</div>
										<div class="listing-contact-table-field">
											<ul>
												<li class="info">Tags</li>
												<li class="details">{{ $info->tags }}</li>
											</ul>
										</div>
									</div>
								</div>
								
								<div class="listing-feature-section">
									<div class="listing-feature-section-title">
										<h5>PRODUCTS/SERVICES</h5>
									</div>
									<?php
										$features = explode(',',$info->products);
									?>
									<div class="row listing-feature-wrapper clearfix">
										@foreach($features as $feature)
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="feature-field">
												<i class="fa fa-check bggreen-4 white"></i>
												<p>{{ $feature }}</p>
											</div>
										</div>
										@endforeach
										
									</div>
								</div>

								<div class="listing-feature-section">
									<div class="listing-feature-section-title">
										<h5>OPENING HOURS</h5>
									</div>
									<?php
										$hours =  ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];;
										
									?>
									<div class="listing-feature-wrapper clearfix">
										<div class="sidebar-opening-hours-widget">
											@foreach($hours as $day)
											<?php
											$main_day = $day.'_status';
											$open_time = $day.'_open_time';
											$close_time = $day.'_close_time';

											$open = $info->$open_time;
											$close = $info->$close_time;
											?>
										
												<div class="opening-hours-field clearfix">
													<span>{{ $day }}</span>
													<span>{{ $open }} ~ {{ $close }}</span>
												</div>
												
											@endforeach

										
									</div>
									</div>
								</div>
								@if(strlen($info->featured_video) > 10 )
								<div class="listing-video-section bgwhite">
									<div class="listing-video-section-title">
										<h5>VIDEO</h5>
									</div>
									<div class="listing-video-wrapper clearfix">  
										<div class="video">
											<iframe width="100%" height="400" src="{{ $info->featured_video }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
											</div>
										</div>			
									</div>
								</div>
								@endif
								
								<div class="listing-owner-section">
									<div class="listing-owner-section-title">
										<h5>owner information</h5>
									</div>
									<div class="listing-owner-wrapper clearfix">
										<div class="listing-owner-figure pull-left">
											<img src="{{ url(image_url_encode($info->admin_photo)) }}" alt="owner">
										</div>
										<div class="listing-owner-content pull-right">
											<a class="user" href="{{ url('author/'.$info->admin_url) }}"><i class="fa fa-user bgblue-1 white"></i>
												{{ $info->admin_name }}</a>
											<a class="contact-number" href="#"><i class="fa fa-phone bgblue-1 white"></i>{{ $info->admin_phone }}</a>
											<a class="owner-adress" href="#"><i class="fa fa-world bgblue-1 white"></i>
												{{ $info->admin_email }}</a>
											<a class="view-profile white bgblue-1" href="{{ url('author/'.$info->admin_url) }}">view profile</a>
										</div>
									</div>
								</div>



							</div>
						
@endsection

@section('sidebar')
	
	@include('components.sidebar-search')
	@include('components.top-locations')
	@include('components.ads')
							
@endsection


@section('scripts')
<!--================================MAP===========================================-->
		
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBueyERw9S41n4lblw5fVPAc9UqpAiMgvM&amp;sensor=false"></script>
@if($info->latitude > 0)
											
											
	<script>
	  var map;
			//google.maps.event.addDomListener(window, 'load', init);
        
            function init() {
				"use strict";
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
					scrollwheel: false,
                    // How zoomed in you want the map to start at (always required)
                    zoom: 11,
					type: 'ROADMAP',
                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng( {{ $info->latitude }}, {{ $info->longitude }})

              
                  
                };

                // Get the HTML DOM element that will contain your map 
                // We are using a div with id="map" seen below in the <body class="scrollbar-inner">
                var mapElement = document.getElementById('map');

                // Create the Google Map using our element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);

                // Let's also add a marker while we're at it
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng({{ $info->latitude }}, {{ $info->longitude }}),
                    map: map,
                    icon: 			'images/pin.png',
					title: 			'9jabusiness',
					
				
                });
				
            }
	</script>
	@endif
	<!-- map with geo locations -->

	<script type="text/javascript" src="js/jquery.mapit.js"></script>
	<script src="js/initializers.js"></script>

@endsection
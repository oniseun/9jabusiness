@extends('master.public')
@section('title','Contact Us')	

@section('seo')
  <meta name="description" content="Talk to us on 9jabusiness. We are here to help you 24/7"/>
    <meta name="keywords" content="call 9jabusiness, contact 9jabusiness, mail 9jabusiness, complaints at 9jabusiness" />
    <meta name="Robots" content="index,follow" />


@endsection
@section('content')	


		
		<!--================================PAGE TITLE==========================================-->
		<div class="page-title-wrap bgorange-1 padding-top-30 padding-bottom-30"><!-- section title -->
			<h4 class="white">contact us</h4>
		</div><!-- section title end -->
		<!--================================MAP SECTION==========================================-->
		
		<section id="google-map">
			<div class="container-fluid">
				<div id="map"></div>
			</div><!-- container-fluid end -->
		</section>
		
		<!--================================CONTACT===========================================-->
		<section id="contact-form" class="margin-top-70 margin-bottom-40">
			<div class="container">
				<div class="row info-box-wrap clearfix">
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"><!-- infobox -->
						<div class="info-box bgwhite shadow-1 clearfix">
							<div class="info-icon">
								<i class="fa fa-phone bgblue-1 white"></i>
							</div>
							<div class="info-content">
								<div class="info-title">
									
									<h6>Contact numbers</h6>
								</div>
								<div class="info-disc">
									<p>+(234)-8030793434</p>
								</div>
							</div>
						</div>
					</div><!-- infobox end -->
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"><!-- infobox -->
						<div class="info-box bgwhite shadow-1 clearfix">
							<div class="info-icon">
								<i class="fa fa-envelope bggreen-1 white"></i>
							</div>
							<div class="info-content">
								<div class="info-title">
									
									<h6>Email Address</h6>
								</div>
								<div class="info-disc">
									<p>info@9jabusiness.com<br> bruce@justdeywin.com</p>
								</div>
							</div>
						</div>
					</div><!-- infobox end -->
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"><!-- infobox -->
						<div class="info-box bgwhite shadow-1 clearfix">
							<div class="info-icon">
								<i class="fa fa-map-marker bgyallow-1 white"></i>
							</div>
							<div class="info-content">
								<div class="info-title">
									<h6>Address</h6>
								</div>
								<div class="info-disc">
									<p>Lagos State, Nigeria</p>
								</div>
							</div>
						</div>
					</div><!-- infobox end -->
				</div><!-- .row .info-box-wrap end -->
				<?php
                  if(session('failure'))
                        {
                          alert_failure(session('failure'));
                        }

                    if(session('success'))
                        {
                          alert_success(session('success'));
                        }
          				?>
				<form method= "post" action="{{ url('send/feedback') }}" >
					@csrf
				<div class="contact-form-wrap margin-top-30"><!--.contact-form-wrap -->
					<div id="contact_form" class="row contact-form"><!-- .row .contact-form -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><!-- form-field -->
							<input class="input-field" type="text" placeholder="YOUR FULL NAME" name="name" required="required">
						</div><!-- form-field  end-->
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><!-- form-field -->
							<input class="input-field" type="email" placeholder="EMAIL ADDRESS" name="email" required="required">
						</div><!-- form-field  end-->
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><!-- form-field -->
							<input class="input-field" type="text" placeholder="PHONE NUMBER" name="phone" required="required">
						</div><!-- form-field  end-->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><!-- form-field -->
							<textarea class="input-field" placeholder="MESSAGE" name="comment"></textarea>
						</div><!-- form-field  end-->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><!-- form-btn -->
							<input class="contact-btn bgblue-1" type="submit" value="SUBMIT MESSAGE" id="submit_btn">
						</div><!-- form-btn  end-->
						<div id="contact_results"></div>
					</div><!-- .row .contact-form end -->
				</div><!--.contact-form-wrap end -->
			</form>
				
				
			</div><!-- container end -->
		</section>
		
@endsection
@section('scripts')
<!--================================MAP===========================================-->
		
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBueyERw9S41n4lblw5fVPAc9UqpAiMgvM"></script>
	<script type="text/javascript" src="{{ url('js/map.js') }}"></script>

@endsection
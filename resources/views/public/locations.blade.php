@extends('master.public')
@section('title','Business Locations')	
@section('content')	
  <meta name="description" content="Search Locations in 9jabusiness"/>
    <meta name="keywords" content="lagos, Abuja, port Harcourt, Benin, Ibadan, Enugu" />
    <meta name="Robots" content="index,follow" />

<?php
$colors = ['yellow','red','brown','blue','green','purple','orange'];
?>
		<!--================================PAGE TITLE==========================================-->
		<div class="page-title-wrap bgorange-1 padding-top-30 padding-bottom-30"><!-- section title -->
			<h4 class="white">LOCATIONS</h4>
		</div><!-- section title end -->

		<!--================================CATEGOTY SECTION style3==========================================-->
		
	<section class="location-section padding-top-70 padding-bottom-40">
				<div class="container"><!-- section container -->
					
					<div class="location-wrapper style2">
						<div class="row">
							@foreach($locations as $details)
								<?php
									$r_color = rand(0,6);
									$color = $colors[$r_color] ;
								?>
							<div class="col-md-4 col-sm-4 col-xs-12"><!--location entry column-->
								<div class="location-entry">
									<div class="location-content-2 shadow-1 clearfix">
										<a  href="{{ url('locations/'.$details->url) }}" class="location-icon">
											<i class="fa fa-map-marker bg{{ $color }}-1 white"></i>
										</a>
										<div class="location-title-disc">
											<a  href="{{ url('locations/'.$details->url) }}"><h5>{{ $details->name }}</h5></a>
											<a class="number-adds" href="{{ url('locations/'.$details->url) }}">
												@if($details->listing_count > 1)
													{{ $details->listing_count }}  Listings 
												@elseif($details->listing_count > 0 )
													{{ $details->listing_count }}  Listing 
												@else
													No Listing
												@endif
											</a>
										</div>
									</div>
								</div>
							</div><!--location entry column end-->
							@endforeach
						</div>
					</div>
				</div><!-- section container end -->
			</section>
			
@endsection
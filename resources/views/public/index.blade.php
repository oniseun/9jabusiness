@extends('master.public')
@section('title','Home - Most popular social business listing website in nigeria')	
<!--================================ SEARCH FORM==========================================-->

@section('seo')

        <meta name="description" content="Register your Business Online - 9jabusiness help your local business promotion, advertising & marketing to efficiently reach people and increase online business Visibility in Search." />
        <meta name="keywords" content="business registration, register your business, join 9jabusiness, business registration program, business in lagos" />



@endsection


@section('top')

@include('components.search')
<!--================================ SLIDER ==========================================-->
		
<div class="sc-page padding-top-40 padding-bottom-70">	
	<section class="feature-section">
				<div class="container"><!-- section container -->
					{!! section_title('Featured Listings',30) !!}
				</div><!-- section container end -->
				<div class="container-fluid"><!-- section container -->
					<div class="feature-wrap">
						<ul class="feature-slider clearfix">
							<?php
								
									featured_listing($featured);
							?>
						</ul>
					</div>
				</div>
	</section>
</div>		

@endsection		
		
		
		
@section('main')
		<div class="listing-section padding-bottom-20">
							<div class=""><!-- section container -->

								<div class="add-listing-wrapper">
									<div class="add-listing-nav shadow-1">
										<div class="row clearfix">
											<div class="col-md-12">
												{!! section_title('Latest Listings') !!}
											</div>
										</div>
									</div>

									<div class="listing-main gridview padding-top-30 padding-bottom-30">
											<div id="latest-listing">
												<div class="listing-wrapper three-column row">
													<?php
														small_listing($latest);
													?>
												</div>
											</div>
											
									</div>

									<div class="add-listing-nav shadow-1">
										<div class="row clearfix">
											<div class="col-md-12">
												{!! section_title('Popular Listings') !!}
											</div>
										</div>
									</div>

									<div class="listing-main gridview tab-content padding-top-30">
											<div id="latest-listing" class="tab-pane active">
												<div class="listing-wrapper three-column row">
													<?php
														small_listing($popular);
													?>
												</div>
											</div>
											
									</div>

								</div>
							</div><!-- section container end -->
						</div>
@endsection

@section('sidebar')
	
	@include('components.top-categories')
	@include('components.ads')
	@include('components.top-locations')
							
@endsection


@section('bottom')
	<!--================================ PARTNER SECTION ==========================================-->
	@include('components.partners')
		
@endsection
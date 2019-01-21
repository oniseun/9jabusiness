
@extends('master.public')
@section('title')
{{ $info->name }} - Content creator at 9jabusiness 
@endsection


@section('seo')
  <meta name="description" content="Browse through various businesses by {{ $info->name }}, content creator at 9jabusiness"/>
    <meta name="keywords" content="Browse by businesses in Lagos and Nigeria, 9jabusiness content creators" />
    <meta name="Robots" content="index,follow" />


@endsection

@section('content')	
		<!--================================PAGE TITLE==========================================-->
		<div class="page-title-wrap bgorange-1 padding-top-30 padding-bottom-30"><!-- section title -->
			<h4 class="white">{{ (isset($page_num) ? '(Page '.$page_num.') of ' : '' ) }} Listings by {{ $info->name }}</h4>
		</div><!-- section title end -->
		<!--================================MAP SECTION==========================================-->
		
		<!--================================CATEGOTY SECTION style3==========================================-->
	<section class="aside-layout-section padding-top-20 padding-bottom-10">
			<div class="container"><!-- section container -->
				<div class="row"><!-- row -->
					<div class="col-md-12 col-sm-12 col-xs-12 main-wrap"><!-- content area column -->
						<div class="listing-single padding-bottom-10">
							<div class="single-listing-wrap">
								
								
								<div class="listing-owner-section">
									<div class="listing-owner-section-title">
										<!-- <h5>owner information</h5> -->
									</div>
									<div class="listing-owner-wrapper clearfix">
										<div class="listing-owner-figure pull-left">
											<img src="{{ url(image_url_encode($info->photo)) }}" alt="owner">
										</div>
										<div class="listing-owner-content pull-right">
											<a class="user" href="#"><i class="fa fa-user bgblue-1 white"></i>{{ $info->name }}</a>
											<a class="contact-number" href="#"><i class="fa fa-phone bgblue-1 white"></i>{{ $info->phone }}</a>
											<a class="owner-adress" href="#"><i class="fa fa-map-marker bgblue-1 white"></i>{{ $info->email }} </a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div><!-- section container end -->
		</section>

		<section class="aside-layout-section padding-top-10 padding-bottom-40">
			<div class="container"><!-- section container -->
				<div class="row"><!-- row -->
					<div class="col-md-12  main-wrap"><!-- content area column -->
						<div class="listing-section padding-bottom-40">
							<div class=""><!-- section container -->
								<div class="add-listing-wrapper">
									
									<div class="listing-main gridview  padding-top-30">
											<div id="latest-listing">
												<div class="listing-wrapper three-column row">

													<?php
														large_listing($listings);
													?>
									
												</div>
											</div>
											
									</div>
								</div>
							</div><!-- section container end -->
						</div>
					
						
					</div>
						
				</div>

					<center>
	                      @if(isset($page_num) && $page_num >= 3)
	                          <a href="{{ url('author/'.$info->url) }}" class="btn btn-default"  title="First Page" data-toggle="tooltip">&laquo; First Page &raquo;</a> 
	                      @endif
	                      
	                      @if(count($listings) >= 1)
	                          <?php
	                              $first_time = $listings[0]->create_time;

	                              $last_time = end($listings)->create_time;

	                              $page_num = isset($page_num) ? $page_num : 1;
	                          ?>
	                          

	                          @if($page_num >=2)
	                          <a href="{{ url('author/'.$info->url.'/prev/'.$first_time.'/'.($page_num - 1 )) }}" class="btn btn-default"  title="prev" data-toggle="tooltip">&laquo; Prev page</a> 
	                          @endif

	                          &nbsp; 

	                          @if(count($listings) >= 15)
	                          <a href="{{ url('author/'.$info->url.'/next/'.$last_time.'/'.($page_num + 1 )) }}" class="btn btn-default"  title="next" data-toggle="tooltip">Next page&raquo;</a>
	                          @endif

	                      @endif
                    </center>  

			</div><!-- section container end -->
		</section>
		
	@endsection
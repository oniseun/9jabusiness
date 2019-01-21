@extends('master.public')
@section('title')	
 Businesses in 
@if($info->type == 'city')
					{{ $info->name }} - {{ $state_name }} 
				@else
					{{ $info->name }} 
				@endif


@endsection
@section('seo')
  <meta name="description" content="Browse through various businesses in {{ $info->name }} on 9jabusiness"/>
    <meta name="keywords" content="{{ $info->name }}, Businesses in {{ $info->name }}, 9jabusiness locations, 9jabusiness" />
    <meta name="Robots" content="index,follow" />


@endsection
@section('top')	

		<!--================================PAGE TITLE==========================================-->
		<div class="page-title-wrap bgorange-1 padding-top-30 padding-bottom-30 margin-bottom-30"><!-- section title -->
			<h4 class="white">
				@if($info->type == 'city')
					{{ $state_name }} STATE - {{ $info->name }}
				@else
					{{ $info->name }} STATE
				@endif
			</h4>
		</div><!-- section title end -->
		<!--================================MAP SECTION==========================================-->
@endsection

@section('main')
		<div class="listing-section padding-bottom-20">
							<div class=""><!-- section container -->

								<div class="add-listing-wrapper">
									<div class="add-listing-nav shadow-1">
										<div class="row clearfix">
											<div class="col-md-12">
												{!! section_title((isset($page_num) ? '(Page '.$page_num.') of ' : '' ).$info->listing_count.' Listings in '.$info->name) !!} 
											</div>
										</div>
									</div>

									<div class="listing-main gridview tab-content padding-top-30 padding-bottom-30">
											<div id="latest-listing" class="tab-pane active">
												<div class="listing-wrapper three-column row">
													<?php
														small_listing($listings);
													?>
												</div>
											</div>
											
									</div>

								

								</div>
							</div><!-- section container end -->

						<center>
	                      @if(isset($page_num) && $page_num >= 3)
	                          <a href="{{ url('locations/'.$info->url) }}" class="btn btn-default"  title="First Page" data-toggle="tooltip">&laquo; First Page &raquo;</a> 
	                      @endif
	                      
	                      @if(count($listings) >= 1)
	                          <?php
	                              $first_time = $listings[0]->create_time;

	                              $last_time = end($listings)->create_time;

	                              $page_num = isset($page_num) ? $page_num : 1;
	                          ?>
	                          

	                          @if($page_num >=2)
	                          <a href="{{ url('locations/'.$info->url.'/prev/'.$first_time.'/'.($page_num - 1 )) }}" class="btn btn-default"  title="prev" data-toggle="tooltip">&laquo; Prev page</a> 
	                          @endif

	                          &nbsp; 

	                          @if(count($listings) >= 15)
	                          <a href="{{ url('locations/'.$info->url.'/next/'.$last_time.'/'.($page_num + 1 )) }}" class="btn btn-default"  title="next" data-toggle="tooltip">Next page&raquo;</a>
	                          @endif

	                      @endif
                    </center>  

						</div>
@endsection

@section('sidebar')
	
	@include('components.sidebar-search')
	@include('components.top-locations')
	@include('components.ads')
							
@endsection
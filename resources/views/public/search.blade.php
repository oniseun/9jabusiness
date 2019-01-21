@extends('master.public')
@section('title','  Search Businesses ')	

@section('seo')

    <meta name="description" content="Browse through various businesses from all over Lagos state and nigeria on 9jabusiness – the most popular social business directory in Nigeria."/>
    <meta name="keywords" content="Browse by businesses in Lagos and Nigeria" />
    <meta name="Robots" content="index,follow" />


@endsection

@section('top')	
		
		@include('components.search')
		<!--================================ SEARCH FORM==========================================-->
		
@endsection
@section('main')
		<div class="listing-section padding-bottom-20">
							<div class=""><!-- section container -->

								<div class="add-listing-wrapper">

								@if(isset($listings) )
									<div class="add-listing-nav shadow-1">
										<div class="row clearfix">
											<div class="col-md-12">
												{!! section_title((isset($page_num) ? '(Page '.$page_num.') of ' : '' ).' SEARCH RESULTS FOR &quot;<strong>'.htmlentities($query).'</strong>&quot; ') !!}

											</div>
										</div>
									</div>

								@endif

									<div class="listing-main gridview padding-top-30 padding-bottom-30">
											<div id="latest-listing">
												<div class="listing-wrapper three-column row">
													<?php
													if(isset($listings) && count($listings) > 0)
													{

														small_listing($listings);
													}
													?>
												</div>
											</div>
											
									</div>

								

								</div>
							</div><!-- section container end -->

							<center>
						<?php
							 
						?>
	                      @if(isset($page_num) && $page_num >= 3)
	                          <a href="{{ url('search/?'.$_SERVER['QUERY_STRING']) }}" class="btn btn-default"  title="First Page" data-toggle="tooltip">&laquo; First Page &raquo;</a> 
	                      @endif
	                      
	                      @if(isset($listings) && count($listings) >= 1)
	                          <?php
	                              $first_time = $listings[0]->create_time;

	                              $last_time = end($listings)->create_time;

	                              $page_num = isset($page_num) ? $page_num : 1;
	                          ?>	                          

	                          @if($page_num >=2)
	                          <a href="{{ url('search/prev/'.$first_time.'/'.($page_num - 1 ).'?'.$_SERVER['QUERY_STRING']) }}" class="btn btn-default"  title="prev" data-toggle="tooltip">&laquo; Prev page</a> 
	                          @endif

	                          &nbsp; 

	                          @if(count($listings) >= 15)
	                          <a href="{{ url('search/next/'.$last_time.'/'.($page_num + 1 ).'?'.$_SERVER['QUERY_STRING']) }}" class="btn btn-default"  title="next" data-toggle="tooltip">Next page&raquo;</a>
	                          @endif

	                      @endif
                    </center>  

						</div>
@endsection

@section('sidebar')
	
	@include('components.top-categories')
	@include('components.ads')
	@include('components.top-locations')
							
@endsection
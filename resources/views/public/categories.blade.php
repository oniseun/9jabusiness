@extends('master.public')
@section('title','Business Categories')	
@section('content')	

		<!--================================PAGE TITLE==========================================-->
		<div class="page-title-wrap bgorange-1 padding-top-30 padding-bottom-30"><!-- section title -->
			<h4 class="white">categories</h4>
		</div><!-- section title end -->
		<!--================================MAP SECTION==========================================-->
		
		<!--================================CATEGOTY SECTION style3==========================================-->
		
			<section class="categories-section padding-top-30 padding-bottom-40">
				<div class="container"><!-- section container -->
					
					<div class="row category-section-wrap cat-style-3">
						@foreach($categories as $details)
						<div class="col-md-4 col-sm-6 col-xs-12 main-wrap"><!-- category column -->
							<a href="{{ url('categories/'.$details->url) }}" class="cat-wrap shadow-1" style="height:220px;">
								<p><i class="fa {{ $details->fa_icon }} bg{{ $details->color }}-1 white"></i></p>
								<h5>{{ $details->title }}</h5>
								<p class="cay-disc">
									@if($details->listing_count > 1)
										{{ $details->listing_count }}  Listings 
									@elseif($details->listing_count > 0 )
										{{ $details->listing_count }}  Listing 
									@else
										No Listing
									@endif
								</p>
							</a>
							<div class="listing-border-bottom bg{{ $details->color }}-1"></div>
						</div><!-- category column end -->
						@endforeach
					</div>
						
				</div><!-- section container end -->
			</section>

			
		@endsection
	<div class="sidebar-widget shadow-1">
								<div class="sidebar-widget-title">
									<h5><span class="bgyallow-1"></span>TOP CATEGORIES</h5>
								</div>
								<div class="sidebar-widget-content category-widget clearfix">
									<div class="sidebar-category-widget-wrap">
										<ul>
											@foreach($top_categories as $details)
											<li title="{{ $details->title }}"><a href="{{ url('categories/'.$details->url) }}" title="{{ $details->title }}"><i class="fa {{ $details->fa_icon }} bg{{ $details->color }}-1 white"></i> {{ str_limit($details->title,20) }} <span>({{ $details->listing_count }})</span></a></li>
											
											@endforeach
										</ul>
									</div>
								</div>
							</div>
<div class="sidebar-widget shadow-1">
								<div class="sidebar-widget-title">
									<h5><span class="bgpurpal-1"></span>TOP LOCATIONS</h5>
								</div>
								<div class="sidebar-widget-content location-widget clearfix">
									<div class="sidebar-location-widget-wrap">
										<ul>
											<?php
												$colors = ['yellow','red','brown','blue','green','purple','orange'];
											?>
											@foreach($top_locations as $details)
											<?php
												$r_color = rand(0,6);
												$color = $colors[$r_color] ;
											?>
											<li><a class="nohover" href="{{ url('locations/'.$details->url) }}"><i class="fa fa-map-marker {{ $color }}-1"></i> {{ $details->name }} <span>({{ $details->listing_count }})</span></a></li>
											@endforeach
										</ul>
									</div>
								</div>
							</div>
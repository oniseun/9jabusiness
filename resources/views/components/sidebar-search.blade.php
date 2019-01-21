		<div class="sidebar-widget shadow-1">
								<div class="sidebar-widget-title">
									<h5><span class="bgred-1"></span>SEARCH 9jABUSINESS</h5>
								</div>
								<div class="sidebar-widget-content listing-search-bar  clearfix">
									<div class="sidebar-listing-search-wrap">
										<form action="{{ url('search') }}" method="get">
											<input class="sidebar-listing-search-input" placeholder="Search" name="q" type="text" />

											<p class="red-1">LOCATIONS</p>
											<select class="sidebar-listing-search-select" name="location">
												<option class="options" value="all">all locations</option>
												@foreach($location_list as $location)
												<option class="options" value="{{ $location->url }}">{{ $location->name }}</option>
												@endforeach
											</select>

											<p class="green-1">CATEGORIES</p>
											<select class="sidebar-listing-search-select" name="category">
												<option class="options" value="all">all categories</option>
												@foreach($category_list as $category)
												<option class="options" value="{{ $category->url }}">{{ $category->title }}</option>
												@endforeach
											</select>
											
											
											<div class="listing-search-btn">
												<button class="sidebar-listing-search-btn white bgred-2">
													<i class="fa fa-search"></i>	SEARCH
												</button> 
											</div>
										</form>
									</div>
								</div>
							</div>
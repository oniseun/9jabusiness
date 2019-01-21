		<section id="search-form" class="padding-top-20 margin-bottom-20">
				<div class="container">
					<div class="search-form-wrap">
						<form  class="clearfix" action="{{ url('search') }}" method="get">
							<div class="input-field-wrap pull-left">
								<input class="search-form-input" name="q" placeholder="enter keyword" type="text" 
								value="{{ isset($_GET['q'])? strtolower($_GET['q']) : '' }}"/>
							</div>
							<div class="select-field-wrap pull-left">
								<select class="search-form-select" name="location" >
									<option class="options" value="all">all locations</option>
												@foreach($location_list as $location)
												<option class="options" {{ isset($_GET['location']) && $_GET['location'] == $location->url ? 'selected="selected"' : '' }} value="{{ $location->url }}">{{ $location->name }}</option>
												@endforeach
								</select>
							</div>
							<div class="select-field-wrap pull-left">
								<select class="search-form-select" name="category" >
									<option class="options" value="all">all categories</option>
												@foreach($category_list as $category)
												<option class="options" {{ isset($_GET['category']) && $_GET['category'] == $category->url ? 'selected="selected"' : '' }} value="{{ $category->url }}">{{ $category->title }}</option>
												@endforeach
								</select>
							</div>
							<div class="submit-field-wrap pull-left">
								<input class="search-form-submit bgyallow-1 white" type="submit"/>
							</div>
						</form>
					</div>
				</div>
			</section>

	
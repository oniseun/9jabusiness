
@extends('master.admin')

 @section('title','Edit Company Information')
 @section('content')

<!-- Main Content -->
<div class="container-fluid">
	<?php
	bread_crumb('Edit Listing');

	if(session('failure'))
	{
		alert_failure(session('failure'));
	}
	if(session('success'))
	{
		alert_success(session('success'));
	}
	
	?>
	
	<!-- Product Row One -->
	<div class="row">
			
<div class="col-md-12">
		
		<div class="form-wrap">
			<form action="{{ url('admin/edit/listing') }}" method="post" enctype="multipart/form-data">
				@csrf

				<ul class="nav nav-tabs">
                        
             
<li class="active"><a data-toggle="tab" href="#tab-basic">Business Information</a></li>
<li ><a data-toggle="tab" href="#tab-contact">Contact Information</a></li>
<li ><a data-toggle="tab" href="#tab-gallery">Image/gallery</a></li>
<li ><a data-toggle="tab" href="#tab-hours">Opening Hours</a></li>
<li ><a data-toggle="tab" href="#tab-submit">Submit</a></li>

              
 </ul>
<div class="tab-content">
<p>
<br>
</p>

    <div id="tab-basic" class="tab-pane fade in active ">
    		<div class="row">

					<div class="col-md-7">

					

					<div class="form-group">
					<label class="control-label mb-10">Select City</label>
						<select class="selectpicker" data-style="form-control btn-default btn-outline" name="city">
							@foreach($cities as $city)
							<option <?=selected($city->id,$info->city)?> value="{{ $city->id }}">{{ $city->name}}</option>
							@endforeach
						</select>
					</div>

					<?php
					textbox('Zip Code','zip_code',$info->zip_code);
					//hidden_field('state',$state_id);
					hidden_field('id',$info->id);
					?>
					<hr>
					<div class="form-group">
							<label class="control-label mb-10">Business Category</label>
							<select class="selectpicker" data-style="form-control btn-default btn-outline" name="category_id">
								@foreach($category_list as $cat)
								<option <?=selected($cat->id,$info->category_id)?> value="{{ $cat->id }}">{{ $cat->title }}</option>
								@endforeach
							</select>
					</div>
					<hr>
					<?php
						textbox('Company name','title',$info->title);
						textarea('Company Description','description',$info->description,200);
						textarea('Tags and keywords (separate with comma)','tags',$info->tags,100);
						textarea('Product/Services','products',$info->products,200);
						textbox('Founded','founded',$info->founded);
					?>

					<hr>
					<div class="row">
						<div class="col-md-3">
								<h4> Pricing </h4>

						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label mb-10">Min</label>
								<select class="selectpicker" data-style="form-control btn-default btn-outline" name="price_from">
									{!! pricing_options($info->price_from) !!}
								</select>
							</div>

						</div>
						<div class="col-md-3">
								<div class="form-group">
								<label class="control-label mb-10">Max</label>
								<select class="selectpicker" data-style="form-control btn-default btn-outline" name="price_to">
									{!! pricing_options($info->price_to) !!}}
								</select>
							</div>

						</div>
					</div>

					</div>

						
						

				</div>

				{!! tab_next_prev_link(NULL,'tab-contact') !!}

    </div>

    <div id="tab-contact" class="tab-pane fade">

    	<div class="row">

					<div class="col-md-7">
					<?php

						// contact info
						textarea('Physical Address','physical_address',$info->physical_address,100);

						textbox('GOOGLE MAP','map_url',$info->map_url);
						textbox('Primary Phone Number','primary_phone',$info->primary_phone);
						textbox('Other Phones','other_phones',$info->other_phones);
						textbox('Primary Email','primary_email',$info->primary_email);
						textbox('Other Emails','other_emails',$info->other_emails);
						textbox('Website','website',$info->website);
						// socal media

						

						?>
					</div>

					<div class="col-md-5">
						<h4> Social media </h4>
						<p>
							<br>
						</p>
						
						<?php
						// contact info
						textbox('Facebook','facebook',$info->facebook);
						textbox('Instagram','instagram',$info->instagram);
						textbox('Twitter','twitter',$info->twitter);
						textbox('Linkedin','linkedin',$info->linkedin);
						?>
					</div>

				</div>

				{!! tab_next_prev_link('tab-basic','tab-gallery') !!}

    </div>

    <div id="tab-gallery" class="tab-pane fade">
<!-- Image Row -->
<div class="row">
	<div class="col-md-4">
	<?php
		upload_image('Featured Image','featured_image',url(image_url_encode($info->featured_image)));
	?>

	</div>
	<div class="col-md-4">
	<?php
		upload_image('Business Logo','business_logo',url(image_url_encode($info->business_logo)));
	?>

	</div>
</div>
<hr>
<!-- Gallery -->					
				<div class="row">
					@for($i = 1; $i <=6 ;$i++)
					<div class="col-md-4">

						<?php
							$image_var = 'image'.$i;
							upload_image('Gallery Image '.$i, $image_var ,url(image_url_encode($info->$image_var)));
						?>

					</div>
					@endfor

				</div>
				<!-- /Image Row -->
				<hr>

					<div class="row">
						
						<div class="col-md-12">
						<?php
							textarea('Video Embed Url','featured_video',$info->featured_video,100);
						?>

						</div>
					</div>

					{!! tab_next_prev_link('tab-contact','tab-hours') !!}
    </div>

    <div id="tab-hours" class="tab-pane fade">
    		<?php

					$open_days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];

					$open_hours = range(1,24);
					?>

					@foreach($open_days as $weekday)
					<?php
						$open_time_var = $weekday.'_open_time';
						$close_time_var = $weekday.'_close_time';
					?>

					<div class="row">
						<div class="col-md-2">
								<h4>{{ $weekday }}</h4>

						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label mb-10">Opening time</label>
								<select class="selectpicker" data-style="form-control btn-default btn-outline" name="{{ $open_time_var }}">
									{!! opening_hours_options($info->$open_time_var) !!}
								</select>
							</div>

						</div>
						<div class="col-md-2">
								<div class="form-group">
								<label class="control-label mb-10">Closing time</label>
								<select class="selectpicker" data-style="form-control btn-default btn-outline" name="{{ $close_time_var }}">
									{!! opening_hours_options($info->$close_time_var) !!}
								</select>
							</div>

						</div>
					</div>
					<hr>
					<!-- /Opening Hours -->
					
					@endforeach

					{!! tab_next_prev_link('tab-gallery','tab-submit') !!}
    </div>

    <div id="tab-submit" class="tab-pane fade">
    	
    	<hr>
    	<div class="form-group">
							<label class="control-label mb-10">Feature this listing ?</label>
							<select class="selectpicker" data-style="form-control btn-default btn-outline" name="featured">
								
								<option  <?=selected($info->featured,'no')?> value="no">No</option>
								<option  <?=selected($info->featured,'yes')?> value="yes">Yes</option>
								
							</select>
					</div>
    	<hr>

				<?php

							form_button('update business');

				?>	

    </div>


</div>



				
			</form>
		</div>


									
								


		</div>
											
	</div>	
	<!-- /Product Row Four -->
	
</div>



@endsection
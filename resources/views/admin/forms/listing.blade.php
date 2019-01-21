
@extends('master.admin')

 @section('title','Add Listing')
 @section('content')

<!-- Main Content -->
<div class="container-fluid">
	<?php
	bread_crumb_edit(['admin/form/add/listing' ,'Select State'],'Add Listing');

	if(session('failure'))
	{
		alert_failure(session('failure'));
	}
	
	?>
	
	<!-- Product Row One -->
	<div class="row">
			
<div class="col-md-12">
		
		<div class="form-wrap">
			<form action="{{ url('admin/add/listing') }}" method="post" enctype="multipart/form-data">
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
							<option  value="{{ $city->id }}">{{ $city->name}}</option>
							@endforeach
						</select>
					</div>

					<?php
					textbox('Zip Code','zip_code');
					hidden_field('state',$state_id);
					?>
					<hr>
					<div class="form-group">
							<label class="control-label mb-10">Business Category</label>
							<select class="selectpicker" data-style="form-control btn-default btn-outline" name="category_id">
								@foreach($category_list as $cat)
								<option  value="{{ $cat->id }}">{{ $cat->title }}</option>
								@endforeach
							</select>
					</div>
					<hr>
					<?php
						textbox('Company name','title');
						textarea('Company Description','description',NULL,200);
						textarea('Tags and keywords (separate with comma)','tags',NULL,100);
						textarea('Product/Services','products',NULL,200);
						textbox('Founded','founded');
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
									{!! pricing_options() !!}
								</select>
							</div>

						</div>
						<div class="col-md-3">
								<div class="form-group">
								<label class="control-label mb-10">Max</label>
								<select class="selectpicker" data-style="form-control btn-default btn-outline" name="price_to">
									{!! pricing_options() !!}}
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
						textarea('Physical Address','physical_address',NULL,100);

						textbox('GOOGLE MAP','map_url');
						textbox('Primary Phone Number','primary_phone');
						textbox('Other Phones','other_phones');
						textbox('Primary Email','primary_email');
						textbox('Other Emails','other_emails');
						textbox('Website','website');
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
						textbox('Facebook','facebook');
						textbox('Instagram','instagram');
						textbox('Twitter','twitter');
						textbox('Linkedin','linkedin');
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
		upload_image('Featured Image','featured_image');
	?>

	</div>
	<div class="col-md-4">
	<?php
		upload_image('Business Logo','business_logo');
	?>

	</div>
</div>
<hr>
<!-- Gallery -->					
				<div class="row">
					@for($i = 1; $i <=6 ;$i++)
					<div class="col-md-4">

						<?php
							upload_image('Gallery Image '.$i,'image'.$i);
						?>

					</div>
					@endfor

				</div>
				<!-- /Image Row -->
				<hr>

					<div class="row">
						
						<div class="col-md-12">
						<?php
							textarea('Video Embed Url','featured_video',NULL,100);
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

					<div class="row">
						<div class="col-md-2">
								<h4>{{ $weekday }}</h4>

						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label mb-10">Opening time</label>
								<select class="selectpicker" data-style="form-control btn-default btn-outline" name="{{ $weekday }}_open_time">
									{!! opening_hours_options() !!}
								</select>
							</div>

						</div>
						<div class="col-md-2">
								<div class="form-group">
								<label class="control-label mb-10">Closing time</label>
								<select class="selectpicker" data-style="form-control btn-default btn-outline" name="{{ $weekday }}_close_time">
									{!! opening_hours_options() !!}
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
								
								<option  selected="selected" value="no">No</option>
								<option   value="yes">Yes</option>
								
							</select>
					</div>
    	<hr>

				<?php

							form_button('submit business');

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
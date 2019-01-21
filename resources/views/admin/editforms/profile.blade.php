

@extends('master.admin')

 @section('title','Profile')
 @section('content')
        <!-- Main Content -->
            <div class="container-fluid">

            	<?php

            	bread_crumb('My Profile');

            	if(session('failure'))
            	{
            		alert_failure(session('failure'));
            	}

            	if(session('success'))
            	{
            		alert_success(session('success'));
            	}

            	?>
			
				<!-- /Title -->
				
<!-- Product Row One -->
<div class="row">

<div class="col-md-12">



		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="form-wrap">
					
						<div class="row">
							

							<div class="col-md-7">
								
								<?php
								panel_open('Basic Information');
								?>
								<form action="{{ url('admin/edit/profile') }}" method="post" enctype="multipart/form-data">
								
								@csrf
								<?php

									textbox2('icon-user','Fullname','name',$user_info->name);
									email2('Email Address','email',$user_info->email);
									textbox2('icon-phone','Phone Number','phone',$user_info->phone);

								?>
								<div class="form-group">
									<label class="control-label mb-10">Gender</label>
									<select class="selectpicker" data-style="form-control btn-default btn-outline" name="sex">
										<option <?=selected($user_info->sex,'male')?> value="male">male</option>
										<option <?=selected($user_info->sex,'female')?> value="female">Female</option>
									</select>
								</div>
								
								
								<?php

									textarea('About you','about',$user_info->about,300);

								?>	
								<hr>
								<?php

									// textbox('website','website',$user_info->website);
									// textbox('facebook','facebook',$user_info->facebook);
									// textbox('instagram','instagram',$user_info->instagram);
									// textbox('twitter','twitter',$user_info->twitter);
								
								?>	
								<hr>
								<?php

									form_button('update profile');

								?>	

								</form>
								<?php
															
								panel_close();
								?>
								
							</div>

							<div class="col-md-5">

								
								<?php
								panel_open('Update Picture');

								?>
								<form action="{{ url('admin/edit/photo') }}" method="post" enctype="multipart/form-data">
								@csrf
								<?php
									upload_image('Display Picture','photo',url(image_url_encode($user_info->photo)));
								?>

								<hr>
								<?php

									form_button('upload image');

								?>	
								</form>
								<?php
								panel_close();
								?>
								
								


								

							</div>
						</div>

						
				</div>
			</div>
		</div>

	

</div>
						
</div>	
<!-- /Product Row Four -->

</div>




@endsection
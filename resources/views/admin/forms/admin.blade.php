

@extends('master.admin')

 @section('title','Profile')
 @section('content')
        <!-- Main Content -->
            <div class="container-fluid">

            	<?php

            	bread_crumb('Add Admin');

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
								

								<div class="col-md-8">
									
									<?php
									panel_open('Basic Information');
									?>
									<form action="{{ url('admin/add/admin') }}" method="post" enctype="multipart/form-data">
									
									@csrf
									<?php

										textbox2('icon-user','Fullname','name');
										email2('Email Address','email');
										textbox2('icon-phone','Phone Number','phone');

									?>
									<div class="form-group">
										<label class="control-label mb-10">Gender</label>
										<select class="selectpicker" data-style="form-control btn-default btn-outline" name="sex">
											<option  value="male">male</option>
											<option  value="female">Female</option>
										</select>
									</div>
										
									<hr>
									<?php

										form_button('create admin');

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
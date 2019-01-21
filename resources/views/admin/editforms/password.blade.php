
@extends('master.admin')

 @section('title','Change Password')
 @section('content')
        <!-- Main Content -->
            <div class="container-fluid">
				<?php
				
            	bread_crumb('Change Password');

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
       				
       				<div class="col-md-6 col-md-offset-3">
       					<?php
																panel_open('Change Password');
																?>
																<form action="{{ url('admin/edit/password') }}" method="post" enctype="multipart/form-data">
																@csrf
																<?php

																	password2('Old Password','old');
																	password2('New Password','new');
																	password2('Confirm Password','new_confirmation');

																?>
																<hr>
																<?php

																	form_button('update password');

																?>	

																</form>
																<?php
																							
																panel_close();
																?>
					</div>
														
				</div>	
				<!-- /Product Row Four -->
				
			</div>
			
		
			
     
@endsection


@extends('master.auth')

 @section('title','Login to 9jabusiness')
 @section('content')
        <!-- Main Content -->
            <div class="container-fluid">

            	<?php


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

<p>
	<br>
</p>

		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="form-wrap">
					
						<div class="row">
							

							<div class="col-md-6  col-md-offset-3">

								
								<?php
								panel_open('<i class="fa fa-lock"></i>  Admin Login');

								?>
								<form action="{{ url('admin/action/login') }}" method="post" enctype="multipart/form-data">
									@csrf
								<?php

									email2('Email Address','email');
									password2('Password','password');

								?>
								<hr>	
								<center>		
								<?php

									form_button('Login','/');

								?>	
								</center>

								
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
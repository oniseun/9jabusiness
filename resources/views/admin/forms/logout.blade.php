

@extends('master.admin')

 @section('title','Logout')
 @section('content')
        <!-- Main Content -->
            <div class="container-fluid">

            	<?php

            	bread_crumb('Logout');

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
							

							<div class="col-md-6  col-md-offset-3">

								
								<?php
								panel_open('Logout Now');

								?>
								<form action="{{ url('admin/action/logout') }}" method="post" enctype="multipart/form-data">
									@csrf
									<center>
										<p>
										<img src="{{ url(image_url_encode($user_info->photo)) }}"
										height="100">
										</p>


									</center>

									<center>

										<h5> Are you sure you want to logout ? </h5>

										<hr>
										<?php

											form_button('Logout');

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
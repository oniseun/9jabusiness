
@extends('master.admin')

 @section('title','Add City')
 @section('content')

        <!-- Main Content -->
            <div class="container-fluid">
				<?php
            	bread_crumb('Create City');

            	if(session('failure'))
            	{
            		alert_failure(session('failure'));
            	}
            	
            	?>
				
				<!-- Product Row One -->
				<div class="row">
       				
       				<div class="col-md-8 col-md-offset-2">
					  <?php
							panel_open('Add City');
							?>
												<div class="form-wrap">
													<form action="{{ url('admin/add/city') }}" method="post" enctype="multipart/form-data">
														@csrf

														<div class="row">
															
															<div class="col-md-7">

																<div class="form-group">
																<label class="control-label mb-10">Select State</label>
																	<select class="selectpicker" data-style="form-control btn-default btn-outline" name="parent">
																		@foreach($states as $state)
																		<option  value="{{ $state->id }}">{{ $state->name}}</option>
																		@endforeach
																	</select>
																</div>
																<?php
																textbox('City Name','name');

																?>
																
															</div>


															<div class="col-md-5">

																

															</div>

														</div>													

														<hr>

														<?php

																	form_button('add city');

															?>	

													</form>
												</div>
								<?php
								panel_close();
								?>

												
											


					</div>
														
				</div>	
				<!-- /Product Row Four -->
				
			</div>

			
		
@endsection
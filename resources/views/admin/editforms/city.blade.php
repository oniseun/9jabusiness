
@extends('master.admin')

 @section('title','Edit City')
 @section('content')

        <!-- Main Content -->
            <div class="container-fluid">
				<?php
            	bread_crumb_edit(['admin/list/cities/'.$info->parent ,htmlentities($state_name).' State'],'Edit City');

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
       				
<div class="col-md-8 col-md-offset-2">
<?php
panel_open('Edit  City');
?>
<div class="form-wrap">
	<form action="{{ url('admin/edit/city') }}" method="post" enctype="multipart/form-data">
		@csrf

		<div class="row">
			
			<div class="col-md-7">

				<div class="form-group">
				<label class="control-label mb-10">Select State</label>
					<select class="selectpicker" data-style="form-control btn-default btn-outline" name="parent">
						@foreach($states as $state)
						<option <?=selected($state->id,$info->parent)?> value="{{ $state->id }}">{{ $state->name}}</option>
						@endforeach
					</select>
				</div>
				<?php
				textbox('City Name','name',$info->name);
				hidden_field('id',$info->id);

				?>
				
			</div>


			<div class="col-md-5">

				

			</div>

		</div>													

		<hr>

		<?php

					form_button('update city');

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
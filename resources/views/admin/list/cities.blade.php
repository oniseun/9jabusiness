
@extends('master.admin')

 @section('title','Select City')
 @section('content')

        <!-- Main Content -->
            <div class="container-fluid">
				<?php
            	bread_crumb_edit(['admin/list/cities' ,'Select State'],'Select City');
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
					  <?php
							panel_open('Cities in '.$state_name);
							?><center>
								<ul class="nav nav-pills nav-fill">
								
									@foreach($cities as $city)
									<li><a class="nav-link" href="{{ url('admin/form/edit/city/'.$city->id) }}">{{ $city->name}} </a><br></li>
									@endforeach

								</ul>
								</center>	
							<?php
							panel_close();
							?>

					</div>
														
				</div>	
				<!-- /Product Row Four -->
				
			</div>

			
		
@endsection
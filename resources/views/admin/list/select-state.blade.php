
@extends('master.admin')

 @section('title','Select State')
 @section('content')

        <!-- Main Content -->
            <div class="container-fluid">
				<?php
            	bread_crumb('Select State');
            	
            	?>
				
				<!-- Product Row One -->
				<div class="row">
       				
       				<div class="col-md-12">
					  <?php
							panel_open('Select State ');
							?><center>
								<ul class="nav nav-pills nav-fill">
								
									@foreach($states as $state)
									<li><a class="nav-link" href="{{ url('admin/list/cities/'.$state->id) }}">{{ $state->name}} </a><br></li>
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
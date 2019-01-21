

@extends('master.auth')

 @section('title','Banned!!')
 @section('content')
        <!-- Main Content -->
<div class="container-fluid">

            	<?php

            	
            	alert_failure("You have been banned from admin section");
            	

            	
            	?>
			
				<!-- /Title -->
				<center>
					
					<a href="{{ url('/') }}" class="btn btn-default"> Back to home </a>
				</center>
				


</div>




@endsection
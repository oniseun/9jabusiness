

@extends('master.admin')

 @section('title','Logout')
 @section('content')
        <!-- Main Content -->
<div class="container-fluid">

            	<?php

            	bread_crumb('Logout');

            	
            	alert_failure("We're sorry, the page you requested was not found on this server");
            	

            	
            	?>
			
				<!-- /Title -->
				<center>
					
					<a href="{{ url('dashboard') }}" class="btn btn-default"> Back to home </a>
				</center>
				


</div>




@endsection
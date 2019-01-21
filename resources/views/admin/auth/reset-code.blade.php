@extends('master.dashboardauth')
@include('master.templates')
@section('title','Enter reset code')

@section('content')
		
		<div class="wrapper  pa-0">
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="row">
									<?php
									if(session('failure'))
					            	{
					            		alert_failure(session('failure'));
					            	}
					            	?>
					            	
									<div class="col-sm-12 col-xs-12">
										<div class="sp-logo-wrap text-center pa-0 mb-30">
											<a href="/">
												<img class="brand-img mr-10" src="{{ url('/img/logo.png') }}" alt="brand"/>
											</a>
										</div>
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Enter your reset code</h3>
											<h6 class="text-center txt-grey nonecase-font">A reset code has been sent to your email. kindly copy an paste in the field below </h6>
										</div>	
										<div class="form-wrap">
											<form  action="{{ url('auth/change-password') }}" method="post">
														@csrf
												<div class="form-group">
													<?php
														hidden_field('email',$email);
														textbox('Reset Code','reset_code');
													?>
												</div>
												
												<div class="form-group text-center">
													<button type="submit" class="btn btn-success btn-rounded">Change My password</button>
													<a href="/login"  class="btn btn-default btn-rounded">back</a>
												</div>
											</form>

											<div class="mb-30">
											<h6 class="text-center txt-grey nonecase-font">Haven't gotten a mail yet?.</h6>
											<form  action="{{ url('auth/reset-code') }}" method="post" enctype="multipart/form-data">
														@csrf
												<div class="form-group">
													<?php
														hidden_field('email',$email);
													?>
												</div>												
												<div class="form-group text-center">
													<button type="submit" class="btn btn-success btn-rounded">Resend Code</button>
												</div>
											</form>
											</div>	
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->	
				</div>
				
			</div>
			<!-- /Main Content -->
		</div>
		<!-- /#wrapper -->
		
@endsection
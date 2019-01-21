@extends('master.dashboardauth')

@include('master.templates')

@section('title','Change Password')


@section('content')
		
		<div class="wrapper  pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="/">
						<img class="brand-img mr-10" src="{{ url('/img/brand-logo-small.png') }}" alt="brand"/>
					</a>
				</div>
				<div class="form-group mb-0 pull-right">
					<span class="inline-block pr-10">Already have an account?</span>
					<a class="inline-block btn btn-success btn-rounded btn-outline" href="/login">Sign In</a>
				</div>
				<div class="clearfix"></div>
			</header>
			
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
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Create new password</h3>
											<h6 class="text-center nonecase-font txt-grey">Enter your new password</h6>
										</div>	
										<div class="form-wrap">
											<form  action="{{ url('auth/reset') }}" method="post" enctype="multipart/form-data">
														@csrf
													<?php
													hidden_field('email',$email);
													hidden_field('reset_code',$reset_code);
													password('Password','password');
													password('Confirm Password','password_confirmation');
													
													?>
							
													
												<div class="form-group text-center">
													<button type="submit" class="btn btn-success btn-rounded">Change Password</button>
												</div>
											</form>
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
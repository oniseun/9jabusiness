@extends('master.dashboardauth')

@include('master.templates')

@section('title','Signup')


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
											<h3 class="text-center txt-dark mb-10">Sign up to MyCraftBook</h3>
											<h6 class="text-center nonecase-font txt-grey">Enter your details below</h6>
										</div>	
										<div class="form-wrap">
											<form  action="auth/signup" method="post" enctype="multipart/form-data">
														@csrf
													<?php

													textbox('Username','name');
													textbox('Email Address','email');
													textbox('Phone','phone');
													password('Password','password');
													password('Confirm Password','password_confirmation');
													
													?>
												<div class="form-group">
													<label class="control-label mb-10">State</label>
													<select class="selectpicker"  style="font-size:20px;padding:5px; width:100%" data-style="form-control btn-default btn-outline" name="state">
														@foreach($states as $state)
																		
																		<option  value="{{ $state->id }}">{{ $state->name }}</option>
														@endforeach
													</select>
												</div>	
													

												<div class="form-group">
													<div class="checkbox checkbox-primary pr-10 pull-left">
														<input id="checkbox_2" required="" type="checkbox">
														<label for="checkbox_2"> I agree to all <span class="txt-primary">Terms</span></label>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="form-group text-center">
													<button type="submit" class="btn btn-success btn-rounded">sign Up</button>
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
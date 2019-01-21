@extends('master.dashboardauth')
@section('title','Reset Password')

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
									<div class="col-sm-12 col-xs-12">
										<div class="sp-logo-wrap text-center pa-0 mb-30">
											<a href="/">
												<img class="brand-img mr-10" src="{{ url('img/logo.png') }}" alt="brand"/>
											</a>
										</div>
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Reset Password</h3>
										</div>	
										<div class="form-wrap">
											<form  action="auth/reset" method="post" enctype="multipart/form-data">
														@csrf
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="exampleInputpwd_2">New Password</label>
													<input type="password" class="form-control" required="" id="exampleInputpwd_2" placeholder="Enter New pwd">
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="exampleInputpwd_3">Confirm Password</label>
													<input type="password" class="form-control" required="" id="exampleInputpwd_3" placeholder="Re-Enter pwd">
												</div>
												<div class="form-group text-center">
													<button type="submit" class="btn btn-success btn-rounded">Reset</button>
													<a href="/"  class="btn btn-default btn-rounded">back</a>
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
		<!-- /#wrapper -->@endsection
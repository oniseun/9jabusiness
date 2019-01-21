@extends('master.dashboardauth')
@include('master.templates')

 @section('title','Logout Session')
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
											<a href="index.html">
												<img class="brand-img mr-10" src="{{ url('img/brand-logo-small.png') }}" alt="brand"/>
											</a>
										</div>
										<div class="form-wrap">
											<form  action="auth/logout" method="post" enctype="multipart/form-data">
														@csrf
												<div class="form-group text-center">
													<img class="img-circle" style="height:200px;width:200px" src="{{ url($user_info->photo) }}" alt="user">
													<h3 class="mt-10 txt-dark">{{ $user_info->name }}</h3>
												</div>
												<div class="form-group text-center">
													
													<button type="submit" class="btn btn-success btn-rounded">Logout Now</button>
												
												</div>
												<div class="form-group mb-0 text-center">
													<a href="/dashboard" class="inline-block txt-primary">Cancel</a>
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
		</div>
				
@endsection
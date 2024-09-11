<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="{{ $SiteData->description }}">
		<meta name="Author" content="https://facebook.com/alnefelys">

		<!-- Favicon -->
		<link rel="icon" href="{{url($SiteData->icon)}}" type="image/x-icon"/>

		<!-- Icons css -->
		<link href="{{url('/admin')}}/assets/css/icons.css" rel="stylesheet">
		

		@if (app()->getLocale()=='ar')
            <link href="{{url('/admin')}}/assets/css-rtl/style.css" rel="stylesheet">
			<link href="{{url('/admin')}}/assets/css-rtl/custom.css" rel="stylesheet">
        @else
            <link href="{{url('/admin')}}/assets/css/style.css" rel="stylesheet">
			<link href="{{url('/admin')}}/assets/css/custom.css" rel="stylesheet">
        @endif
		
		<title>{{ __('global.dashboard') }}: {{ __('global.login') }}</title>
		<style>
			.pass_show .ptxt {
				font-size: 10px;
				top: 70%;
			}
		</style>
	</head>

    <body class="main-body bg-light">

		<!-- Loader -->
		<div id="global-loader">
			<img src="{{url('/admin')}}/assets/img/loader.svg" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->

		<!-- Page -->
		<div class="page">

			<div class="container-fluid">
				<div class="row no-gutter">
					<!-- The image half -->
					<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
						<div class="row wd-100p mx-auto text-center">
							<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
								<img src="{{$SiteData->logo_header}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
							</div>
						</div>
					</div>
					<!-- The content half -->
					<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
						<div class="login d-flex align-items-center py-2">
							<!-- Demo content-->
							<div class="container p-0">
								<div class="row">
									<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
										<div class="card-sigin">
											<div class="mb-5 d-flex"> <a href="index.html">
												<img src="{{url($SiteData->icon)}}" class="sign-favicon ht-40" alt="logo">
											</a>
											<h1 class="main-logo1 mr-1 my-auto tx-28">{{ $SiteData->name }}</h1>
										</div>
											<div class="card-sigin">
												<div class="main-signup-header">
													<h2>{{ __('global.welcome_back') }}</h2>
													<h5 class="font-weight-semibold mb-4">{{ __('global.continue_login') }}</h5>
													@include('layout.admin.alert')
													<form action="{{ url()->current() }}" method="POST">@csrf
														<div class="form-group">
															<label><i class="fas fa-fw fa-envelope"></i> {{__('global.email')}}</label>
															<input type="email" class="form-control" name="email" required />
														</div>
														<div class="form-group pass_show">
															<label><i class="fas fa-fw fa-lock"></i> {{__('global.password')}}</label>
															<input type="password" class="form-control" name="password" required />
														</div>
														<div class="form-group form-check">
															<input type="checkbox" class="form-check-input" id="remember" name="remember" />
															<label class="form-check-label" style="margin-right:18px" for="remember">{{__('global.remember')}} </label>
														</div>
														<button class="btn btn-main-primary btn-block">{{ __('global.login') }}</button>
													</form>
													<div class="main-signin-footer mt-2">
														<p>
															<a href="{{url('admin/forgot/password')}}">{{ __('global.forget_password') }}</a>
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- End -->
						</div>
					</div><!-- End -->
				</div>
			</div>
			
		</div>
		<!-- End Page -->

		<!-- JQuery min js -->
		<script src="{{url('/admin')}}/assets/plugins/jquery/jquery.min.js"></script>
		<!-- custom js -->
		<script src="{{url('/admin')}}/assets/js/custom.js"></script>
		<script>
			$(document).ready(function(){
				$('.pass_show').append('<span class="ptxt">{{__('global.show')}}</span>');  
			});
			$(document).on('click','.pass_show .ptxt', function(){ 
				$(this).text($(this).text() == "{{__('global.show')}}" ? "{{__('global.hide')}}" : "{{__('global.show')}}"); 
				$(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 
			});
		</script>
	</body>
</html>
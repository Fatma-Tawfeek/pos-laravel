@extends('layouts.master2')

@section('title')
تسجيل الدخول
@endsection

@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection

@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">
				<!-- The image half -->
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row wd-100p mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
							<img src="{{URL::asset('assets/img/media/login.png')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
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
										<div class="mb-5 d-flex"> <a href="{{ url('/') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class=" ht-40" alt="logo"></a></div>
										<div class="card-sigin">
											<div class="main-signup-header">
												<h2>اهلا بعودتك!</h2>
												<h5 class="font-weight-semibold mb-4">من فضلك سجل الدخول للمتابعة.</h5>
												@if ($errors->any())
												<div class="alert alert-danger">
													<ul>
														@foreach ($errors->all() as $error)
															<li>{{ $error }}</li>
														@endforeach
													</ul>
												</div>
												@endif
												<form action="{{ route('login') }}" method="POST">
													@csrf
													<div class="form-group">
														<label>البريد الالكتروني</label> 
														<input class="form-control" placeholder="ادخل بريدك الالكتروني" type="text" name="email">
													</div>
													<div class="form-group">
														<label>كلمة المرور</label> 
														<input class="form-control" placeholder="ادخل كلمة المرور" type="password" name="password">
													</div>
													<button class="btn btn-main-primary btn-block">سجل الدخول</button>						
												</form>
												<div class="main-signin-footer mt-5">
													<p><a href="">نسيت كلمة المرور؟</a></p>
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
@endsection
@section('js')
@endsection
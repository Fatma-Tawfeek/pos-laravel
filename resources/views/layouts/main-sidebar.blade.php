<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{asset('images/users/' . auth()->user()->image )}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{ auth()->user()->name }}</h4>
							<span class="mb-0 text-muted">
								@foreach (auth()->user()->roles->pluck('name') as $role )
								  {{$role}}     
						    	@endforeach 
						    </span>
						</div>
					</div>
				</div>
				<ul class="side-menu">

					<li class="slide">
						<a class="side-menu__item" href="{{ route('roles.index') }}">
							<?xml version="1.0" ?>
							<svg id="Icons" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="side-menu__icon">
								<path class="cls-1" d="M22.814,9.216l-.826-5.368A1,1,0,0,0,21,3C15.533,3,12.731.316,12.707.293a1,1,0,0,0-1.41,0C11.269.316,8.467,3,3,3a1,1,0,0,0-.988.848L1.186,9.216A12.033,12.033,0,0,0,7.3,21.576l4.22,2.3a1,1,0,0,0,.958,0l4.22-2.3A12.033,12.033,0,0,0,22.814,9.216Zm-7.072,10.6L12,21.861,8.258,19.82a10.029,10.029,0,0,1-5.1-10.3l.7-4.541A14.717,14.717,0,0,0,12,2.3,14.717,14.717,0,0,0,20.139,4.98l.7,4.54A10.029,10.029,0,0,1,15.742,19.82Z"/>
								<path class="cls-1" d="M15.293,8.293,10,13.586,8.707,12.293a1,1,0,1,0-1.414,1.414l2,2a1,1,0,0,0,1.414,0l6-6a1,1,0,0,0-1.414-1.414Z"/>
							</svg>
							<span class="side-menu__label mt-2">Roles</span>
						</a>
					</li>

					<li class="slide">
						<a class="side-menu__item" href="{{ route('users.index') }}">
							<?xml version="1.0" ?>
							<svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="side-menu__icon">
								<title/>
								<g id="about">
									<path d="M16,16A7,7,0,1,0,9,9,7,7,0,0,0,16,16ZM16,4a5,5,0,1,1-5,5A5,5,0,0,1,16,4Z"/>
									<path d="M17,18H15A11,11,0,0,0,4,29a1,1,0,0,0,1,1H27a1,1,0,0,0,1-1A11,11,0,0,0,17,18ZM6.06,28A9,9,0,0,1,15,20h2a9,9,0,0,1,8.94,8Z"/>
								</g>
							</svg>
							{{-- <i class="side-menu__icon bi bi-person-square"></i> --}}
							<span class="side-menu__label">Users</span>
						</a>
					</li>

				</ul>
			</div>
		</aside>
<!-- main-sidebar -->

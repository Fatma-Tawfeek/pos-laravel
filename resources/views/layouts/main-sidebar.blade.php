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
						<a class="side-menu__item" href="{{ route('categories.index') }}">
							<?xml version="1.0" ?>
							<svg height="32" id="icon" viewBox="0 0 32 32" width="32" xmlns="http://www.w3.org/2000/svg" class="side-menu__icon">
								<defs>
									<style>.cls-1{fill:none;}</style>
								</defs>
								<title/>
								<rect height="2" width="14" x="14" y="25"/>
								<polygon points="7.17 26 4.59 28.58 6 30 10 26 6 22 4.58 23.41 7.17 26"/>
								<rect height="2" width="14" x="14" y="15"/>
								<polygon points="7.17 16 4.59 18.58 6 20 10 16 6 12 4.58 13.41 7.17 16"/>
								<rect height="2" width="14" x="14" y="5"/>
								<polygon points="7.17 6 4.59 8.58 6 10 10 6 6 2 4.58 3.41 7.17 6"/>
								<rect class="cls-1" data-name="&lt;Transparent Rectangle&gt;" height="32" id="_Transparent_Rectangle_" width="32"/>
							</svg>
							<span class="side-menu__label">Categories</span>
						</a>
					</li>

					<li class="slide">
						<a class="side-menu__item" href="{{ route('roles.index') }}">
							<?xml version="1.0" ?>
							<?xml version="1.0" ?>
							<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"><g>
								<path d="M0 0H24V24H0z" fill="none"/>
								<path d="M12 1l8.217 1.826c.457.102.783.507.783.976v9.987c0 2.006-1.003 3.88-2.672 4.992L12 23l-6.328-4.219C4.002 17.668 3 15.795 3 13.79V3.802c0-.469.326-.874.783-.976L12 1zm0 2.049L5 4.604v9.185c0 1.337.668 2.586 1.781 3.328L12 20.597l5.219-3.48C18.332 16.375 19 15.127 19 13.79V4.604L12 3.05zm4.452 5.173l1.415 1.414L11.503 16 7.26 11.757l1.414-1.414 2.828 2.828 4.95-4.95z"/></g>
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
							<span class="side-menu__label">Users</span>
						</a>
					</li>

				</ul>
			</div>
		</aside>
<!-- main-sidebar -->

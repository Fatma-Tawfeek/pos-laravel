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
						<a class="side-menu__item" href="{{ route('home') }}">
							<?xml version="1.0" ?>
							<svg style="enable-background:new 0 0 24 24;" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="side-menu__icon">
								<g id="info"/><g id="icons"><g id="dashboard">
									<path d="M5,18H3c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h2c1.1,0,2-0.9,2-2C7,18.9,6.1,18,5,18z"/>
									<path d="M13,16h-2c-1.1,0-2,0.9-2,2v2c0,1.1,0.9,2,2,2h2c1.1,0,2-0.9,2-2v-2C15,16.9,14.1,16,13,16z"/>
									<path d="M21,12h-2c-1.1,0-2,0.9-2,2v6c0,1.1,0.9,2,2,2h2c1.1,0,2-0.9,2-2v-6C23,12.9,22.1,12,21,12z"/>
									<path d="M22,2h-6.6c-0.9,0-1.3,1.1-0.7,1.7l1.9,1.9C12.9,9.8,7.6,13,2,13c-0.6,0-1,0.4-1,1c0,0.6,0.4,1,1,1    c6.7,0,12.9-1.9,17.4-6.6l1.8,1.8c0.6,0.6,1.7,0.2,1.7-0.7V3C23,2.4,22.6,2,22,2z"/></g></g>
							</svg>
							<span class="side-menu__label">Dashboard</span>
						</a>
					</li>


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
						<a class="side-menu__item" href="{{ route('products.index') }}">
							<?xml version="1.0" ?><svg viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"><path d="M463.1 416c-26.51 0-47.1 21.49-47.1 48s21.49 48 47.1 48s47.1-21.49 47.1-48S490.5 416 463.1 416zM175.1 416c-26.51 0-47.1 21.49-47.1 48S149.5 512 175.1 512s47.1-21.49 47.1-48S202.5 416 175.1 416zM569.5 44.73c-6.109-8.094-15.42-12.73-25.56-12.73H121.1L119.6 19.51C117.4 8.19 107.5 0 96 0H23.1C10.75 0 0 10.75 0 23.1S10.75 48 23.1 48h52.14l60.28 316.5C138.6 375.8 148.5 384 160 384H488c13.25 0 24-10.75 24-23.1C512 346.7 501.3 336 488 336H179.9L170.7 288h318.4c14.29 0 26.84-9.47 30.77-23.21l54.86-191.1C577.5 63.05 575.6 52.83 569.5 44.73z"/></svg>							<span class="side-menu__label">Products</span>
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
							<span class="side-menu__label">{{ trans('users.title') }}</span>
						</a>
					</li>

				</ul>
			</div>
		</aside>
<!-- main-sidebar -->

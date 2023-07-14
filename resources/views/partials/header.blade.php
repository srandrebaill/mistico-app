<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
	<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
		<a class="navbar-brand brand-logo" href="{{ route('dashboard') }}"><img src="{{ asset('assets/logotipo-mini.jpg') }}" alt="logo" /></a>
		<a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}"><img src="{{ asset('assets/logotipo-mini.jpg') }}" alt="logo" /></a>
	</div>
	<div class="navbar-menu-wrapper d-flex align-items-stretch">
		<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
			<span class="mdi mdi-menu"></span>
		</button>
		<div class="search-field d-none d-md-block">
			<form class="d-flex align-items-center h-100" action="#">
				<div class="input-group">
				</div>
			</form>
		</div>
		<ul class="navbar-nav navbar-nav-right">
			<li class="nav-item nav-profile dropdown">
				<a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
					<div class="nav-profile-text">
						<p class="mb-1 text-black">{{ Auth::user()->name }}</p>
					</div>
				</a>
				<div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
					<a class="dropdown-item" href="{{ route('signout') }}">
						<i class="mdi mdi-logout me-2 text-primary"></i> Sair do Sistema </a>
				</div>
			</li>
			<li class="nav-item d-none d-lg-block full-screen-link">
				<a class="nav-link">
					<i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
				</a>
			</li>

			<li class="nav-item nav-logout d-none d-lg-block">
				<a class="nav-link" href="{{ route('signout') }}">
					<i class="mdi mdi-power"></i>
				</a>
			</li>
		</ul>
		<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
			<span class="mdi mdi-menu"></span>
		</button>
	</div>
</nav>
<!-- partial -->

<div class="container-fluid page-body-wrapper">
	<!-- partial -->
	<nav class="sidebar sidebar-offcanvas" id="sidebar">
		<ul class="nav">
			<li class="nav-item nav-profile">
				<a href="#" class="nav-link">
					<div class="nav-profile-image">
						<img src="{{ asset('assets/images/icon-user.jpg') }}" alt="profile">
						<!--change to offline or busy as needed-->
					</div>
					<div class="nav-profile-text d-flex flex-column">
						<span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
						<span class=" text-secondary text-small">{{ Auth::user()->email }}</span>
					</div>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('dashboard') }}">
					<span class="menu-title">Dashboard</span>
					<i class="mdi mdi-home menu-icon"></i>
				</a>
			</li>



			@foreach ($modulos_permitidos as $module)
			<li class="nav-item">

				@if (count($module['submodulo']) > 0)
				<a class="nav-link" data-bs-toggle="collapse" href="#{{ $module['url_amigavel'] }}" aria-expanded="false" aria-controls="{{ $module['url_amigavel'] }}">
					<span class="menu-title">{{ $module['titulo'] }}</span>
					<i class="menu-arrow"></i>
					<i class="{{ $module['icone'] }} menu-icon"></i>
				</a>

				@else
				<a class="nav-link" href="{{ env('URL_APP_ADMIN') }}{{ $module['url_amigavel'] }}">
					<span class="menu-title">{{ $module['titulo'] }}</span>
					<i class="{{ $module['icone'] }} menu-icon"></i>
				</a>
				@endif

				@if (count($module['submodulo']) > 0)
				<div class="collapse" id="{{ $module['url_amigavel'] }}">
					<ul class="nav flex-column sub-menu">
						@foreach ($module['submodulo'] as $sub)
						<?php
						$item = env('URL_APP_ADMIN') . Request::segment(2) . '/' . Request::segment(3);

						?>
						<li class="nav-item"> <a class="nav-link {{ $item === $sub['url_amigavel'] ? 'active-submodulo' : '' }}" href="{{ url($sub['url_amigavel']) }}">{{ $sub['titulo'] }}</a>
						</li>
						@endforeach
					</ul>
				</div>
				@endif
			</li>
			@endforeach





			@if(Auth::user()->level_id==2)
			<li class="nav-item">
				<a class="nav-link" data-bs-toggle="collapse" href="#cadastros" aria-expanded="false" aria-controls="cadastros">
					<span class="menu-title">Cadastros </span>
					<i class="menu-arrow"></i>
					<i class="mdi mdi-crosshairs-gps menu-icon"></i>
				</a>
				<div class="collapse" id="cadastros">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item"> <a class="nav-link" href="{{ route('cliente') }}">Clientes</a></li>
						<li class="nav-item"> <a class="nav-link" href="{{ route('plano') }}">Planos</a></li>
					</ul>
				</div>
			</li>
			@endif


			<li class="nav-item">
				<a class="nav-link" href="{{ route('signout') }}">
					<span class="menu-title">Sair do Sistema</span>
					<i class="mdi mdi-power menu-icon"></i>
				</a>
			</li>
		</ul>
	</nav>

	<!-- partial -->
	<div class="content-wrapper">
		@yield('content')
	</div>
</div>
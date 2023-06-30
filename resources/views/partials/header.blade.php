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
			@if(Auth::user()->level_id==1)
			<li class="nav-item">
				<a class="nav-link" data-bs-toggle="collapse" href="#configuracoes" aria-expanded="false" aria-controls="configuracoes">
					<span class="menu-title">Configurações</span>
					<i class="menu-arrow"></i>
					<i class="mdi mdi-crosshairs-gps menu-icon"></i>
				</a>
				<div class="collapse" id="configuracoes">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item"> <a class="nav-link" href="{{ route('usuario_tipo') }}">Tipos de Usuário</a></li>
						<li class="nav-item"> <a class="nav-link" href="{{ route('usuario') }}">Usuários</a></li>
						<li class="nav-item"> <a class="nav-link" href="{{ route('modulo') }}">Módulos</a></li>
					</ul>
				</div>
			</li>
			@endif

			@if(Auth::user()->level_id==2)
			<li class="nav-item">
				<a class="nav-link" data-bs-toggle="collapse" href="#cadastros" aria-expanded="false" aria-controls="cadastros">
					<span class="menu-title">Cadastros</span>
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

			@if(Auth::user()->level_id==2)

			<li class="nav-item">
				<a class="nav-link" href="{{ route('saque') }}">
					<span class="menu-title">Solicitar Saque</span>
					<i class="mdi mdi-cash-multiple menu-icon"></i>
				</a>
			</li>
			@endif

			<li class="nav-item">
				<a class="nav-link" href="{{ route('extrato') }}">
					<span class="menu-title">Extrato</span>
					<i class="mdi mdi-contacts menu-icon"></i>
				</a>
			</li>
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
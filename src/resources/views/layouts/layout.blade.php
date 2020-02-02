<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{ config('app.name', '論破王') }}</title>
	@yield('styles')

	<!-- Scripts -->
	@if(app('env') == 'production')
	<link href="{{ secure_asset('css/styles.css') }}" rel="stylesheet">
	<link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
	@else
	<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	@endif

	<!-- Styles -->
</head>

<body>
	<header>
		<div id="app" style="position:fixed;width:100%;">
			<nav ≈ class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
				<div class="container">
					<a class="navbar-brand" href="{{ url('/') }}">
						{{ config('app.name', '論破王') }}
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse"
						data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
						aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<!-- Left Side Of Navbar -->
						<ul class="navbar-nav mr-auto">
						</ul>

						<!-- Right Side Of Navbar -->
						<ul class="navbar-nav ml-auto">
							<!-- Authentication Links -->
							@guest
							<li class="nav-item">
								<a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
							</li>
							@if (Route::has('register'))
							<li class="nav-item">
								<a class="nav-link" href="{{ route('register') }}">{{ __('登録') }}</a>
							</li>
							@endif
							@else
							<div>
								<li class="nav-item" style="float:right;">
									{{-- <a class="nav-link" href="#" data-toggle="dropdown">
										{{ Auth::user()->name }}</span>
									</a> --}}

									{{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> --}}
									<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
															 document.getElementById('logout-form').submit();">
										{{ __('ログアウト') }}
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST">
										@csrf
									</form>
									{{-- </div> --}}
								</li>
							</div>

							@endguest
						</ul>
					</div>
				</div>
			</nav>
	</header>
	<main>
		@yield('content')
	</main>
	<!-- Scripts -->
	@section('footer')
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://js.pusher.com/5.0/pusher.min.js"></script>

	@show
</body>

</html>
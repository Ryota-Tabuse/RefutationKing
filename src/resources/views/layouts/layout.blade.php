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
	<link href="{{ secure_asset('favicon.ico') }}" rel="shortcut icon">
	@else
	<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('favicon.ico') }}" rel="shortcut icon">
	@endif

	<!-- Styles -->
</head>

<body>
	<header>
		<div id="app" class="header" style="position:fixed;width:100%;">
			<nav ≈ class="navbar navbar-expand-md navbar-dark bg-blue shadow-sm">
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

						<ul class="navbar-nav mr-auto">
						</ul>

						<ul class="navbar-nav ml-auto">
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
									<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

	@show
</body>

</html>
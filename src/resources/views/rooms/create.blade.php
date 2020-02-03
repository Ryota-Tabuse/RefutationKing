@extends('layouts.layout')

@section('content')
<div class="container">
	<div class="content">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-sm-12 col-md-8">
				<nav class="panel panel-default">
					<h1> 議論部屋を追加する </h1>
					@if ($errors->any())
					<div class="alert alert-danger tx-align-l">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
							@endforeach
						</ul>
					</div>
					@endif
					<div class="panel-body">
						<form action="{{ route('rooms.create',['thema_id' => $current_thema->id])}}" method="post">
							@csrf
							<div class="form-group tx-align-l">
								<label for="title"> 議論部屋名 </label>
								<input type="text" class="form-control" name="name" id="name" />
							</div>
							<div>
								<label for="title"> 下記選択肢からどちらかを選び、<br />選んだ側の立場に立って議論をしてください。 </label>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="option" value="option_a"
										id="option_a" checked>
									<label class="form-check-label" for="radio1a">{{$current_thema->option_a}}</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="option" value="option_b"
										id="option_b">
									<label class="form-check-label" for="radio1b">{{$current_thema->option_b}}</label>
								</div>
							</div>

							<div class="text-right">
								<button type="submit" class="btn btn-primary"> 送信 </button> </div>
						</form>
					</div>
				</nav>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</div>
@endsection
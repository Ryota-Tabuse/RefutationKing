@extends('layouts.layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col col-md-offset-3 col-md-6">
			<nav class="panel panel-default">
				<div class="panel-heading"> 議論部屋を追加する </div>
				<div class="panel-body">
					<form action="{{ route('rooms.create',['thema_id' => $current_thema->id])}}" method="post"> @csrf
						<div class="form-group">
							<label for="title"> 議論部屋名 </label>
							<input type="text" class="form-control" name="name" id="name" />
						</div>
						<div>
							<label for="title"> 賛成する方をお選びください。選んだ選択肢の側に立って会話をしてください。 </label>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="option" value="option_a" id="option_a" checked>
								<label class="form-check-label" for="radio1a">{{$current_thema->option_a}}</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="option" value="option_b" id="option_b">
								<label class="form-check-label" for="radio1b">{{$current_thema->option_b}}</label>
							</div>
						</div>

						<div class="text-right">
							<button type="submit" class="btn btn-primary"> 送信 </button> </div>
					</form>
				</div>
			</nav>
		</div>
	</div>
</div>
@endsection
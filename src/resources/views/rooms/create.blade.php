@extends('layouts.layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col col-md-offset-3 col-md-6">
			<nav class="panel panel-default">
				<div class="panel-heading"> 議論部屋を追加する </div>
				<div class="panel-body">
					<form action="{{ route('rooms.create',['thema_id' => $current_thema])}}" method="post"> @csrf
						<div class="form-group">
							<label for="title"> 議論部屋名 </label>
							<input type="text" class="form-control" name="name" id="name" />
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
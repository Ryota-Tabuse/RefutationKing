@extends('layouts.layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col col-md-offset-3 col-md-6">
			<nav class="panel panel-default">
				<div class="panel-heading"> 議論テーマを追加する </div>
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<div class="panel-body">
					<form action="{{ route('themes.create')}}" method="post">
						@csrf
						<div class="form-group">
							<label for="title" value="{{ old('name') }}"> 議論テーマ名 </label>
							<input type="text" class="form-control" name="name" id="name"
								value="{{ old('name') }}" />
							<label for="title" value="{{ old('option_a') }}"> 選択肢 A</label>
							<input type="text" class="form-control" name="option_a" id="option_a"
								value="{{ old('option_a') }}" />
							<label for="title"> 選択肢 B</label>
							<input type="text" class="form-control" name="option_b" id="option_b"
								value="{{ old('option_b') }}" />
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
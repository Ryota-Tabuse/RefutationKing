@extends('layouts.layout')

@section('content')
<div class="container">
	<div class="content">
		<div class="m-b-md">
			<h1>議論テーマ一覧</h1>
		</div>
		<div class="links">
			@foreach ($themes as $thema)
			<a type="button" class="btn-thema"
				href="{{ route('rooms.index', ['thema' => $thema]) }}">{{$thema->name}}</a>
			</br>
			@endforeach
		</div>
		<a class="btn btn-primary btn-lg btn-m" href={{ route('themes.create')}}>議論テーマを作成する</a>
	</div>
</div>
@endsection
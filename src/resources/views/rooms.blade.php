@extends('layouts.layout')

@section('content')
<div class="flex-center position-ref full-height">
	<div class="content">
		<div class="m-b-md">
			<h1>議論テーマ</h1>
			<h2>「{{$current_thema->name}}」</h2>
			<h3>※下記よりルームを選択するか、ルームを作成してください。</h3>
		</div>
		<div class="links">
			@foreach ($rooms as $room)
			
			<a type="button" class="btn btn-light btn-m"
			{{-- href="{{ route('rooms.index', ['id' => $room->id]) }}" --}}
				>{{$room->name}}</a>
			</br>
			@endforeach

		</div>
		<button class="btn btn-primary btn-lg btn-m">ルームを作成する</button>
	</div>
</div>
@endsection
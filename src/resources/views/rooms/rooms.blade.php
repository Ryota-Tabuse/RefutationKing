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
			<a type="button" class="btn btn-light btn-m" {{-- href="{{ route('rooms.index', ['id' => $room->id]) }}"
				--}}>{{$room->name}}</a>
			</br>
			@endforeach
		</div>
		<a class="btn btn-primary btn-lg btn-m"
			href={{ route('rooms.create',['thema_id' => $current_thema->id])}}>ルームを作成する</a>
	</div>
</div>
@endsection
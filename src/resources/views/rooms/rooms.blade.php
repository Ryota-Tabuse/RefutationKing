@extends('layouts.layout')

@section('content')
<div class="flex-center position-ref full-height">
	<div class="content">
		<div class="m-b-md">
			<h1>議論テーマ</h1>
			<h2>「{{$current_thema->name}}」</h2>
			<h3>※下記よりルームを選択するか、ルームを作成してください。</h3>
		</div>
		<form action="{{ route('rooms.join',['thema_id' => $current_thema->id]) }}" method="post">
			@csrf
			<hr>
			@foreach ($rooms as $room)
			<div>
				<button type="submit" class="btn btn-primary btn-lg btn-m" name="option" value="option_a"
					{{ isset($room->option_a_user_id) ? 'disabled' : '' }}>{{$current_thema->option_a}}
				</button>
				{{$room->name}}
				<button type="submit" class="btn btn-primary btn-lg btn-m" name="option" value="option_b"
					{{ isset($room->option_b_user_id) ? 'disabled' : '' }}>{{$current_thema->option_b}}
				</button>
				<input type="hidden" name="room_id" value={{$room->id}}>
			</div>
			<hr>
			@endforeach
		</form>
		<a class="btn btn-primary btn-lg btn-m"
			href={{ route('rooms.create',['thema_id' => $current_thema->id])}}>ルームを作成する</a>
	</div>
</div>
@endsection
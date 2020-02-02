@extends('layouts.layout')

@section('content')
<div class="full-height container">
	<div class="content">
		<div class="m-b-md">
			<h2>議論テーマ</h1>
				<h3>「{{$current_thema->name}}」</h3>
				<p>※下記よりルームを選択するか、ルームを作成してください。</p>
		</div>
		<form action="{{ route('rooms.join',['thema_id' => $current_thema->id]) }}" method="post">
			@csrf
			<hr>
			@foreach ($rooms as $room)
			<div>
				{{-- 自分が参加=>赤 自分が不参加=>青 --}}
				<button type="submit"
					class="btn btn-primary btn-lg btn-m {{$room->option_a_user_id === Auth::id() ? 'btn-success' : 'btn-primary'}} "
					name="option" value="option_a"
					{{ ($room->option_a_user_id === Auth::id() && $room->option_b_user_id !== Auth::id()) ? '' : 'disabled'}}>
					<!-- TODO 条件が複雑なため、Controller側に移植すること -->
					{{$current_thema->option_a}}
				</button>
				{{$room->name}}
				<button type="submit"
					class="btn btn-primary btn-lg btn-m {{$room->option_b_user_id === Auth::id() ? 'btn-success' : 'btn-primary'}} "
					name="option" value="option_b"
					{{ ($room->option_b_user_id === Auth::id() && $room->option_a_user_id !== Auth::id()) ? '' : 'disabled'}}>
					<!-- TODO 条件が複雑なため、Controller側に移植すること -->
					{{$current_thema->option_b}}
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
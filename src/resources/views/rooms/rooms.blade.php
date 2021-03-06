@extends('layouts.layout')

@section('content')
<div class="full-height container">
	<div class="content">
		<div class="m-b-md">
			<h1>議論テーマ</h1>
			@if ($errors->any())
			<div class="alert alert-danger tx-align-l">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif
			<h3>「{{$current_thema->name}}」</h3>
			<p>※青いボタンから議論を開始するか、ルームを作成してください。</p>
		</div>
		<hr>
		@foreach ($rooms as $room)
		<form action="{{ route('rooms.join',['thema' => $current_thema]) }}" method="post">
			@csrf
			<div>
				<p>{{$room->name}}</p>
				{{-- 自分が参加=>緑 自分が不参加=>青 --}}
				{{-- TODO リファクタリング --}}
				<button type="submit"
					class="btn btn-primary btn-lg btn-m {{$room->option_a_user_id === Auth::id() ? 'btn-success' : 'btn-primary'}} "
					name="option" value="option_a"
					{{ ($room->option_a_user_id === Auth::id() || ($room->option_b_user_id !== Auth::id() && empty($room->option_a_user_id))) ? '' : 'disabled'}}>
					<!-- TODO 条件が複雑なため、Controller側に移植すること -->
					{{$current_thema->option_a}}
				</button>
				<input type="hidden" name="room_id" value={{$room->id}}>

				<button type="submit"
					class="btn btn-primary btn-lg btn-m {{$room->option_b_user_id === Auth::id() ? 'btn-success' : 'btn-primary'}} "
					name="option" value="option_b"
					{{ ($room->option_b_user_id === Auth::id() || ($room->option_a_user_id !== Auth::id() && empty($room->option_b_user_id))) ? '' : 'disabled'}}>
					<!-- TODO 条件が複雑なため、Controller側に移植すること -->
					{{$current_thema->option_b}}
				</button>
			</div>
			<hr>
		</form>
		@endforeach
		<a class="btn_original bg-gray-blue btn-lg btn-m"
			href={{ route('rooms.create',['thema_id' => $current_thema->id])}}>ルームを作成する</a>
	</div>
</div>
@endsection
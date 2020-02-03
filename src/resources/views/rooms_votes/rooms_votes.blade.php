@extends('layouts.layout')

@section('content')
<div class="full-height container">
	<div class="content">
		<div class="m-b-md">
			<h2>投票可能一覧</h1>
		</div>
		@foreach ($end_discuss_room_by_thema_id as $thema)
		<dt>{{ $key }}</dt>
		@endforeach
	</div>
</div>
@endsection
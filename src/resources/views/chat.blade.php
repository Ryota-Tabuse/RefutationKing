@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		</div>
	</div>

	{{--  チャットルーム  --}}
	<div id="room">
		@foreach($comments as $key => $comment)
		{{--   送信したメッセージ  --}}
		@if($comment->sending_user_id == Auth::id())
		<div class="send" style="text-align: right">
			<p>{{$comment->content}}</p>
		</div>

		@endif

		{{--   受信したメッセージ  --}}
		@if($comment->recieving_user_id == Auth::id())
		<div class="recieve" style="text-align: left">
			<p>{{$comment->content}}</p>
		</div>
		@endif
		@endforeach
	</div>

	<form>
		@csrf
		<textarea name="comment" style="width:80%"></textarea>
		<button type="submit" id="btn_send">送信</button>
	</form>

	<input type="hidden" name="send" value="{{$param['send']}}">
	<input type="hidden" name="room_id" value="{{$room_id}}">
	<input type="hidden" name="recieve" value="{{$param['recieve']}}">
	<input type="hidden" name="login" value="{{Auth::id()}}">

</div>

@endsection

@section('footer')
<script type="text/javascript">
	//ログの有効化
		// Pusher.logToConsole = true;

		// //Pusher初期化
		// var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
		// 	cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
		// 	forceTLS: true,
		// 	encrypted: true,
		// });

		// //購読するチャンネルを指定する。
		// var pusherCannel = pusher.subscribe('chat-channel');

		// //イベント受信後下記の処理を実行
		// pusherChannel.bind('chat_event', (data) => {
		// 	let appendText;
		// 	//input hiddenより、ログインユーザを取得
		// 	let login = $('input[name="login"]').val();

		// 	//受け取ったメッセージによって出し分ける
		// 	if(data.dend == login) {
		// 		appendText = '<div class="send" style="text-align:right"><p>' + data.message + '</p></div>';
		// 	}else if(data.recieve == login) {
		// 		appendText = '<div class="recieve" style="text-align:left"><p>' + data.message + '</p></div>';
		// 	}else{
		// 		return false;
		// 	}

		// 	//最下部にメッセージ表示
		// 	$("#room").append(appendText);

		// 	if(data.recieve === login) {
		// 		//ブラウザへプッシュ通知を行う
		// 		Push.create("新着メッセージ",
		// 			{
		// 				body: data.message,
		// 				timeout:8000,
		// 				onClick: () => {
		// 					window.focus();
		// 					this.close();
		// 				}
		// 			});
		// 	}
		// });

		// $.ajaxSetup({
		// 	headers : {
		// 		'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content');
		// 	}
		// });

		//メッセージ送信
		$('#btn_send').on('click', function() {
			console.log('送信ぼたん押下⭐︎');
			// // 大枠：$.ajax({}).done({}).fail({});
			// $.ajax({
			// 	type : 'POST',
			// 	url : '/chat/create',
			// 	data : {
			// 		message : $('textarea[name="message"]').val(),
			// 		send : $('input[name="send"]').val(),
			// 		recieve : $('input[name="recieve"]').val(),
			// 	}
			// }).done(function(result) {
			// 	$('textarea[name="message"]').val('');
			// }).fail(function(result){
			// 	//エラー
			// });

		});

</script>
@endsection
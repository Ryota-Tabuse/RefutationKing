@extends('layouts.layout')

@section('content')
<div class="container">
	<div class="content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h2>{{$thema->name}}</h2>
			</div>
		</div>

		{{--  チャットルーム  --}}
		<div id="room">
			@foreach($comments as $key => $comment)
			{{--   送信したメッセージ  --}}
			@if($comment->sending_user_id == Auth::id())
			<div class="send comment-box_send" style="text-align: right">
				<p>{{$comment->content}}</p>
			</div>

			{{--   受信したメッセージ  --}}
			@else
			<div class="recieve comment-box_recieve" style="text-align: left">
				<p class="comment-box_recieve">{{$comment->content}}</p>
			</div>
			@endif
			@endforeach
		</div>

		<form>
			@csrf
			<textarea class="chat_textarea" name="comment" style="width:80%"></textarea>
			<button type="button" class="btn_chat" id="btn_send" onclick="send_btn_click();">送信</button>
		</form>

		<input type="hidden" name="send" value="{{$param['send']}}">
		<input type="hidden" name="room_id" value="{{$room->id}}">
		<input type="hidden" name="recieve" value="{{$param['recieve']}}">
		<input type="hidden" name="login" value="{{Auth::id()}}">
	</div>


</div>

@endsection

@section('footer')
@parent
<script type="text/javascript">
	//ログの有効化
	Pusher.logToConsole = true;

	//Pusher初期化
	var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
		cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
		encrypted: true,
	});

	//購読するチャンネルを指定する。
	var pusherChannel = pusher.subscribe('chat');
	console.log(pusherChannel);
 
	//イベントを受信したら、下記処理
	let recieveUser = '';
	pusherChannel.bind('chat_event', function(data) {

		let appendText;
		let login = $('input[name="login"]').val();

		if(data.send === login){
			appendText = '<div class="send comment-box_send" style="text-align:right"><p>' + data.message + '</p></div> ';
		}else{
			appendText = '<div class="recieve comment-box_recieve" style="text-align:left"><p>' + data.message + '</p></div> ';
		}

		// メッセージを表示
		$("#room").append(appendText);

		if(data.recieve === login){
			// ブラウザへプッシュ通知
			Push.create("新着メッセージ",
				{
					body: data.message,
					timeout: 8000,
					onClick: function () {
						window.focus();
						this.close();
					}
				})

		}


	});

	$.ajaxSetup({
		headers : {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
	}});

		//メッセージ送信
		function send_btn_click() {
			console.log('送信ぼboboん押下');
			// 大枠：$.ajax({}).done({}).fail({});
			$.ajax({
				type : 'POST',
				url : '/chat/create',
				data : {
					content : $('textarea[name="comment"]').val(),
					send : $('input[name="send"]').val(),
					recieve : $('input[name="recieve"]').val(),
					room_id : $('input[name="room_id"]').val(),
				}

			}).done(function(result) {
				$('textarea[name="message"]').val('');
				console.log('done');

			}).fail(function(result){
				//エラー
				console.log(result);
			});

		};

</script>

@endsection
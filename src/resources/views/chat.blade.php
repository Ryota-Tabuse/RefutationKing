@extends('layouts.layout')

@section('content')
<div class="container">
	<div class="content">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-sm-10 col-md-8">
				<h1>{{$thema->name}}</h1>
				<div class="row">
					@if ($room->option_a_user_id == Auth::id())
					<div class="col col-md-6">
						<h2>⇦ {{$thema->option_b}}</h2>
					</div>
					<div class="col col-md-6">
						<h2>{{$thema->option_a}} ⇨</h2>
					</div>
					@else
					<div class="col col-md-6">
						<h2>⇦ {{$thema->option_a}}</h2>
					</div>
					<div class="col col-md-6">
						<h2>{{$thema->option_b}} ⇨</h2>
					</div>
					@endif
				</div>
				{{--  チャットルーム  --}}
				<div id="room" class="bg-blue">
					@foreach($comments as $key => $comment)
					{{--   送信したメッセージ  --}}
					@if($comment->sending_user_id == Auth::id())
					<div class="send comment-box_send">
						<p class="comment">{{$comment->content}}</p>
					</div>

					{{--   受信したメッセージ  --}}
					@else
					<div class="recieve comment-box_recieve">
						<p class="comment">{{$comment->content}}</p>
					</div>
					@endif
					@endforeach
				</div>

				<form>
					@csrf
					<div class="chat-textarea row">
						<div class="col-md-9">
							<textarea class="chat_textarea" name="comment" style="width:80%"></textarea>
						</div>
						<div class="col-md-3">
							<a class="bg-gray-blue color-light-blue btn-lg" href="#" id="btn_send"
								onclick="send_btn_click();">送信</a>
						</div>
					</div>
				</form>

				<input type="hidden" name="send" value="{{$param['send']}}">
				<input type="hidden" name="room_id" value="{{$room->id}}">
				<input type="hidden" name="recieve" value="{{$param['recieve']}}">
				<input type="hidden" name="login" value="{{Auth::id()}}">
			</div>
		</div>
		<div class="col-md-2"></div>
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
				$('textarea[name="comment"]').val('');
				console.log('done');

			}).fail(function(result){
				//エラー
				console.log(result);
			});

		};

</script>

@endsection
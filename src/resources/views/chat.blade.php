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
 
	<form action="{{ route('chat.createComment',['thema_id' => $thema_id,'room_id' => $room_id])}}" method="post">
		@csrf
        <textarea name="comment" style="width:80%"></textarea>
        <button type="submit" id="btn_send">送信</button>
    </form>
 
    {{-- <input type="hidden" name="send" value="{{$param['send']}}">
    <input type="hidden" name="recieve" value="{{$param['recieve']}}"> --}}
    <input type="hidden" name="login" value="{{\Illuminate\Support\Facades\Auth::id()}}">
 
</div>
 
@endsection
{{-- @section('footer')
    @parent
    <script type="text/javascript">
 
       //ログを有効にする
       Pusher.logToConsole = true;

       // Pusherキー
        var pusher = new Pusher('ec978af07aea03756221', {
            cluster  : 'ap3',
            encrypted: true
        });
    
       //購読するチャンネルを指定
       var pusherChannel = pusher.subscribe('chat');
 
       //イベントを受信したら、下記処理
       pusherChannel.bind('chat_event', function(data) {
 
           let appendText;
           let login = $('input[name="login"]').val();
 
           if(data.send === login){
               appendText = '<div class="send" style="text-align:right"><p>' + data.message + '</p></div> ';
           }else if(data.recieve === login){
               appendText = '<div class="recieve" style="text-align:left"><p>' + data.message + '</p></div> ';
           }else{
               return false;
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

        // メッセージ送信
        $('#btn_send').on('click' , function(){
            $.ajax({
                type : 'POST',
                url : '/chat/send',
                data : {
                    message : $('textarea[name="message"]').val(),
                    send : $('input[name="send"]').val(),
                    recieve : $('input[name="recieve"]').val(),
                }
            }).done(function(result){
                console.log(`◆◆◆resulet：${result}◆◆◆`);
                $('textarea[name="message"]').val('');
            }).fail(function(result){
                console.log('◆◆◆PostFaild◆◆◆');
            });
        });

    </script>
 
@endsection --}}

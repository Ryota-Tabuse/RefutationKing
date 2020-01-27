<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(int $recieving_user_id)
    {
        // チャットの画面
        $loginId = Auth::id();
 
        // 送信 / 受信のメッセージを取得する
        $query = Comment::where('sending_user_id' , $loginId)->where('recieving_user_id' , $recieving_user_id);
        $query->orWhere(function($query) use($loginId , $recieving_user_id){
            $query->where('sending_user_id' , $recieving_user_id);
            $query->where('recieving_user_idq' , $loginId);
 
        });
 
        $messages = $query->get();
 
        return view('chat' , [
            'messages' => $messages
        ]);
    }

    public function createMessage()
    {
        // // チャットの画面
        // $loginId = Auth::id();
 
        // // 送信 / 受信のメッセージを取得する
        // $query = Comment::where('sending_user_id' , $loginId)->where('recieving_user_id' , $recieving_user_id);
        // $query->orWhere(function($query) use($loginId , $recieving_user_id){
        //     $query->where('sending_user_id' , $recieving_user_id);
        //     $query->where('recieving_user_idq' , $loginId);
 
        // });
 
        // $messages = $query->get();
 
        // return view('chat' , [
        //     'messages' => $messages
        // ]);
    }
}

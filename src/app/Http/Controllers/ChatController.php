<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index(int $thema_id, int $room_id)
    {
        //部屋にひもづくメッセージの取得
        $room_comments = Comment::where('room_id', $room_id)->get();
        // //送信したメッセージを
        Log::alert($room_comments);

        return view('chat', [
            'thema_id' => $thema_id,
            'room_id' => $room_id,
            'comments' => $room_comments
        ]);
    }

    public function createComment(Request $request)
    {
        $room_id = $request->room_id;
        //部屋にひもづくメッセージの取得
        $room_comments = Comment::where('room_id', $room_id)->get();

        $comment = new Comment();
        $comment->content = $request->comment;
        $comment->room_id = $room_id;
        $comment->sending_user_id = Auth::id();
        $current_room = Room::find($room_id);

        //自分ではないユーザを取得し、recieving_user_idに挿入
        $temp_user_id = $current_room->option_a_user_id;
        if ($temp_user_id != Auth::id()) {
            $comment->recieving_user_id = $temp_user_id;
        } else {
            $comment->recieving_user_id = $current_room->option_b_user_id;
        }
        
        $comment->save();

        return view('chat', [
            'thema_id' => $request->thema_id,
            'room_id' => $request->room_id,
            'comments' => $room_comments
        ]);
    }
}

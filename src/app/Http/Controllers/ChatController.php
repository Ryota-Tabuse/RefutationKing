<?php

namespace App\Http\Controllers;

use App\Thema;
use App\Room;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\ChatMessageRecieved;

class ChatController extends Controller
{
    public function index(Thema $thema, Room $room)
    {
        //部屋を取得
        $current_room = Room::find($room->id);
        //部屋にひもづくメッセージの取得
        $room_comments = Comment::orderBy('created_at')->where('room_id', $room->id)->get();
        $param = [
            'send' => Auth::id(),
            'recieve' => self::getRecieveUserId($current_room),
        ];

        return view('chat', [
            'param' => $param,
            'thema_id' => $thema->id,
            'room_id' => $room->id,
            'comments' => $room_comments,
        ]);
    }

    public function createComment(Request $request)
    {
        $insertParam = [
            'content' => $request->content,
            'sending_user_id' => $request->send,
            'recieving_user_id' => $request->recieve,
            'room_id' => $request->room_id,
        ];

        try {
            //値のインサート
            Comment::insert($insertParam);
        } catch (\Exception $e) {
            return false;
        }

        //イベントを投げる
        event(new ChatMessageRecieved($request->all()));

        return 'true';
    }

    private function getRecieveUserId(Room $current_room)
    {
        //roomのどちらがが自分の前提でoptionAのユーザを仮ユーザとする
        $temp_user_id = $current_room->option_a_user_id;
        //仮ユーザが自分ではない場合、そのまま返却する。
        if ($temp_user_id != Auth::id()) {
            return $temp_user_id;
        }
        //仮ユーザが自分である場合、部屋に入っているもう一人を返却する。
        else {
            return $current_room->option_b_user_id;
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Thema;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public const OPTION_A = 'option_a';
    public const OPTION_B = 'option_b';

    public function index(int $thema_id)
    {
        //選択されたお題を取得する
        $current_thema = Thema::find($thema_id);
        //お題に紐づく議論部屋一覧を取得
        $rooms = Room::where('thema_id', $current_thema->id)->get();

        //議論部屋選択画面に遷移
        return view('rooms/rooms', [
            'current_thema' => $current_thema,
            'rooms' => $rooms,
        ]);
    }

    public function showCreateForm(int $thema_id)
    {
        //選択されたお題を取得する
        $current_thema = Thema::find($thema_id);
        return view('rooms/create', [
            'current_thema' => $current_thema,
        ]);
    }

    public function createRoom(Request $request)
    {

        //選択されたお題を取得する
        $current_thema = Thema::find($request->thema_id);

        //インスタンス化
        $room = new Room();
        $room->name = $request->name;
        $room->thema_id = $current_thema->id;
        //賛成選択肢を取得し、対象の選択肢にユーザIDを保存
        $select_option = $request->option;
        $room = self::assignUserIdByOption($room, $select_option);
        $room->save();

        $rooms = Room::where('thema_id', $current_thema->id)->get();

        return view('rooms/rooms', [
            'rooms' => $rooms,
            'current_thema' => $current_thema,
        ]);
    }

    public function joinRoom(Request $request)
    {
        //賛成した選択肢を取得
        $select_option = $request->option;
        //参加したroomを取得
        $joinRoom = Room::find($request->room_id);
        //賛成した選択肢にuserを保存
        Log::alert($select_option);
        Log::alert(self::OPTION_B);

        $joinRoom = self::assignUserIdByOption($joinRoom, $select_option);
        Log::alert($joinRoom);
        $joinRoom->save();
        return view('chat');
    }

    private function assignUserIdByOption(Room $room, string $select_option)
    {
        if (strcmp($select_option, self::OPTION_A) == 0) {
            $room->option_a_user_id = Auth::id();
        } else if (strcmp($select_option, self::OPTION_B == 0)) {
            $room->option_b_user_id = Auth::id();
        } else {
            throw new Exception('不正な送信です。');
        }
        return $room;
    }
}

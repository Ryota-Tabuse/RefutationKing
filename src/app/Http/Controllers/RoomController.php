<?php

namespace App\Http\Controllers;

use App\Thema;
use App\Room;
use Illuminate\Http\Request;
use App\Http\Requests\CreateRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    public const OPTION_A = 'option_a';
    public const OPTION_B = 'option_b';
    public const ADD_DATE = 1;

    public function index(Thema $thema)
    {
        //TODO 現状はログインユーザ限定とする。
        if (Auth::id() === null) {
            return redirect()->route('login');
        }
        //選択されたお題を取得する
        $current_thema = Thema::find($thema->id);
        //お題に紐づく議論部屋一覧を取得
        $rooms = Room::where('thema_id', $current_thema->id)->get();

        //議論部屋選択画面に遷移
        return view('rooms/rooms', [
            'current_thema' => $current_thema,
            'rooms' => $rooms,
        ]);
    }

    public function showCreateForm(Thema $thema)
    {
        //選択されたお題を取得する
        $current_thema = Thema::find($thema->id);

        return view('rooms/create', [
            'current_thema' => $current_thema,
        ]);
    }

    public function createRoom(CreateRoom $request)
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
        //議論終了の制限時間を24時間後とする
        $room->end_datetime_discussion = Carbon::now()->addDay();
        //保存
        $room->save();

        return redirect()->route('chat.index', [
            'thema' => $current_thema,
            'room' => $room,
        ]);
    }

    public function joinRoom(Request $request)
    {
        Log::alert('ルーム参加');

        //賛成した選択肢を取得
        $select_option = $request->option;
        //参加したroomを取得
        $joinRoom = Room::find($request->room_id);
        //賛成した選択肢にuserを保存

        $joinRoom = self::assignUserIdByOption($joinRoom, $select_option);
        $joinRoom->save();

        //コメントを受け取るユーザを取得し、値を渡す。
        $recieving_user_id = '';
        if (strcmp($select_option, self::OPTION_A) == 0) {
            $recieving_user_id = $joinRoom->option_b_user_id;
        } elseif (strcmp($select_option, self::OPTION_B == 0)) {
            $recieving_user_id = $joinRoom->option_a_user_id;
        } else {
            throw new Exception('不正な送信です。');
        }

        return redirect()->route('chat.index', [
            'thema' => $request->thema,
            'room' => $joinRoom,
        ]);
    }

    private function assignUserIdByOption(Room $room, string $select_option)
    {
        if (strcmp($select_option, self::OPTION_A) == 0) {
            $room->option_a_user_id = Auth::id();
        } elseif (strcmp($select_option, self::OPTION_B == 0)) {
            $room->option_b_user_id = Auth::id();
        } else {
            throw new Exception('不正な送信です。');
        }

        return $room;
    }
}

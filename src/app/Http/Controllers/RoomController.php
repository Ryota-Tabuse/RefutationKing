<?php

namespace App\Http\Controllers;

use App\Thema;
use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
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
        return view('rooms/create',[
            'current_thema' => $thema_id
        ]);
    }

    public function createRoom(Request $request) {

        //選択されたお題を取得する
        $current_thema = Thema::find($request->thema_id);
        //インスタンス化
        $room = new Room();
        $room->name = $request->name;
        $room->thema_id = $current_thema->id;
        $room->save();

        $rooms = Room::where('thema_id', $current_thema->id)->get();

        return view('rooms/rooms',[
            'rooms' => $rooms,
            'current_thema' => $current_thema,
        ]);
    }
}

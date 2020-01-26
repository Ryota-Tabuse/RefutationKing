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
        return view('rooms', [
            'current_thema' => $current_thema,
            'rooms' => $rooms,
        ]);
    }

    public function createRoom() {
        
    }
}

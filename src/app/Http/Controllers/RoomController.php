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
    /**
     * $room_status
     * 部屋A、Bステータス
     * 1.empty 2.someone 3.me.
     */
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
        //賛成した選択肢を取得
        $select_option = $request->option;
        //参加するroomを取得
        $joinRoom = Room::find($request->room_id);
        //参加するルームに自分以外のユーザがいる場合はエラーを返す。
        if (!self::isJoinOK($joinRoom, $select_option)) {
            $errors[] = 'ルームに参加できません';

            return redirect()->back()->withInput()->withErrors($errors);
        }
        //参加するルームが自分の場合は、保存しない。
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

    //選択した選択肢によって
    private function assignUserIdByOption(Room $room, string $select_option)
    {
        //選んだ選択肢がAなら、Aの部屋にログインユーザIDを詰める
        if (self::isOptionA($select_option)) {
            $room->option_a_user_id = Auth::id();
        }
        //選んだ選択肢がAなら、Aの部屋にログインユーザIDを詰める
        elseif (self::isOptionB($select_option)) {
            $room->option_b_user_id = Auth::id();
        }
        //それ以外のデータは不正とみなす
        else {
            throw new Exception('不正な送信です。');
        }

        return $room;
    }

    /*
     * 指定した部屋に自分以外のユーザがいる場合：true
     * 指定した部屋に自分orユーザなし：false
     */
    private function isJoinOK(Room $room, string $select_option)
    {
        $option_a_user_id = $room->option_a_user_id;
        $option_b_user_id = $room->option_b_user_id;
        //選択肢Aの場合
        if (self::isOptionA($select_option)) {
            if ($option_a_user_id === null) {
                //もう一つの選択肢が自分でないなら参加OK
                return !self::isLoginUser($option_b_user_id);
            } else {
                //自分だったらそのまま参加OK
                return self::isLoginUser($option_a_user_id);
            }
        }
        //選択肢Bの場合
        elseif (self::isOptionB($select_option)) {
            if ($option_b_user_id === null) {
                //もう一つの選択肢が自分でないなら参加OK
                return !self::isLoginUser($option_a_user_id);
            } else {
                //自分だったらそのまま参加OK
                return self::isLoginUser($option_b_user_id);
            }
        } else {
            throw new Exception('不正な送信です。');
        }

        return $room;
    }

    //選択した値は選択肢Aかどうか
    private function isOptionA(string $select_option)
    {
        if (strcmp($select_option, self::OPTION_A) === 0) {
            return true;
        } else {
            return false;
        }
    }

    //選択した値は選択肢Bかどうか
    private function isOptionB(string $select_option)
    {
        if (strcmp($select_option, self::OPTION_B) === 0) {
            return true;
        } else {
            return false;
        }
    }

    //ユーザはログインユーザと同じかどうか
    private function isLoginUser(string $user_id = null)
    {
        if ($user_id === null) {
            return false;
        }

        if ($user_id == Auth::id()) {
            Log::alert('LoginUser');

            return true;
        } else {
            Log::alert('No：LoginUser');

            return false;
        }
    }
}

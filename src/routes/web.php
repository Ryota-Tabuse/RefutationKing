<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//トップページ
Route::get('/', function () {
    return view('welcome');
});

//ログイン機能
Auth::routes();
Route::get('/home', function () {
    return view('welcome');
})->name('home');

//投票可能部屋一覧
Route::get('/rooms_votes', 'RoomVoteController@index');

//お題画面
Route::get('/themes', 'ThemaController@index')->name('themes');
Route::get('/themes/create', 'ThemaController@showCreateForm')->name('themes.create');
Route::post('/themes/create', 'ThemaController@createThema')->name('themes.create');

//議論部屋一覧画面
Route::get('themes/{thema}/rooms', 'RoomController@index')->name('rooms.index');
Route::get('themes/{thema}/rooms/create', 'RoomController@showCreateForm')->name('rooms.create');
Route::post('themes/{thema_id}/rooms/create', 'RoomController@createRoom')->name('rooms.create');
Route::post('themes/{thema_id}/rooms/join', 'RoomController@joinRoom')->name('rooms.join');

//議論部屋チャット画面
Route::get('themes/{thema}/rooms/{room}/chat', 'ChatController@index')->name('chat.index');
Route::post('/chat/create', 'ChatController@createComment')->name('chat.createComment');

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
Route::get('/home', 'HomeController@index')->name('home');

//お題画面
Route::get('/themes', 'ThemaController@index')->name('themes');

//議論部屋一覧画面
Route::get('themes/{thema_id}/rooms', 'RoomController@index')->name('rooms.index');

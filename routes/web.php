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

Route::get('/', function () {

    $wechat = app('wechat.official_account');
    $qrcode = $wechat->qrcode;
    $result = $qrcode->temporary('foo', 3600);
    return $result;
    return view('welcome');
});
Route::any('/wechat', 'WeChatController@serve');

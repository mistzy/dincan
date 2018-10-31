<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
//商品路由
Route::get("/shopp/index","Api\ShoppController@index");
Route::get("/shopp/detail","Api\ShoppController@detail");
//注册短信验证
Route::get("/member/sms","Api\MemberController@sms");
//注册加登录
Route::post('/member/reg','Api\MemberController@reg');
Route::post('/member/login','Api\MemberController@login');
//修改密码
Route::post('/member/edit','Api\MemberController@edit');
//遗忘密码
Route::post('/member/forget','Api\MemberController@forget');


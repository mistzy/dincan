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
//region 商品路由
Route::get("/shopp/index","Api\ShoppController@index");
Route::get("/shopp/detail","Api\ShoppController@detail");
//endregion

//region 用户注册添加
//注册短信验证
Route::get("/member/sms","Api\MemberController@sms");
//注册加登录
Route::post('/member/reg','Api\MemberController@reg');
Route::post('/member/login','Api\MemberController@login');
//修改密码
Route::post('/member/edit','Api\MemberController@edit');
//遗忘密码
Route::post('/member/forget','Api\MemberController@forget');
//用户积分和余额
Route::get("/member/detail","Api\MemberController@detail");
//endregion

//region 收货地址
//回显加显示
Route::get('/addresslist/echo','Api\AddressListController@echo');
Route::get('/addresslist/index','Api\AddressListController@index');
//修改加添加
Route::post('/addresslist/add','Api\AddressListController@add');
Route::post('/addresslist/edit','Api\AddressListController@edit');
//endregion

// region 购物车
Route::post("cart/add","Api\CartController@add");
Route::get("cart/index","Api\CartController@index");
//endregion

// region 订单
Route::post("order/add","Api\OrderController@add");
Route::get("order/detail","Api\OrderController@detail");
Route::get("order/index","Api\OrderController@index");
Route::post("order/pay","Api\OrderController@pay");
Route::get("order/wxPay","Api\OrderController@wxPay");
Route::get("order/status","Api\OrderController@status");
Route::post("order/ok","Api\OrderController@ok");












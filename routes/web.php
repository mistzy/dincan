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
    return view('welcome');
});
Route::domain("Shop.diancan.com")->namespace("Shop")->group(function (){
    //region 商户首页
    Route::get("/index/index", "IndexController@index")->name("shop.index.index");
    //商家注册登陆
    Route::any("/user/login", "UserController@login")->name("shop.user.login");
    Route::any("/user/add","UserController@add")->name("shop.user.add");


    //商铺增删改查
    Route::any("/shopp/add","ShoppController@add")->name("shop.shopp.add");
//    Route::get("/shopp/index", "ShoppController@index")->name("shop.shopp.index");

});

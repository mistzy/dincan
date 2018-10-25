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

//商户路由
Route::domain("shop.diancan.com")->namespace("Shop")->group(function (){
    //region 商户首页
    Route::get("index/index", "IndexController@index")->name("shop.index.index");
    //商家注册登陆
    Route::any("/user/login", "UserController@login")->name("shop.user.login");
    Route::any("/user/add","UserController@add")->name("shop.user.add");


    //商铺增删改查
    Route::any("/shopp/add","ShoppController@add")->name("shop.shopp.add");
    Route::get("/shopp/index", "ShoppController@index")->name("shop.shopp.index");


});

//管理员路由
Route::domain("admin.diancan.com")->namespace("Admin")->group(function (){

    //商铺分类
    Route::get('shop_category/index', "ShopCategoryController@index")->name('admin.shop_category.index');
    Route::any("shop_category/add","ShopCategoryController@add")->name("admin.shop_category.add");
    Route::any("shop_category/edit/{id}","ShopCategoryController@edit")->name("admin.shop_category.edit");
    Route::get('shop_category/del/{id}', "ShopCategoryController@del")->name('admin.shop_category.del');


    //管理员登录
    Route::any('admin/login', "AdminController@login")->name('admin.admin.login');
    Route::get('admin/index', "AdminController@index")->name('admin.admin.index');
    Route::any('admin/add', "AdminController@add")->name('admin.admin.add');
    Route::get('admin/del/{id}', "AdminController@del")->name('admin.admin.del');


    //店铺处理
    Route::get('shop/index', "ShoppController@index")->name('admin.shop.index');
    Route::any('shop/edit/{id}', "ShoppController@edit")->name('admin.shop.edit');
    Route::get('shop/del/{id}', "ShoppController@del")->name('admin.shop.del');
    Route::get('shop/sh/{id}', "ShoppController@sh")->name('admin.shop.sh');


    //用户处理
    Route::get('user/index', "UserController@index")->name('admin.user.index');



});


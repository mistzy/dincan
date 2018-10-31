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
    return view('index');
});

Route::get("test",function(){
    return \Illuminate\Support\Facades\Cache::get("trl_");
});

//商户路由
Route::domain("shop.diancan.com")->namespace("Shop")->group(function (){
    //region 商户首页
    Route::get("index/index", "IndexController@index")->name("shop.index.index");
    //商家注册登陆
    Route::any("/user/login", "UserController@login")->name("shop.user.login");
    Route::any("/user/add","UserController@add")->name("shop.user.add");
    Route::any('user/edit', "UserController@edit")->name('shop.user.edit');
    Route::get('user/logout', "UserController@logout")->name('shop.user.logout');


    //商铺增删改查
    Route::any("/shopp/add","ShoppController@add")->name("shop.shopp.add");
    Route::get("/shopp/index", "ShoppController@index")->name("shop.shopp.index");
    Route::any('/shopp/edit/{id}', "ShoppController@edit")->name('shop.shopp.edit');
    Route::any("/shopp/upload", "MenuController@upload")->name('shop.shopp.upload');


    //菜单分类增删改查
    Route::get('cate/index', "MenuCategoriesController@index")->name('shop.cate.index');
    Route::any("cate/add","MenuCategoriesController@add")->name("shop.cate.add");
    Route::any("cate/edit/{id}","MenuCategoriesController@edit")->name("shop.cate.edit");
    Route::get('cate/del/{id}', "MenuCategoriesController@del")->name('shop.cate.del');


    //菜品增删改查
    Route::get("menu/index","MenuController@index")->name("shop.menu.index");
    Route::any("menu/add","MenuController@add")->name("shop.menu.add");
    Route::any("menu/edit/{id}","MenuController@edit")->name("shop.menu.edit");
    Route::get("menu/del/{id}","MenuController@del")->name("shop.menu.del");
    Route::any("menu/upload", "MenuController@upload")->name('shop.menu.upload');






});

//管理员路由
Route::domain("admin.diancan.com")->namespace("Admin")->group(function (){

    //商铺分类
    Route::get('shop_category/index', "ShopCategoryController@index")->name('admin.shop_category.index');
    Route::any("shop_category/add","ShopCategoryController@add")->name("admin.shop_category.add");
    Route::any("shop_category/edit/{id}","ShopCategoryController@edit")->name("admin.shop_category.edit");
    Route::get('shop_category/del/{id}', "ShopCategoryController@del")->name('admin.shop_category.del');
    Route::any("shop_category/upload", "ShopCategoryController@upload")->name('admin.shop_category.upload');


    //管理员登录/退出
    Route::any('admin/login', "AdminController@login")->name('admin.admin.login');
    Route::get('admin/logout', "AdminController@logout")->name('admin.admin.logout');

    //管理员增删改查
    Route::get('admin/index', "AdminController@index")->name('admin.admin.index');
    Route::any('admin/add', "AdminController@add")->name('admin.admin.add');
    Route::any('admin/editl/{id}', "AdminController@editl")->name('admin.admin.editl');
    Route::get('admin/del/{id}', "AdminController@del")->name('admin.admin.del');
    //管理员修改密码
    Route::any('admin/edit', "AdminController@edit")->name('admin.admin.edit');


    //店铺处理
    Route::get('shop/index', "ShoppController@index")->name('admin.shop.index');
    Route::any('shop/add/{id}', "ShoppController@add")->name('admin.shop.add');
    Route::any('shop/edit/{id}', "ShoppController@edit")->name('admin.shop.edit');
    Route::get('shop/del/{id}', "ShoppController@del")->name('admin.shop.del');
    Route::get('shop/sh/{id}', "ShoppController@sh")->name('admin.shop.sh');
    Route::get('shop/jy/{id}', "ShoppController@jy")->name('admin.shop.jy');
    Route::any("shop/upload", "ShoppController@upload")->name('admin.shop.upload');


    //用户处理
    Route::get('user/index', "UserController@index")->name('admin.user.index');
    Route::get('user/del/{id}', "UserController@del")->name('admin.user.del');


    //活动增删改查
    Route::get('huodong/index', "HuodongController@index")->name('admin.huodong.index');
    Route::any('huodong/add', "HuodongController@add")->name('admin.huodong.add');
    Route::any('huodong/edit/{id}', "HuodongController@edit")->name('admin.huodong.edit');
    Route::get('huodong/del/{id}', "HuodongController@del")->name('admin.huodong.del');



});


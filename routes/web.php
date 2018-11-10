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
//    return \Illuminate\Support\Facades\Cache::get("trl_");
    $shopName="互联网学院";
    $to = '2399418940@qq.com';//收件人
    $subject = $shopName.' 审核通知';//邮件标题
    \Illuminate\Support\Facades\Mail::send(
        'emails',
        compact("shopName"),
        function ($message) use($to, $subject) {
            $message->to($to)->subject($subject);
        }
    );
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


    //订单查看
    Route::get("order/index","OrderController@index")->name("shop.order.index");
    Route::get('order/day', "OrderController@day")->name('shop.order.day');
    Route::get('order/total', "OrderController@total")->name('shop.order.total');
    Route::get('order/months', "OrderController@months")->name('shop.order.months');
    Route::get('order/changeStatus/{id}/{status}', "OrderController@changeStatus")->name('shop.order.changeStatus');
    Route::get('order/detail/{id}', "OrderController@detail")->name('shop.order.detail');
    //菜品总计
    Route::get('order/cday', "OrderController@cday")->name('shop.order.cday');

    //抽奖活动
    Route::any("user/active", "UserController@active")->name("shop.user.active");
    //   抽奖活动
    Route::any("user/luck", "UserController@luck")->name("shop.user.luck");
    //  参与
    Route::any("user/inter/{id}", "UserController@inter")->name("shop.user.inter");
    //   中奖名单
    Route::any("user/prize", "UserController@prize")->name("shop.user.prize");








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


    //会员管理
    Route::get('member/index', "MemberController@index")->name('admin.member.index');

   //订单
    Route::get('/order/month','OrderController@month')->name('admin.order.month');
    Route::any('/order/day','OrderController@day')->name('admin.order.day');
    Route::any('/order/total','OrderController@total')->name('admin.order.total');


    //权限管理
    Route::get('per/index', "PerController@index")->name('admin.per.index');
    Route::any('per/add', "PerController@add")->name('admin.per.add');
    Route::any('per/edit/{id}', "PerController@edit")->name('admin.per.edit');
    Route::get('per/del/{id}', "PerController@del")->name('admin.per.del');


    //角色管理
    //权限管理
    Route::get('role/index', "RoleController@index")->name('admin.role.index');
    Route::any('role/add', "RoleController@add")->name('admin.role.add');
    Route::any('role/edit/{id}', "RoleController@edit")->name('admin.role.edit');
    Route::get('role/del/{id}', "RoleController@del")->name('admin.role.del');


    //导航菜单管理
    Route::any('nav/add', "NavController@add")->name('admin.nav.add');

    //抽奖活动管理
    Route::get('event/index', "EventController@index")->name('admin.event.index');
    Route::any('event/add', "EventController@add")->name('admin.event.add');
    Route::any('event/edit/{id}', "EventController@edit")->name('admin.event.edit');
    Route::get('event/del/{id}', "EventController@del")->name('admin.event.del');
    Route::get('event/kj/{id}', "EventController@kj")->name('admin.event.kj');

    //抽奖活动奖品
    Route::get('prize/index', "EventPrizeController@index")->name('admin.prize.index');
    Route::any('prize/add', "EventPrizeController@add")->name('admin.prize.add');
    Route::any('prize/edit/{id}', "EventPrizeController@edit")->name('admin.prize.edit');
    Route::get('prize/del/{id}', "EventPrizeController@del")->name('admin.prize.del');



});


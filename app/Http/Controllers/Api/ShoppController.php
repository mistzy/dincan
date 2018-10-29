<?php

namespace App\Http\Controllers\Api;

use App\Models\MenuCategories;
use App\Models\Shopp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShoppController extends Controller
{
    //
    public function index(){

      //  dd(11);
        //得到所有店铺 设置状态为1
        $shops = Shopp::where("status",1)->get();

//        dd(111);
        //增加 距离  时间
        foreach ($shops as $k => $v){
            $shops[$k]->shop_img = $v->shop_img;
            $shops[$k]->distance = rand(1000, 5000);
            $shops[$k]->estimate_time = ceil($shops[$k]['distance'] / rand(100, 150));
        }
//        dd($shops->toArray());
        return $shops;

    }

    //连接店铺内容
    public function detail(){
        //得到菜品id
        $id = request()->get("id");
        //$id = 21;
        $shop = Shopp::find($id);
        //dd($shop);
        $shop->shop_img=env("ALIYUN_OSS_URL").$shop->shop_img;//店铺图片
        $shop->service_code = 4.6; //评分
        $shop->evaluate = [
            [
                "user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 1,
                "send_time" => 30,
                "evaluate_details" => "不怎么好吃"],
            ["user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 4.5,
                "send_time" => 30,
                "evaluate_details" => "很好吃"]
        ];
        $cates=MenuCategories::where("shop_id",$id)->get();
        //当前分类有哪些商品
        foreach ($cates as $k=>$cate){
            $cates[$k]->goods_list=$cate->goods;
        }
        $shop->commodity=$cates;
        //dd($shop) ;
        return $shop;
        // dd($shop->toArray());

    }
}

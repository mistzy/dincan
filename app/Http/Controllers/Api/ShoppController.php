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

        $keyword = \request("keyword");
        if ($keyword!=null) {
            $shops = Shopp::where("status",1)->where("shop_name","like","%{$keyword}%")->get();
        }else {
            //得到所有店铺，状态为1的

            //  dd(11);
            //得到所有店铺 设置状态为1
            $shops = Shopp::where("status", 1)->get();
//        dd(111);
        }
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
        $shop->shop_img=$shop->shop_img;//店铺图片
        $shop->service_code = 4.6; //评分
        $shop->evaluate = [
            [
                "user_id" => 12344,
                "username" => "张三",
                "user_img" => "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time" => "2018-2-2",
                "evaluate_code" => 1,
                "send_time" => 30,
                "evaluate_details" => "好吃"],
            ["user_id" => 12344,
                "username" => "李四",
                "user_img" => "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 4.5,
                "send_time" => 50,
                "evaluate_details" => "很好吃"],
            ["user_id" => 12344,
                "username" => "王五",
                "user_img" => "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-28",
                "evaluate_code" => 4.5,
                "send_time" => 20,
                "evaluate_details" => "买到就赚到"],
            ["user_id" => 12344,
                "username" => "周六",
                "user_img" => "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-25",
                "evaluate_code" => 4.5,
                "send_time" => 90,
                "evaluate_details" => "特别不错，一下子买了一百斤，不要问我为什么，爷就是有钱"],
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

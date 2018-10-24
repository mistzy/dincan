<?php

namespace App\Http\Controllers\Shop;


use App\Models\ShopCategory;
use App\Models\Shopp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShoppController extends BaseController
{
    //
    public function add(Request $request){

        //判定此用户是否已有店铺
        if (Auth::user()->shopp) {
            return redirect()->back()->with("danger", "已有店铺不能再创建");
        }
        if ($request->isMethod("post")){
            //1. 验证
            $this->validate($request,[

            ]);

            //2. 接收数据
            $data=$request->post();
            //3.设置店铺状态为0 未审核
            $data['status'] = 0;
            //设置用户id
            $data['user_id'] = Auth::user()->id;
            //接收图片
            $data['shop_img']=$request->file("shop_img")->store("images","image");
//         dd($data);
            //3. 入库
            Shopp::create($data);
            //添加成功
            session()->flash('success',"添加成功等待审核");

            //4. 跳转
            return redirect()->route("shop.shopp.index");

        }
        //得到所有分类F
        $fleis= ShopCategory::all();
        return view("shop.shopp.add",compact("fleis"));
    }






}

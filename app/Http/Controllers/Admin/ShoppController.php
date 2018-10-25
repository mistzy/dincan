<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShopCategory;
use App\Models\Shopp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ShoppController extends BaseController
{

    public function index(){
        //得到所有商家
        $shops = Shopp::all();
        //跳转视图
        return view('admin.shop.index',compact('shops'));
    }

    //审核
    public function sh($id){

        $shop =Shopp::findOrFail($id);
        $shop->static = 1;
        //返回视图
        return back()->with("success", "通过审核");
    }

    //修改店铺
    public function edit(Request $request,$id)
    {
        //找一个
        $shops =Shopp::find($id);

        //判断post
        if ($request->isMethod("post")) {
            //dd($request->all());
            //健壮性
            $this->validate($request, [

            ]);
            //添加
            $data = $request->post();
            //接收图片
            $logo = $request->file("shop_img");
            if ($logo) {
                //删除原来图片
                Storage::delete($shops['shop_img']);
                //赋值
                $data['shop_img'] = $logo->store("images");
//
            }
            //入库
//            $data['shop_category_id']=3;
//            $data['shop_name']=66;
            if ($shops->update($data)) {
                //4. 跳转
                return redirect()->route("admin.shop.index")->with("success", "编辑成功");
            }




        }

            //显示视图
            $fleis= ShopCategory::where("status",1)->get();
            return view('admin.shop.edit',compact("shops","fleis"));


    }

    //删除店铺
    public function del($id){
        //删除
        $shop = Shopp::findOrFail($id)->delete();
        //跳转视图
        return redirect()->route("admin.shop.index")->with("success","删除成功");
    }


}

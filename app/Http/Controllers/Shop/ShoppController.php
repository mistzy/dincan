<?php

namespace App\Http\Controllers\Shop;


use App\Models\ShopCategory;
use App\Models\Shopp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShoppController extends BaseController
{
    //店铺显示
    public function index(){
//        dd(Auth::id());
        $shop=DB::table("shopps")->where('user_id',Auth::id())->first();
//        $shop=$data;
//         dd($shop);
        //  dd($data->id);
        //dd($data->shop_category_id);
//        ShopCategory::where('id',$data->shop_category_id)->first();
//        dd(ShopCategory::where('id',$data->shop_category_id)->first()->name);
        $name=ShopCategory::where('id',$shop->shop_category_id)->first()->name;
        return view("shop.shopp.index",compact("shop","name"));
    }

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
                    $data['shop_img']=$request->file("shop_img")->store("images");
//         dd($data);
                    //3. 入库
                    Shopp::create($data);
                    //添加成功
                    session()->flash('success',"添加成功等待审核");

                    //4. 跳转
                    return redirect()->route("shop.index.index");

        }
        //得到所有分类
        $fleis= ShopCategory::where("status",1)->get();
        return view("shop.shopp.add",compact("fleis"));
    }
    public function edit(Request $request,$id)
    {
        //找一个
        $shop =Shopp::find($id);

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

                Storage::delete($shop['shop_img']);
                //赋值
                $data['shop_img'] = $logo->store("images");
//
            }
            //入库
//            $data['shop_category_id']=3;
//            $data['shop_name']=66;
            // dd($data);
            if ($shop->update($data)) {
                //4. 跳转
                return redirect()->route("shop.shopp.index")->with("success", "编辑成功");
            }
        }

        //显示视图
        $cates= ShopCategory::all();
        return view('shop.shopp.edit',compact("shop","cates"));

    }





}

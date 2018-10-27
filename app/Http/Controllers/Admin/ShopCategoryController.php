<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShopCategory;
use App\Models\Shopp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ShopCategoryController extends BaseController
{
    //商铺分类
    public function index(){
        //找到所有数据
        $shops = ShopCategory::all();
        //回显视图
        return view("admin.shop_category.index",compact('shops'));
    }
    //添加分类
    public function add(Request $request){
        //判定提交方式
        if ($request->isMethod("post")){
            //验证
            $this->validate($request,[

            ]);
            //接收数据
            $data = $request->post();
            //接收图片
            $data['imh']=$request->file("imh")->store("images");
            //入库
            ShopCategory::create($data);
            //跳转视图
            return redirect()->route("admin.shop_category.index")->with("success","添加成功");

        }
        return view("admin.shop_category.add");

    }
    //修改
    public function edit(Request $request,$id)
    {
        //找一个
        $shops = ShopCategory::find($id);

        //判断post
        if ($request->isMethod("post")) {
            //健壮性
            $this->validate($request, [

            ]);
            //添加
            $data = $request->post();
            //接收图片
            $logo = $request->file("imh");
            if ($logo) {
                //删除原来图片
                Storage::delete($shops['imh']);
                //赋值
                $data['imh'] = $logo->store("images");
//
            }
            if ($shops->update($data)) {
                //跳转
                session()->flash("success", "修改成功");
                return redirect()->route("admin.shop_category.index");
            }
        } else {
            //显示视图
            return view('admin.shop_category.edit',compact("shops"));
        }

    }
    //删除
    public function del($id){
        //得到当前分类
        $cate=ShopCategory::findOrFail($id);
        //得到当前分类对应的店铺数
        $shopCount=Shopp::where('shop_category_id',$cate->id)->count();
        //判断当前分类店铺数
        if ($shopCount){
            //回跳
            return  back()->with("danger","当前分类下有店铺，不能删除");
        }
        //否则删除
        $cate->delete();

        //跳转
        return redirect()->route('admin.shop_category.index')->with('success',"删除成功");
    }



}

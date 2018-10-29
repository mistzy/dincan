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
        $shop->status= 1;
        $shop->save();
        //返回视图
        return back()->with("success", "通过审核");
    }
    public function jy($id){

        $shop =Shopp::findOrFail($id);
        $shop->status= 2;
        $shop->save();
        //返回视图
        return back()->with("success", "你已被禁用");
    }

    //修改店铺
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
//        $logo = $request->file("shop_img");
//        if ($logo) {
//            //删除原来图片
//            Storage::delete($shop['shop_img']);
//            //赋值
//            $data['shop_img'] = $logo->store("images");
////
//        }
        //入库
//            $data['shop_category_id']=3;
//            $data['shop_name']=66;
        // dd($data);
        if ($data['shop_img']==null) {
            unset($data['shop_img']);
        }
        if ($shop->update($data)) {
            //4. 跳转
            return redirect()->route("admin.shop.index")->with("success", "编辑成功");
        }
    }

    //显示视图
    $cates= ShopCategory::all();
    return view('admin.shop.edit',compact("shop","cates"));

}

    public function upload(Request $request)
    {
        //处理上传
        //dd($request->file("file"));
        $file=$request->file("file");
//        dd($file);
        if ($file){
            //上传
            $url=$file->store("menu");
            // var_dump($url);
            //得到真实地址  加 http的址
//            $url=Storage::url($url);
            $data['url']=env("ALIYUN_OSS_URL").$url;
            return $data;
            ///var_dump($url);
        }
    }

//后台添加店铺
    public function add(Request $request,$id)
    {
        //得到所有店铺分类信息
        $shop = ShopCategory::all();
//        //得到所有商家信息
//        $users = User::all();
        //post提交
        if ($request->isMethod('post')) {

            //验证数据
            $this->validate($request, [

            ]);
            //接受数据
            $data = $request->post();
            $data['user_id']=$id;
            $data['status']=1;
//            //接受图片
//            $data['shop_img']=$request->file("shop_img")->store("images");
            //提交数据
            if (Shopp::create($data)) {
                //提示
                session()->flash('success', '添加成功');
                return redirect()->route('admin.user.index');
            }

        }
        //显示视图
        $cates= ShopCategory::all();
        return view('admin.shop.add', compact('shop',"cates"));
    }




    //删除店铺
    public function del($id){
        //删除
        $shop = Shopp::findOrFail($id)->delete();
        //跳转视图
        return redirect()->route("admin.shop.index")->with("success","删除成功");
    }


}

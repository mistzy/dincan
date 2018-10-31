<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategories;
use App\Models\Shopp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends BaseController
{
//显示
    public function index(Request $request)
    {
        $id = Auth::user()->id;
        //查找当前用户店铺
        $shopp = Shopp::where('user_id',$id)->first();
        $cate = MenuCategories::all()->where("shop_id", $shopp->id);
//        $query=Menu::all()->where("shop_id",$id);
        $url = $request->query();
        //接收数据
        $cateId = $request->get("good_id");
        $keyword = $request->get("keyword");
        $min = $request->get("minPrice");
        $max = $request->get("maxPrice");
        //得到所有并要有分页
        $query = Menu::orderBy("id")->where("shop_id", $shopp->id);

        if ($keyword !== null) {
            $query->where("goods_name", "like", "%{$keyword}%");
        }
        if ($cateId !== null) {
            $query->where("category_id", $cateId);
        }
        if ($max !== null) {

            $query->where("goods_price", "<=", $max);
        }
        if ($min !== null) {

            $query->where("goods_price", ">=", $min);
        }
        $goods = $query->paginate(2);

        return view("shop.menu.index", compact("cate", "goods", "url"));
    }

//增加
    public function add(Request $request)
    {
        $id = Auth::user()->id;
        $shopp = Shopp::where('user_id',$id)->first();
        $data = MenuCategories::all()->where("shop_id", $shopp->id);
        if ($request->isMethod("post")) {
            $this->validate($request, [
                "goods_name" => "required|unique:menus",
                "category_id" => "required",
                "goods_price" => "required",
                "description" => "required",
                "tips" => "required",
                "goods_img" => "required",
                "status" => "required"
            ]);
            $da = $request->post();
//           dd($da);

//            $file = $request->file("goods_img");
//            $da['goods_img'] = $file->store("images");
            $da['shop_id'] = $shopp->id;
//           dd($da);
            Menu::create($da);
            //返回
            return redirect()->route("shop.menu.index")->with("success", "添加菜单分类成功");
        }


        return view("shop.menu.add", compact("data"));
    }

//修改
    public function edit(Request $request, $id)
    {
        //读取一条数据
        $data = Menu::find($id);
        //把分类读出来
        $id = Auth::id();
        $da = MenuCategories::all()->where("shop_id", $id);
//        dd($da);
        if ($request->isMethod("post")) {
            $this->validate($request, [
                "goods_name" => "required",
                "category_id" => "required",
                "goods_price" => "required",
                "description" => "required",
                "tips" => "required",
                "status" => "required"
            ]);
            $da = $request->post();
//            $file = $request->file("goods_img");
//            //接收图片
//            $logo = $request->file("goods_img");
//            if ($logo) {
//                //删除原来图片
//                Storage::delete($data['goods_img']);
//                //赋值
//                $data['goods_img'] = $logo->store("images");
////
//            }
            if ($da['goods_img']==null){
                unset($da['goods_img']);
            }
            $da['shop_id'] = Auth::id();
//           dd($da);
            $data->update($da);
            //返回
            return redirect()->route("shop.menu.index")->with("success", "添加菜单分类成功");
        }


        return view("shop.menu.edit", compact("data", "da"));
    }


//删除

    public function del(Request $request, $id)
    {
        //查询一条
        $on = Menu::find($id);
        $img = $on['goods_img'];
//        unlink($img);
        $on->delete();
        //返回
        session()->flash("success", "删除成功");
        return redirect()->route("shop.menu.index");
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


}

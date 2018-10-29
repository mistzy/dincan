<?php

namespace App\Http\Controllers\Shop;

use App\Models\MenuCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MenuCategoriesController extends BaseController
{

    //显示数据
    public function index()
    {
        $id=Auth::id();
//        dd($id);
        $cates=MenuCategories::all()->where("store_id",$id);
//        dd($data);
        return view("shop.cate.index",compact("cates"));
    }

//增加
    public function add(Request $request)
    {
        if($request->isMethod("post")){

            $this->validate($request,[
                "name"=>"required|unique:users",
                "type_accumulation"=>"required",
                "description"=>"required"
            ]);
            $data=$request->post();
//            dd($data);
            //向数据中增加登陆者的id
            $data['store_id']=Auth::id();
//            dd($data);
            MenuCategories::create($data);
            //返回
            return redirect()->route("shop.cate.index")->with("success","添加菜单分类成功");
        }

        return view("shop.cate.add");
    }

    //编辑
    public function edit(Request $request,$id)
    {
        $cate=MenuCategories::find($id);
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required|unique:users",
                "type_accumulation"=>"required",
                "description"=>"required"
            ]);
            $data=$request->post();
            $cate->update($data);
            //返回
            return redirect()->route("shop.cate.index")->with("success","修改菜单分类成功");
        }
        return view("shop.cate.edit",compact("cate"));
    }

    //删除
    public function del($id)
    {

        $cate = MenuCategories::find($id);
        if ($cate->cate == null) {
            $cate->delete();
            return redirect()->route("shop.cate.index")->with("success", "删除成功");
        } else {
            return redirect()->route("shop.cate.index")->with("success", "该分类下有菜品");
        }
    }

    }

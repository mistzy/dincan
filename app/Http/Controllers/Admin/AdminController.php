<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Routing\Route;
use Illuminate\Support\Facades\Auth;


class AdminController extends BaseController
{

    public function index()
    {
        $admins = Admin::all();
        //跳转视图
        return view('admin.admin.index', compact('admins'));

    }


    //添加
    public function add(Request $request){
    if ($request->isMethod("post")) {
        //1.验证
        $this->validate($request, [
            "name" => "required|unique:users",
            "password" => "required|min:6",
        ]);
        //2.接收数据
        $data = $request->post();
        //3.密码加密
        $data['password'] = bcrypt($data['password']);
        //4.添加
        Admin::create($data);
        //5.跳转
        return redirect()->route("admin.admin.index")->with("success", "添加成功");

    }
    return view("admin.admin.add");
}


    //删除
    public function del($id){
        //初始管理员不能被删
        if ($id == 1) {
            return back()->with("danger", "不能删除初始管理员");
        }
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect()->route('admin.admin.index')->with("success", "删除成功");
    }


    //登录
    public function login(Request $request)
    {
        //判断是否POST提交
        if ($request->isMethod("post")){
            //验证健壮性
            $data = $this->validate($request,[
                "name" => "required",
                "password" => "required"

            ]);
            //验证账号密码
            if (Auth::attempt($data,$request->has("remember"))){
                return redirect()->route("admin.admin.index")->with("success", "登录成功");
            }else{
                return redirect()->route("admin.admin.login")->with("danger", "账号或密码错误");

            }
        }
        return view("admin.admin.login");

    }



}

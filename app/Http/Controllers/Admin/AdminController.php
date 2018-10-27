<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
            // 验证账号密码
//            dd($data);
            if (Auth::guard("admin")-> attempt($data)){
                return redirect()->route("admin.admin.index")->with("success","登录成功");
            }else{
                return redirect()->back()->withInput()->with("danger","账号或密码错误");
            }
        }
        return view("admin.admin.login");
    }

    //修改密码
    public function edit(Request $request)
    {
        //判断是否POST提交
        if ($request->isMethod("post")) {
            //1.验证
            $this->validate($request, [
                'old_password' => 'required',
                'password' => 'required|confirmed'
            ]);
            //2.得到当前用户对象
            $admin = Auth::guard('admin')->user();
            $oldPassword = $request->post('old_password');
            //3.判断老密码是否正确
            if (Hash::check($oldPassword, $admin->password)) {
                //3.1如果老密码正确 设置新密码
                $admin->password = Hash::make($request->post('password'));
                //3.2 保存修改
                $admin->save();
                //3.3 跳转
                return redirect()->route('admin.admin.index')->with("success", "修改密码成功");
            }
            //旧密码不正确
            return back()->with("danger", "旧密码不正确");
        }

        return view('admin.admin.edit');

    }

    //退出管理员
    public function logout()
    {
        //注销
        Auth::logout();
        //跳转并设置成功提示
        return redirect()->route("admin.admin.login")->with("success", "成功退出");
    }

    //修改管理员
    public function editl(Request $request,$id){
        $admins=Admin::findOrFail($id);


        if ($request->isMethod("post")){
            //验证
            $this->validate($request,[
                "name"=>"required",
                "email"=>"required",

            ]);

            //2. 接收数据
            $data=$request->post();
            //3. 入库
            $admins->update($data);
            //4. 跳转
            return redirect()->route("admin.admin.index")->with("success","编辑成功");

        }

        return view("admin.admin.editl",compact('admins'));
    }






}

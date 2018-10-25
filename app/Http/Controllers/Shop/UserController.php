<?php

namespace App\Http\Controllers\Shop;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    //注册商户
    public function add(Request $request){
        if ($request->isMethod("post")) {
            //1.验证
            $this->validate($request, [
                "name" => "required|unique:users",
                "password" => "required|min:6|confirmed",
            ]);
            //2.接收数据
            $data = $request->post();
            //3.密码加密
            $data['password'] = bcrypt($data['password']);
            //4.添加
            User::create($data);
            //5.跳转
            return redirect()->route("shop.user.login")->with("success", "注册成功");

        }
        return view("shop.user.add");
    }
    //登陆
    public function login(Request $request)
    {
        if ($request->isMethod("post")) {

            //dd($request->has("remember"));
            //1. 验证
            $data = $this->validate($request, [
                "name" => "required",
                "password" => "required"
            ]);

            //2. 验证账号密码是否正确
            // dd(Auth::attempt(["name"=>$request->post('name'),"password"=>$request->post("password")]));
//              if (Auth::guard("")->attempt($data)){
              if (Auth::attempt($data,$request->has("remember"))){
                      //登录成功
                      return redirect()->intended(route("shop.index.index"))->with("success","登录成功请注册商铺");
                  }else{
                      //登录失败
                      //session()->flash("danger","账号或密码错误");
                      return redirect()->back()->withInput()->with("danger","账号或密码错误");
                  }
              }



        return view("shop.user.login");
    }


}

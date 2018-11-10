<?php

namespace App\Http\Controllers\Shop;

use App\Models\Event;
use App\Models\EventPrize;
use App\Models\EventUser;
use App\Models\Huodong;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

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
            //验证账号密码
            if (Auth::attempt($data)) {
                //当前登录用户Id
                $user = Auth::user();   //Auth::user()=============User::find(2)
                $shop = $user->shopp;
                //通过用户找店铺
                if ($shop) {
                    //如果有店铺 状态 2 0 1
                    switch ($shop->status) {
                        case 2:
                            //禁用
                            Auth::logout();
                            return back()->withInput()->with("danger", "店铺已禁用");
                            break;
                        case 0:
                            //未审核
                            Auth::logout();
                            return back()->withInput()->with("danger", "店铺还未通过审核");
                            break;
                    }
                } else {
                    //跳转到申请店铺
                    return redirect()->route("shop.shopp.add")->with("danger","还未申请店铺");
                }
                // session()->flash("success","登录成功");
                //登录成功
                return redirect()->intended(route("shop.index.index"))->with("success", "登录成功");
            }
        }

        return view("shop.user.login");
    }
    //注销
    public function logout()
    {
        Auth::logout();
        return redirect()->route("shop.user.login");
    }
//重置密码
    //修改密码
    public function edit(Request $request){
        //判断是否POST提交
        if ($request->isMethod("post")) {
            //1.验证
            $this->validate($request, [
                'old_password' => 'required',
                'password' => 'required|confirmed'
            ]);
            //2.得到当前用户对象
            $users = Auth::guard('user')->user();
            $oldPassword = $request->post('old_password');
            //3.判断老密码是否正确
            if (Hash::check($oldPassword, $users->password)) {
                //3.1如果老密码正确 设置新密码
                $users->password = Hash::make($request->post('password'));
                //3.2 保存修改
                $users->save();
                //3.3 跳转
                return redirect()->route('shop.user.index')->with("success", "修改密码成功");
            }
            //旧密码不正确
            return back()->with("danger", "旧密码不正确");
        }

        return view('shop.user.edit');

    }
    //活动
    public function active()
    {
        //当前时间
        $time = date('Y-m-d H:i:s', time());
//dd($time);
        $exercise = Huodong::where("end_time", ">", $time)->get();

//        dd($exercise);

        return view("shop.user.active", compact("exercise"));
    }

    //抽奖
    public function luck()
    {
        //显示抽奖活动，遍历出活动，在视图里面写上参与
        $active = Event::all();
//        dd($active);
        return view("shop.user.luck", compact("active"));

    }

    //参与
    public function inter($id)
    {
        //商户id
        $shopId = Auth::id();
        //活动id就是id
        $data['user_id'] = $shopId;
        $data['event_id'] = $id;

        //判断人数限制
        //找出该活动的限制人数
        $limitNum =Event::where('id',$id)->first()->num;
//        dd($limitNum);
        //把限制人得数据存到redis
        Redis::set("event_num:$id",$limitNum);
        //用redis来做大并发问题或者说抢购报名问题
        //限制人数
        $num = Redis::get("event_num:".$id);
        //报名人数
        $user =Redis::scard("event:".$id);
        //如果redis里面有就用redis没有就数据库找
        if($user){
            $user =Redis::scard("event:".$id);
        }else{
            //数据库得报名数
            $user=EventUser::where("user_id",$shopId)->count();
        }
        //判断
        if($user<$num){
            //存reids 集合 用redis得集合不会出现重复得
            Redis::sadd("event:".$id,$shopId);
            return redirect()->route("shop.user.luck")->with("info","参与成功");
        }else{
            return redirect()->route("shop.user.luck")->with("danger","人数已满");
        }

    }

    //中奖名单
    public function prize()
    {
        $prize = EventPrize::all();

        return view("shop.user.prize", compact("prize"));
    }





}

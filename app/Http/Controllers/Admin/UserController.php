<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shopp;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    //

    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }
    //删除用户
    public function del($id){
        DB::transaction(function () use ($id) {
            //删除用户
            User::findOrFail($id)->delete();
            //在删除用户店铺
            Shopp::where("user_id",$id)->delete();

        });
        return back()->with("success","删除成功");
    }

}

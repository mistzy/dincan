@extends("admin.layouts.main")

@section("title","用户管理")

@section("content")
    <a href="" class="btn btn-primary">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>


                <td>
                    <a href="" class="btn btn-info">编辑</a>
                    <a href="" class="btn btn-danger">删除</a>
                </td>
            </tr>

    @endforeach
    </table>
@endsection
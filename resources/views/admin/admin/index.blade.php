@extends("admin.layouts.main")

@section("title","店铺注册")

@section("content")
    <a href="{{route('admin.admin.add')}}" class="btn btn-primary">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>用户名</th>
            <th>Email</th>
            <th>操作</th>
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>{{$admin->id}}</td>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td>
                    <a href="{{route('admin.admin.editl',$admin->id)}}" class="btn btn-info">编辑</a>
                    @if($admin->id!==1)
                        <a href="{{route('admin.admin.del',$admin->id)}}" class="btn btn-danger">删除</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

@endsection
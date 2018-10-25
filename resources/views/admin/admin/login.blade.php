@extends("admin.layouts.main")

@section("title","平台登录")

@section("content")
    <form method="post" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group">
            <label for="name">账号：</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="password">密码：</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">登录</button>
    </form>

@endsection
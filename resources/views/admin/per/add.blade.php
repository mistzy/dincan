@extends("admin.layouts.main")

@section("title","添加权限")

@section("content")


    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <div class="form-group">
                <label class="col-sm-2 control-label">名称</label>
                <div class="col-sm-10">
                    <select name="name" class="form-control">
                        @foreach($urls as $url)
                            <option value="{{$url}}">{{$url}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">描述</label>
            <div class="col-sm-10">
                <input type="text" name="intro" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">上传</button>
            </div>
        </div>
    </form>

@endsection
@extends("admin.layouts.main")

@section("title","店铺分类添加")

@section("content")
    <a href="{{url()->previous()}}">返回</a>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">商铺分类</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="name" value="{{old("name")}}">
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">分类图片</label>
            <div class="col-sm-10">
                <input type="file" class="form-control"  name="imh">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">是否正常</label>
            <div class="col-sm-10">
                <label class="radio-inline">
                    <input type="radio" name="is_on_sale"  value="1" checked>
                </label>
                <label class="radio-inline">
                    <input type="radio" name="is_on_sale" value="0">
                </label>
            </div>
        </div>



        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">注册</button>
            </div>
        </div>

    </form>



@endsection
@extends("shop.layouts.main")

@section("title","商品添加")

@section("content")

    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}


        <div class="form-group">
            <label class="col-sm-2 control-label">菜品分类名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="name" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">菜品编号</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="type_accumulation" >
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">描述</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="description" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">是否默认分类</label>
            <div class="col-sm-1">
                <input type="radio"  name="is_selected" value="1" checked>是
            </div>
            <div class="col-sm-1">
                <input type="radio"   name="is_selected" value="0">否
            </div>
        </div>




        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </form>


@endsection
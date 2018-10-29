@extends("admin.layouts.main")

@section("title","查看分类")

@section("content")

    {{--<a href="{{route("admin.shop_category.add")}}" class="btn btn-primary">添加</a>--}}
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>名称</th>
            <th>图像</th>
            <th>状态</th>
            <th>排序</th>
            <th>操作</th>
        </tr>

        @foreach($shops as $shop)
            <tr>
                <td>{{$shop->id}}</td>
                <td>{{$shop->name}}</td>
                <td> <img src="{{$shop->imh}}?x-oss-process=image/resize,m_fill,w_80,h_80"></td>
                <td>
                    @if ($shop->status)
                        正常
                    @else
                        禁用
                    @endif
                </td>
                <td>{{$shop->sort}}</td>
                <td>
                    <a href="{{route('admin.shop_category.edit',$shop->id)}}" class="btn btn-info">编辑</a>
                    <a href="{{route('admin.shop_category.del',$shop->id)}}" class="btn btn-danger">删除</a>

                </td>
            </tr>
        @endforeach
    </table>




@endsection
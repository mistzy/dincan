@extends("shop.layouts.main")

@section("title","商品列表")

@section("content")


    <a href="{{route('shop.cate.add')}}" class="btn btn-primary">添加</a>
    <table class="table">

        <tr>
            <th>id</th>
            <th>菜品分类名称</th>
            <th>菜品编号</th>
            <th>描述</th>
            <th>是否是默认分类</th>
            <th>操作</th>
        </tr>
        @foreach($dd as $cate)
            <tr>
                <td>{{$cate->id}}</td>
                <td>{{$cate->name}}</td>
                <td>{{$cate->type_accumulation}}</td>
                <td>{{$cate->description}}</td>
                <td>@if($cate->is_selected==1)
                        是
                    @else
                        否
                    @endif
                </td>
                <td>
                    <a href="{{route('shop.cate.edit',$cate->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route('shop.cate.del',$cate->id)}}" class="btn btn-danger">删除</a>

                </td>
            </tr>
        @endforeach

    </table>


@endsection
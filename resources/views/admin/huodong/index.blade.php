@extends("admin.layouts.main")

@section("title","店铺注册")

@section("content")

    <div class="row">
        <div class="col-md-8">
            <form class="form-inline pull-right" method="get">
                <div class="form-group">
                    <select name="time" class="form-control">
                        <option value="">请选择时间</option>
                        <option value="1">活动进行中</option>
                        <option value="2">已结束活动</option>
                        <option value="3">未开展活动</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control"  placeholder="请输入名称" name="keyword" value="{{request()->get("keyword")}}">
                </div>
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>
        </div>
    </div>

    <a href="{{route('admin.huodong.add')}}" class="btn btn-primary">添加活动</a>
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>活动名称</th>
            <th>活动详情</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($hds as $hd)
            <tr>
                <td>{{$hd->id}}</td>
                <td>{{$hd->title}}</td>
                <td>{{$hd->content}}</td>
                <td>{{$hd->start_time}}</td>
                <td>{{$hd->end_time}}</td>
                <td>
                    <a href="{{route('admin.huodong.edit',$hd->id)}}" class="btn btn-info">编辑</a>

                    <a href="{{route('admin.huodong.del',$hd->id)}}" class="btn btn-danger">删除</a>

                </td>
            </tr>
        @endforeach
    </table>
    {{$hds->links()}}

@endsection
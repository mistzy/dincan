@extends("admin.layouts.main")
@section("title","抽奖活动显示")
@section("content")

    <a href="{{route('admin.prize.add')}}" class="btn btn-primary">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>活动id</th>

            <th>奖品名称</th>
            <th>奖品详情</th>
            <th>中奖商家账号id</th>
            <th>操作</th>
        </tr>
        @foreach($prizes as $prize)
            <tr>
                <td>{{$prize->id}}</td>
                <td>{{$prize->event_id}}</td>
                <td>{{$prize->name}}</td>
                <td>{{$prize->description}}</td>
                <td>{{$prize->user_id}}</td>

                <td>
                    <a href="{{route('admin.prize.edit',$prize->id)}}" class="btn btn-info">编辑</a>
                    <a href="{{route('admin.prize.del',$prize->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
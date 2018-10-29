@extends("admin.layouts.main")

@section("title","店铺审核")

@section("content")

    <table class="table table-bordered">
        <tr>
        <tr><td>id</td>
            <td>名称</td>
            <td>店铺分类ID</td>
            <td>店铺图片</td>
            <td>评分</td>
            <td>是否是品牌</td>
            <td>是否准时送达</td>
            <td>是否蜂鸟配送</td>
            <td>是否保标记</td>
            <td>是否票标记</td>
            <td>是否准标记</td>
            <td>起送金额</td>
            <td>配送费</td>
            <td>店公告</td>
            <td>优惠信息</td>
            <td>是否审核</td>
            <td>用户</td>
            <td>操作</td>


        </tr>
        @foreach($shops as $shop)
            <tr>
                <td>{{$shop->id}}</td>
                <td>{{$shop->shop_name}}</td>
                <td>{{$shop->cate["name"]}}</td>
                <td> <img src="{{$shop->shop_img}}?x-oss-process=image/resize,m_fill,w_80,h_80"></td>
                <td>{{$shop->shop_rating}}</td>
                <td>
                    @if($shop->brand)
                        <i class="glyphicon glyphicon-ok" style="color: green"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                    @endif
                </td>
                <td>
                    @if($shop->on_time)
                        <i class="glyphicon glyphicon-ok" style="color: green"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                    @endif
                </td>
                <td>
                    @if($shop->fengniao)
                        <i class="glyphicon glyphicon-ok" style="color: green"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                    @endif
                </td>
                <td>
                    @if($shop->bao)
                        <i class="glyphicon glyphicon-ok" style="color: green"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                    @endif
                </td>
                <td>
                    @if($shop->piao)
                        <i class="glyphicon glyphicon-ok" style="color: green"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                    @endif
                </td>
                <td>
                    @if($shop->zhun)
                        <i class="glyphicon glyphicon-ok" style="color: green"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                    @endif
                </td>

                <td>{{$shop->start_send}}</td>
                <td>{{$shop->send_cost}}</td>
                <td>{{$shop->notice}}</td>
                <td>{{$shop->discount}}</td>
                <td>
                    @if($shop->status==1)
                        <i class="glyphicon glyphicon-ok" style="color: green"></i>
                    @endif
                    @if($shop->status==0)
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                    @endif
                        @if($shop->status==2)
                            <i class="">禁止</i>
                        @endif
                </td>
                <td>{{$shop->user["name"]}}</td>
                <td>
                    <a href="{{route('admin.shop.edit',$shop->id)}}" class="btn btn-info">编辑</a>
                    <a href="{{route('admin.shop.del',$shop->id)}}" class="btn btn-danger" onclick="return confirm('删除店铺和用户,确认吗？')">删除</a>
                    @if($shop->status===0||$shop->status===2)
                        <a href="{{route('admin.shop.sh',$shop->id)}}" class="btn btn-success">通审</a>
                    @endif
                    @if($shop->status===1)
                        <a href="{{route('admin.shop.jy',$shop->id)}}" class="btn btn-success">禁用</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection
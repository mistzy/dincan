@extends("shop.layouts.main")

@section("title","查询订单")

@section("content")


                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>


                            <th>订单编号</th>
                            <th>收货人</th>
                            <th>地址</th>
                            <th>电话</th>
                            <th>状态</th>
                            <th>金额</th>
                            <th>操作</th>
                        </tr>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>

                                <td>{{$order->order_code}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->provence}}:{{$order->city}}:{{$order->area}}:{{$order->detail_address}}</td>
                                <td>{{$order->tel}}</td>

                                <td>
                                    @if($order->status==-1)已取消@endif
                                    @if($order->status==0)代付款@endif
                                    @if($order->status==1)待发货@endif
                                    @if($order->status==2)待确认@endif
                                    @if($order->status==3)完成@endif
                                </td>

                                <td>{{$order->total}}</td>
                                <td>
                                    <a href="{{route('shop.order.detail',$order->id)}}"
                                       class="btn btn-sm btn-warning">查看</a>
                                        {{--<a href="{{route('shop.order.edit',$order->id)}}" class="btn btn-sm btn-info">编辑</a>--}}
                                    @if($order->status===0)
                                        <a href="{{route('shop.order.changeStatus',[$order->id,1])}}"
                                           class="btn btn-sm btn-info">带付款</a>
                                    @endif
                                    @if($order->status===1)
                                        <a href="{{route('shop.order.changeStatus',[$order->id,2])}}"
                                           class="btn btn-sm btn-primary">发货</a>
                                    @endif
                                    @if($order->status===2)
                                        <a href="{{route('shop.order.changeStatus',[$order->id,3])}}"
                                           class="btn btn-sm btn-success">确定</a>
                                    @endif
                                    @if($order->status!==-1 && $order->status!==3)
                                        <a href="{{route('shop.order.changeStatus',[$order->id,-1])}}"
                                           class="btn btn-sm btn-danger">取消</a>
                                    @endif
                                </td>

                            </tr>
                       @endforeach
                    </table>
                    {{--{{$orders->appends($url)->render()}}--}}

@endsection
@extends("shop.layouts.main")

@section("title","查询订单")

@section("content")
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tbody>
            <tr>
                <th>日期</th>
                <th>订单数</th>
                <th>收入</th>
            </tr>
            @foreach($data as $order)
                <tr>
                    <td>{{$order->date}}</td>

                    <td>{{$order->nums}}</td>
                    <td>{{$order->money}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>

    </div>


@endsection
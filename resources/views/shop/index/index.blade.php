@extends("shop.layouts.main")

@section("title","后台首页")

@section("content")

    <div class="row">
        <div class="col-md-4">
            <a href="{{route("shop.shopp.add")}}" class="btn btn-info">注册商铺</a>
        </div>
    </div>

    <div class="row">
            <div class="col-md-4">
                <a href="{{route("shop.shopp.index")}}" class="btn btn-info">查看商铺</a>
            </div>
    </div>





@endsection
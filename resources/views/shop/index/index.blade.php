@extends("shop.layouts.main")

@section("title","后台首页")

@section("content")
    <div class="row">
            <div class="col-md-4">
                didi
                <a href="{{route("shop.shopp.add")}}" class="btn btn-info">注册商铺</a>
            </div>
    </div>
        @endforeach

@endsection
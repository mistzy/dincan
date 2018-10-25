@extends("shop.layouts.main")

@section("title","店铺修改")

@section("content")
    <a href="{{url()->previous()}}">返回</a>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">店铺名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="shop_name" value="{{$shops->shop_name}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">评分</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="shop_rating" value="{{$shops->shop_rating}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">店铺分类</label>
            <div class="col-sm-10">
                <select name="shop_category_id" class="form-control" >
                    @foreach($fleis as $flei)
                        <option value="{{$flei->id}}">{{$flei->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">店铺图片</label>
            <div class="col-sm-10">
                <input type="file" class="form-control"  name="shop_img">
                <img src="/images/{{$shops->shop_img}}" height="30" width="30">
            </div>

        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">起送价格</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="start_send" value="{{$shops->start_send}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">配送费</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="send_cost" value="{{$shops->send_cost}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">店铺公告</label>
            <div class="col-sm-10">
               <textarea name="notice" class="form-control" value="{{$shops->notice}}">
               </textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">优惠信息</label>
            <div class="col-sm-10">
               <textarea name="discount" class="form-control" value="{{$shops->discount}}">
               </textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-10">
                    <label><input name="brand" type="checkbox" value="1" @if(old('brand')==1) checked @endif>品牌连锁店 </label>
                    <label><input name="on_time" type="checkbox" value="1" @if(old('on_time')==1) checked @endif/>准时送达 </label>
                    <label><input name="fengniao" type="checkbox" value="1" @if(old('fengniao')==1) checked @endif/>蜂鸟配送 </label>
                    <label><input name="bao" type="checkbox" value="1" @if(old('bao')==1) checked @endif/>保 </label>
                    <label><input name="piao" type="checkbox" value="1" @if(old('piao')==1) checked @endif/>票</label>
                    <label><input name="zhun" type="checkbox" value="1" @if(old('zhun')==1) checked @endif/>准 </label>

            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">修改</button>
            </div>
        </div>

    </form>



@endsection
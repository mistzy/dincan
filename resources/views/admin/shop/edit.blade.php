@extends("shop.layouts.main")

@section("title","店铺修改")

@section("content")
    <a href="{{url()->previous()}}">返回</a>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">店铺名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="shop_name" value="{{$shop->shop_name}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">评分</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="shop_rating" value="{{$shop->shop_rating}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">店铺分类</label>
            <div class="col-sm-10">
                <select name="shop_category_id" class="form-control" >
                    @foreach($cates as $cate)
                        <option value="{{$cate->id}}">{{$cate->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">菜单图片
            </label>
            <div class="col-sm-10">
                @if($shop->shop_img)
                    <img src="{{$shop->shop_img}}?x-oss-process=image/resize,m_fill,w_80,h_80">
                @endif
                <input type="hidden" name="shop_img" value="" id="logo">
                <!--dom结构部分-->
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">起送价格</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="start_send" value="{{$shop->start_send}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">配送费</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="send_cost" value="{{$shop->send_cost}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">店铺公告</label>
            <div class="col-sm-10">
               <textarea name="notice" class="form-control" >{{$shop->notice}}
               </textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">优惠信息</label>
            <div class="col-sm-10">
               <textarea name="discount" class="form-control" >{{$shop->discount}}
               </textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-10">
                    <label><input name="brand" type="checkbox" value="1" @if(old('brand')==1) checked @endif>品牌连锁店 </label>
                    <label><input name="on_time" type="checkbox" value="1" @if(old('on_time')==1) checked @endif/>准时送达 </label>
                    <label><input name="fengniao" type="checkbox" value="1" @if(old('fengniao')==1) checked @endif/>蜂鸟配送 </label>
                    <label><input name="bao" type="checkbox" value="1" @if(old('bao')==1) checked @endif/>保 </label>
                    <label><input name="piao" type="checkbox" value=1" @if(old('piao')==1) checked @endif/>票</label>
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
@section("js")
    <script>
        // 图片上传demo
        jQuery(function () {
            var $ = jQuery,
                $list = $('#fileList'),
                // 优化retina, 在retina下这个值是2
                ratio = window.devicePixelRatio || 1,

                // 缩略图大小
                thumbnailWidth = 100 * ratio,
                thumbnailHeight = 100 * ratio,

                // Web Uploader实例
                uploader;

            // 初始化Web Uploader
            uploader = WebUploader.create({

                // 自动上传。
                auto: true,

                formData: {
                    // 这里的token是外部生成的长期有效的，如果把token写死，是可以上传的。
                    _token:'{{csrf_token()}}'
                },


                // swf文件路径
                swf: '/webuploader/Uploader.swf',

                // 文件接收服务端。
                server: '{{route("admin.shop.upload")}}',

                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: '#filePicker',

                // 只允许选择文件，可选。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                }
            });

            // 当有文件添加进来的时候
            uploader.on('fileQueued', function (file) {
                var $li = $(
                    '<div id="' + file.id + '" class="file-item thumbnail">' +
                    '<img>' +
                    '<div class="info">' + file.name + '</div>' +
                    '</div>'
                    ),
                    $img = $li.find('img');

                $list.html($li);

                // 创建缩略图
                uploader.makeThumb(file, function (error, src) {
                    if (error) {
                        $img.replaceWith('<span>不能预览</span>');
                        return;
                    }

                    $img.attr('src', src);
                }, thumbnailWidth, thumbnailHeight);
            });

            // 文件上传过程中创建进度条实时显示。
            uploader.on('uploadProgress', function (file, percentage) {
                var $li = $('#' + file.id),
                    $percent = $li.find('.progress span');

                // 避免重复创建
                if (!$percent.length) {
                    $percent = $('<p class="progress"><span></span></p>')
                        .appendTo($li)
                        .find('span');
                }

                $percent.css('width', percentage * 100 + '%');
            });

            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            uploader.on('uploadSuccess', function (file,data) {
                $('#' + file.id).addClass('upload-state-done');

                $("#logo").val(data.url);
            });

            // 文件上传失败，现实上传出错。
            uploader.on('uploadError', function (file) {
                var $li = $('#' + file.id),
                    $error = $li.find('div.error');

                // 避免重复创建
                if (!$error.length) {
                    $error = $('<div class="error"></div>').appendTo($li);
                }

                $error.text('上传失败');
            });

            // 完成上传完了，成功或者失败，先删除进度条。
            uploader.on('uploadComplete', function (file) {
                $('#' + file.id).find('.progress').remove();
            });
        });
    </script>
@stop

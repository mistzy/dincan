<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">浓森不绿</a>
        </div>


        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理员管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("admin.admin.index")}}">查看</a></li>
                        <li><a href="{{route("admin.admin.add")}}">添加副管理员</a></li>

                    </ul>
                </li>
            </ul>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商铺分类管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("admin.shop_category.index")}}">全显</a></li>
                        <li><a href="{{route("admin.shop_category.add")}}">添加新分类</a></li>
                    </ul>
                </li>
            </ul>



            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商铺管理 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route("admin.shop.index")}}">审核</a></li>

                        </ul>
                    </li>
                </ul>



                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">用户管理 <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route("admin.user.index")}}">查看</a></li>

                            </ul>
                        </li>
                    </ul>



            <ul class="nav navbar-nav navbar-right">
                @auth("admin")
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::guard("admin")->user()->name}}  <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route("admin.admin.edit")}}">修改密码</a></li>

                            <li role="separator" class="divider"></li>
                            <li><a href="{{route("admin.admin.logout")}}">退出登录</a></li>
                        </ul>
                    </li>
                @endauth

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
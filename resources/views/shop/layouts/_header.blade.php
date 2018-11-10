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

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">自家商铺 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("shop.shopp.index")}}">查看店铺</a></li>

                    </ul>
                </li>
            </ul>


            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品分类管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("shop.cate.add")}}">添加分类</a></li>
                        <li><a href="{{route("shop.cate.index")}}">全显</a></li>
                    </ul>
                </li>
            </ul>


            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("shop.menu.add")}}">添加菜品</a></li>
                        <li><a href="{{route("shop.menu.index")}}">全显</a></li>
                    </ul>
                </li>
            </ul>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">订单管理 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route("shop.order.index")}}">查看订单</a></li>

                        </ul>
                    </li>
                </ul>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">订单量统计 <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route("shop.order.day")}}">每日</a></li>
                                <li><a href="{{route("shop.order.months")}}">每月</a></li>
                                <li><a href="{{route("shop.order.total")}}">总订单数</a></li>

                            </ul>
                        </li>
                    </ul>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品消量统计 <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route("shop.order.cday")}}">每日</a></li>
                                    <li><a href="{{route("shop.order.months")}}">每月</a></li>

                                </ul>
                            </li>
                        </ul>


                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">抽奖报名管理 <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{route("shop.user.active")}}">查看</a></li>
                                        <li><a href="{{route("shop.user.luck")}}">参加抽奖活动</a></li>
                                        <li><a href="{{route("shop.user.prize")}}">中奖者</a></li>


                                    </ul>
                                </li>
                            </ul>





            <ul class="nav navbar-nav navbar-right">
                <ul class="nav navbar-nav navbar-right">

                    @auth
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">欢迎:{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route("shop.user.edit")}}">修改密码</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{route("shop.user.logout")}}">注销</a></li>
                            </ul>
                        </li>
                    @endauth
                    @guest
                        <li><a href="{{route("shop.user.login")}}">登录</a></li>
                        <li><a href="{{route("shop.user.add")}}">注册</a></li>
                    @endguest

                </ul>





            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
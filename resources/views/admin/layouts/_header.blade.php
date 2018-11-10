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

        @foreach(\App\Models\Nav::where("pid",0)->get() as $k1=>$v1)
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$v1->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach(\App\Models\Nav::where("pid",$v1->id)->get() as $k2=>$v2)
                        <li><a href="{{route($v2->url)}}">{{$v2->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>

        @endforeach








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
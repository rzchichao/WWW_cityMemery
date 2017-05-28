
<!DOCTYPE HTML>
<html>
<head>
    <title>我的城市记忆</title>
    <link href="{{asset('static/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('static/css/s.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('static/css/comm.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('node_modules/weui/dist/style/weui.css')}}" rel="stylesheet" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <script src="{{asset('static/js/jquery-1.9.1.js')}}"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" ></script>
    <script src="{{asset('static/js/weixinAudio.js')}}"></script>
    <style>
        input,input:focus,input:active{user-select: text}
        .header{
            padding: 0;
            margin: 0;
            height: 45px;
            background-color: #68a468;
        }
        .logo{
            width: 20%;
            float: right;
            padding-top: 7px;
            padding-left: 5%;
        }
        .logo a:link{
            color: #FFFFFF;
            text-decoration: none;
        }
        .logo a:visited{
            color: #FFFFFF;
            text-decoration: none;
        }
        .logo a:after{
            color: #FFFFFF;
            text-decoration: none;
        }
        .logo a span{
            color: #FFFFFF;
            font-size: 1.5em;
            font-weight: 400;
        }
        .user{
            width: 30%;
            float: left;
            padding-left:5px;;
            padding-top: 7px;
        }
        .user a span{
            color: #FFFFFF;
            font-size: 1.7em;
        }
    </style>
</head>
<body >
<div class="container-fully" >
    <nav class="navbar navbar-fixed-top" >
        <div class="header">
            <div class="user">
                <a href="{{url('/mhome')}}">
                    <img src="{{'static/img/user.svg'}}" style="width: 32px;height: 32px;">
                </a>
            </div>
            <div class="logo">
                @if(Request::getPathInfo() == '/mobile')
                <a id="logoa" href="{{url('/mobile_location')}}"><span>发布</span></a>
                @else
                <a id="logoa" href="{{url('/mobile')}}"><span>首页</span></a>
                @endif
            </div>
        </div>
        @yield('search')
    </nav>
    @yield('content')
</div>
</body>
</html>
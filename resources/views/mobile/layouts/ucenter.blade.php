
<!DOCTYPE HTML>
<html>
<head>
    <title>我的城市记忆</title>
    <link href="{{asset('static/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('static/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('static/css/comm.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('node_modules/weui/dist/style/weui.css')}}" rel="stylesheet" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <script src="{{asset('static/js/jquery.min.js')}}"></script>
    <script src="{{asset('static/js/jquery.mobile-events.min.js')}}"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" ></script>
    <script type="text/javascript" src="{{asset('plugin/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('static/js/weixinAudio.js')}}"></script>
    <style>
        input,input:focus,input:active{user-select: text}
        .header{
            padding: 0;
            margin: 0;
            height: 50px;
        }
        .logo{
            width: 70%;
            float: left;
            padding-top: 10px;
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
            padding-left: 18%;
            padding-top: 14px;
        }
        .user a span{
            color: #FFFFFF;
            font-size: 1.7em;
        }
        .ui-loader-default{ display:none}
        .ui-mobile-viewport{ border:none;}
        .ui-page {padding: 0; margin: 0; outline: 0}
    </style>
</head>
<body>
<div class="container-fully">
    <nav class="navbar navbar-fixed-top">
        <div class="header">
            <div class="logo">
                <a id="logoa" href="{{url('/mobile')}}"><span>我的城市记忆</span></a>
            </div>
            <div class="user"><a href="{{url('/mhome')}}"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></div>
        </div>
    </nav>
    @yield('content')
</div>
</body>
</html>
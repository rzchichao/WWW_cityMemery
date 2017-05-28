@extends('layouts.comm')
@section('content')
    <div class="container-fluid" style="padding: 0px;">
        <!--Test -->
        <div id="slide-left">
            @if (Auth::guest())
                <div class="login-bar">
                    <div id="wechat-login" class="wechat">
                        <div id="login_container">
                        </div>
                        <span>微信扫码登录</span>
                    </div>
                </div>
            @else
                <div class="user">
                    <div>
                        <img src="{{asset('/static/images/default-user-headicon.jpg')}}" alt="Esempio"
                             class="img-circle" width="50" height="50">
                    </div>
                    <a href="#" target="_blank" class="navbar-link">test</a>
                </div>
            @endif
        </div>
        <div id="wechat-login-div" style="position: absolute;width: 88%;height: 100px;z-index: 300;padding-top: 150px;padding-left: 30%;display: none;">
            <div style="width:40%;height:300px;background-color: red;">
                <img src="/" alt="">
            </div>
        </div>
        <!--/Test -->
        <div style="width:100%; height:100vh;overflow: hidden;">
            <div id="map-ucenter" style="transform: translate3d(0px, 0px, 0px);width: 100%;height: 100%;"></div>
        </div>
    </div>
@endsection
@extends('mobile.layouts.header')
@section('content')
    <script src="http://webapi.amap.com/maps?v=1.3&key=7b9171cfceb0084db4b9c3a62f6b8810&callback=init"></script>
    <script src="//webapi.amap.com/ui/1.0/main-async.js"></script>
    <script type="text/javascript" src="{{asset('static/js/map/mhome.js')}}"></script>
    <script>
        $(function(){
            wx.config(<?php echo $js->config(array('onMenuShareTimeline'), false) ?>);
            wx.ready(function () {
                wx.onMenuShareTimeline({
                    title: "{{$user->name}}的城市记忆", // 分享标题
                    link: 'http://www.city.rztaiyang.com/mobile', // 分享链接
                    imgUrl: "{{$user->avatar}}", // 分享图标
                    success: function () {
                        // 用户确认分享后执行的回调函数
                    },
                    cancel: function () {
                        // 用户取消分享后执行的回调函数
                    }
                });
            })
        })
    </script>
    <style>
        .weui-grid{padding: 7px 10px;}

    </style>
    <div id="tpl"  style="display: none;background-color: #ffffff;position: fixed;top:45px;z-index: 1040;width: 100%">
    </div>
    <div id="map-ucenter" style="width:100%;z-index: 0;background-color: #FFFFFF;margin-top: 45px;">
    </div>
    <script>
        var height=document.documentElement.clientHeight-188+"px";
        $("#map-ucenter").css('height',height);
    </script>
    <input type="hidden" value="{{$user->id}}" id="user_id">
    <div class="weui-grids">
        <a href="{{url('/mobile_list_dynamic')}}" class="weui-grid">
            <div class="weui-grid__icon">
                <img src="{{asset('static/img/list.svg')}}" alt="">
            </div>
            <p class="weui-grid__label">动态列表</p>
        </a>
        <a href="{{url('/mobile_draftlist_dynamic')}}" class="weui-grid">
            <div class="weui-grid__icon">
                <img src="{{asset('static/img/caogao.svg')}}" alt="">
            </div>
            <p class="weui-grid__label">草稿箱</p>
        </a>
        <a href="javascript:;" class="weui-grid">
            <div class="weui-grid__icon">
                <img src="{{asset('static/img/like.svg')}}" alt="">
            </div>
            <p class="weui-grid__label">我喜欢</p>
        </a>
        <a href="javascript:;" class="weui-grid">
            <div class="weui-grid__icon">
                <img src="{{asset('static/img/tuijian.svg')}}" alt="">
            </div>
            <p class="weui-grid__label">推荐</p>
        </a>
        <a href="javascript:;" class="weui-grid">
            <div class="weui-grid__icon">
                <img src="{{asset('static/img/shezhi.svg')}}" alt="">
            </div>
            <p class="weui-grid__label">设置</p>
        </a>
        <a href="{{url('/mobile_setting')}}" class="weui-grid">
            <div class="weui-grid__icon">
                <img src="{{asset('static/img/aboug.svg')}}" alt="">
            </div>
            <p class="weui-grid__label">关于我们</p>
        </a>
    </div>

@endsection

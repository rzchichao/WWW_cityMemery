@extends('mobile.layouts.ucenter')
@section('content')
    <style>
        {{--兼容iPhone5 5s SE--}}
        @media (device-height: 568px) and (-webkit-min-device-pixel-ratio: 2) {
            .weui-grid_list_1 {
                position: relative;
                float: left;
                padding: 22px 10px;
                width: 25%;
                height: 95px;
                box-sizing: border-box;
            }
            .weui-grid_list_1 h3{
                font-size: 1.3em;
            }
            .weui-grid_list_2 {
                position: relative;
                float: left;
                padding: 20px 10px;
                width: 25%;
                height: 95px;
                box-sizing: border-box;
            }
            .weui-grid_list_3 {
                position: relative;
                float: left;
                padding: 20px 10px;
                width: 50%;
                height: 95px;
                box-sizing: border-box;
            }
            .weui-grid_list_3 .address_content{
                line-height: 12px;
                color: grey;
                font-size: 0.7em;
            }
            .weui-grid_list_1:before {
                position: absolute;
                right: 0;
                top: 0;
                width: 1px;
                bottom: 0;
                border-right: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 100% 0;
                transform-origin: 100% 0;
                -webkit-transform: scaleX(0.5);
                transform: scaleX(0.5);
            }
            .weui-grid_list_1:after {
                position: absolute;
                left: 0;
                bottom: 0;
                right: 0;
                height: 1px;
                border-bottom: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 0 100%;
                transform-origin: 0 100%;
                -webkit-transform: scaleY(0.5);
                transform: scaleY(0.5);
            }
            .weui-grid_list_2:before {
                position: absolute;
                right: 0;
                top: 0;
                width: 1px;
                bottom: 0;
                border-right: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 100% 0;
                transform-origin: 100% 0;
                -webkit-transform: scaleX(0.5);
                transform: scaleX(0.5);
            }
            .weui-grid_list_2:after {
                position: absolute;
                left: 0;
                bottom: 0;
                right: 0;
                height: 1px;
                border-bottom: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 0 100%;
                transform-origin: 0 100%;
                -webkit-transform: scaleY(0.5);
                transform: scaleY(0.5);
            }
            .weui-grid_list_3:before {
                position: absolute;
                right: 0;
                top: 0;
                width: 1px;
                bottom: 0;
                border-right: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 100% 0;
                transform-origin: 100% 0;
                -webkit-transform: scaleX(0.5);
                transform: scaleX(0.5);
            }
            .weui-grid_list_3:after {
                position: absolute;
                left: 0;
                bottom: 0;
                right: 0;
                height: 1px;
                border-bottom: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 0 100%;
                transform-origin: 0 100%;
                -webkit-transform: scaleY(0.5);
                transform: scaleY(0.5);
            }
            .weui-grids .weui-grid_list_3 .tag{
                float: left;
                background-color: #89cff0;
                padding: 0px 6px 0px 6px;
                border-radius: 6px;
                margin-right: 3%;
                font-size: 1.0em;
                color: #FFFFFF;
                filter:alpha(Opacity=60);
                -moz-opacity:0.6;
                opacity: 0.6;
            }
            .weui-grids a:hover{
                color: #000000;
            }
            .operate-div{
                position: absolute;
                right: -150px;
                text-align: center;
                background: #FFFFFF;
                color: #fff;
                width: 150px;
                border: 1px solid #FFFFFF;
                margin-top: 10px;
            }
            .operate-item{
                width: 33.3%;
                height: 85px;
                font-size: 1.0em;
                float: left;
                text-align: center;
            }
            .dynamic-item{
                width: 100%;
                -webkit-transform: translateX(0px);
                position: relative;
            }
            .pravite-icon{
                color: darkgrey;
                margin-top: 25px;
                font-size: 0.8em;
            }
        }
        /*iPhone6*/
        @media (min-device-width: 375px) and (max-device-width: 667px) and (-webkit-min-device-pixel-ratio: 2){
            .weui-grid_list_1 {
                position: relative;
                float: left;
                padding: 20px 10px;
                width: 25%;
                height: 95px;
                box-sizing: border-box;
            }
            .weui-grid_list_2 {
                position: relative;
                float: left;
                padding: 20px 10px;
                width: 25%;
                height: 95px;
                box-sizing: border-box;
            }
            .weui-grid_list_3 {
                position: relative;
                float: left;
                padding: 20px 10px;
                width: 50%;
                height: 95px;
                box-sizing: border-box;
            }
            .weui-grid_list_3 .address_content{
                line-height: 12px;
                color: grey;
            }
            .weui-grid_list_1:before {
                position: absolute;
                right: 0;
                top: 0;
                width: 1px;
                bottom: 0;
                border-right: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 100% 0;
                transform-origin: 100% 0;
                -webkit-transform: scaleX(0.5);
                transform: scaleX(0.5);
            }
            .weui-grid_list_1:after {
                position: absolute;
                left: 0;
                bottom: 0;
                right: 0;
                height: 1px;
                border-bottom: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 0 100%;
                transform-origin: 0 100%;
                -webkit-transform: scaleY(0.5);
                transform: scaleY(0.5);
            }
            .weui-grid_list_2:before {
                position: absolute;
                right: 0;
                top: 0;
                width: 1px;
                bottom: 0;
                border-right: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 100% 0;
                transform-origin: 100% 0;
                -webkit-transform: scaleX(0.5);
                transform: scaleX(0.5);
            }
            .weui-grid_list_2:after {
                position: absolute;
                left: 0;
                bottom: 0;
                right: 0;
                height: 1px;
                border-bottom: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 0 100%;
                transform-origin: 0 100%;
                -webkit-transform: scaleY(0.5);
                transform: scaleY(0.5);
            }
            .weui-grid_list_3:before {
                position: absolute;
                right: 0;
                top: 0;
                width: 1px;
                bottom: 0;
                border-right: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 100% 0;
                transform-origin: 100% 0;
                -webkit-transform: scaleX(0.5);
                transform: scaleX(0.5);
            }
            .weui-grid_list_3:after {
                position: absolute;
                left: 0;
                bottom: 0;
                right: 0;
                height: 1px;
                border-bottom: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 0 100%;
                transform-origin: 0 100%;
                -webkit-transform: scaleY(0.5);
                transform: scaleY(0.5);
            }
            .weui-grids .weui-grid_list_3 .tag{
                float: left;
                background-color: #89cff0;
                padding: 0px 8px 0px 8px;
                border-radius: 6px;
                margin-right: 2%;
                color: #FFFFFF;
                filter:alpha(Opacity=60);
                -moz-opacity:0.6;
                opacity: 0.6;
            }
            .weui-grids a:hover{
                color: #000000;
            }
            .operate-div{
                position: absolute;
                right: -150px;
                text-align: center;
                background: #FFFFFF;
                color: #fff;
                width: 150px;
                border: 1px solid #FFFFFF;
                margin-top: 10px;
            }
            .operate-item{
                width: 33.3%;
                height: 85px;
                font-size: 1.0em;
                float: left;
                text-align: center;
            }
            .dynamic-item{
                width: 100%;
                -webkit-transform: translateX(0px);
                position: relative;
            }
            .pravite-icon{
                color: darkgrey;margin-top: 25px;
            }
        }
        /*iPhone6+*/
        @media (min-device-width : 414px) and (max-device-width : 736px) and (-webkit-min-device-pixel-ratio : 3){
            .weui-grid_list_1 {
                position: relative;
                float: left;
                padding: 20px 10px;
                width: 25%;
                height: 95px;
                box-sizing: border-box;
            }
            .weui-grid_list_2 {
                position: relative;
                float: left;
                padding: 20px 10px;
                width: 25%;
                height: 95px;
                box-sizing: border-box;
            }
            .weui-grid_list_3 {
                position: relative;
                float: left;
                padding: 20px 10px;
                width: 50%;
                height: 95px;
                box-sizing: border-box;
            }
            .weui-grid_list_3 .address_content{
                line-height: 12px;
                color: grey;
            }
            .weui-grid_list_1:before {
                position: absolute;
                right: 0;
                top: 0;
                width: 1px;
                bottom: 0;
                border-right: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 100% 0;
                transform-origin: 100% 0;
                -webkit-transform: scaleX(0.5);
                transform: scaleX(0.5);
            }
            .weui-grid_list_1:after {
                position: absolute;
                left: 0;
                bottom: 0;
                right: 0;
                height: 1px;
                border-bottom: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 0 100%;
                transform-origin: 0 100%;
                -webkit-transform: scaleY(0.5);
                transform: scaleY(0.5);
            }
            .weui-grid_list_2:before {
                position: absolute;
                right: 0;
                top: 0;
                width: 1px;
                bottom: 0;
                border-right: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 100% 0;
                transform-origin: 100% 0;
                -webkit-transform: scaleX(0.5);
                transform: scaleX(0.5);
            }
            .weui-grid_list_2:after {
                position: absolute;
                left: 0;
                bottom: 0;
                right: 0;
                height: 1px;
                border-bottom: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 0 100%;
                transform-origin: 0 100%;
                -webkit-transform: scaleY(0.5);
                transform: scaleY(0.5);
            }
            .weui-grid_list_3:before {
                position: absolute;
                right: 0;
                top: 0;
                width: 1px;
                bottom: 0;
                border-right: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 100% 0;
                transform-origin: 100% 0;
                -webkit-transform: scaleX(0.5);
                transform: scaleX(0.5);
            }
            .weui-grid_list_3:after {
                position: absolute;
                left: 0;
                bottom: 0;
                right: 0;
                height: 1px;
                border-bottom: 1px solid #D9D9D9;
                color: #D9D9D9;
                -webkit-transform-origin: 0 100%;
                transform-origin: 0 100%;
                -webkit-transform: scaleY(0.5);
                transform: scaleY(0.5);
            }
            .weui-grids .weui-grid_list_3 .tag{
                float: left;
                background-color: #89cff0;
                padding: 0px 8px 0px 8px;
                border-radius: 6px;
                margin-right: 2%;
                color: #FFFFFF;
                filter:alpha(Opacity=60);
                -moz-opacity:0.6;
                opacity: 0.6;
            }
            .weui-grids a:hover{
                color: #000000;
            }
            .operate-div{
                position: absolute;
                right: -150px;
                text-align: center;
                background: #FFFFFF;
                color: #fff;
                width: 150px;
                border: 1px solid #FFFFFF;
                margin-top: 10px;
            }
            .operate-item{
                width: 33.3%;
                height: 85px;
                font-size: 1.0em;
                float: left;
                text-align: center;
            }
            .dynamic-item{
                width: 100%;
                -webkit-transform: translateX(0px);
                position: relative;
            }
            .pravite-icon{
                color: darkgrey;margin-top: 25px;
            }
        }
        /*其他*/
        .weui-grid_list_1 {
            position: relative;
            float: left;
            padding: 20px 10px;
            width: 25%;
            height: 95px;
            box-sizing: border-box;
        }
        .weui-grid_list_2 {
            position: relative;
            float: left;
            padding: 20px 10px;
            width: 25%;
            height: 95px;
            box-sizing: border-box;
        }
        .weui-grid_list_3 {
            position: relative;
            float: left;
            padding: 20px 10px;
            width: 50%;
            height: 95px;
            box-sizing: border-box;
        }
        .weui-grid_list_3 .address_content{
            line-height: 12px;
            color: grey;
            font-size: 0.8em;
        }
        .weui-grid_list_1:before {
            position: absolute;
            right: 0;
            top: 0;
            width: 1px;
            bottom: 0;
            border-right: 1px solid #D9D9D9;
            color: #D9D9D9;
            -webkit-transform-origin: 100% 0;
            transform-origin: 100% 0;
            -webkit-transform: scaleX(0.5);
            transform: scaleX(0.5);
        }
        .weui-grid_list_1:after {
            position: absolute;
            left: 0;
            bottom: 0;
            right: 0;
            height: 1px;
            border-bottom: 1px solid #D9D9D9;
            color: #D9D9D9;
            -webkit-transform-origin: 0 100%;
            transform-origin: 0 100%;
            -webkit-transform: scaleY(0.5);
            transform: scaleY(0.5);
        }
        .weui-grid_list_2:before {
            position: absolute;
            right: 0;
            top: 0;
            width: 1px;
            bottom: 0;
            border-right: 1px solid #D9D9D9;
            color: #D9D9D9;
            -webkit-transform-origin: 100% 0;
            transform-origin: 100% 0;
            -webkit-transform: scaleX(0.5);
            transform: scaleX(0.5);
        }
        .weui-grid_list_2:after {
            position: absolute;
            left: 0;
            bottom: 0;
            right: 0;
            height: 1px;
            border-bottom: 1px solid #D9D9D9;
            color: #D9D9D9;
            -webkit-transform-origin: 0 100%;
            transform-origin: 0 100%;
            -webkit-transform: scaleY(0.5);
            transform: scaleY(0.5);
        }
        .weui-grid_list_3:before {
            position: absolute;
            right: 0;
            top: 0;
            width: 1px;
            bottom: 0;
            border-right: 1px solid #D9D9D9;
            color: #D9D9D9;
            -webkit-transform-origin: 100% 0;
            transform-origin: 100% 0;
            -webkit-transform: scaleX(0.5);
            transform: scaleX(0.5);
        }
        .weui-grid_list_3:after {
            position: absolute;
            left: 0;
            bottom: 0;
            right: 0;
            height: 1px;
            border-bottom: 1px solid #D9D9D9;
            color: #D9D9D9;
            -webkit-transform-origin: 0 100%;
            transform-origin: 0 100%;
            -webkit-transform: scaleY(0.5);
            transform: scaleY(0.5);
        }
        .weui-grids .weui-grid_list_3 .tag{
            float: left;
            background-color: #89cff0;
            padding: 0px 8px 0px 8px;
            border-radius: 6px;
            margin-right: 2%;
            color: #FFFFFF;
            filter:alpha(Opacity=60);
            -moz-opacity:0.6;
            opacity: 0.6;
        }
        .weui-grids a:hover{
            color: #000000;
        }
        .operate-div{
            position: absolute;
            right: -150px;
            text-align: center;
            background: #FFFFFF;
            color: #fff;
            width: 150px;
            border: 1px solid #FFFFFF;
            margin-top: 10px;
        }
        .operate-item{
            width: 33.3%;
            height: 85px;
            font-size: 1.0em;
            float: left;
            text-align: center;
        }
        .dynamic-item{
            width: 100%;
            -webkit-transform: translateX(0px);
            position: relative;
        }
        .pravite-icon{
            color: darkgrey;margin-top: 25px;
        }
    </style>
    <div style="margin-top: 50px;margin-bottom: 20px;">
        <div id="dynamic_items" class="weui-grids">
            @foreach ($dy as $key => $item)
            <div id="item_{{$item['id']}}" class="dynamic-item" style="">
                <div onclick=onhref('{{$item['id']}}')>
                     <span class="weui-grid_list_1">
                    <h3>{{$item['day']}}<small style="color: #000000;">{{$item['month']}}月</small></h3>
                    <div id="pravite-icon-{{$item['id']}}" class="pravite-icon">@if(!$item['is_share'])<small><span class="glyphicon glyphicon-lock"></span></small>@endif</div>
                </span>
                    <a href="#">
                    <span class="weui-grid_list_2">
                        <img height="70" width="70" src="{{$item['photo']['name']}}" alt="">
                    </span>
                        <span class="weui-grid_list_3">
                        <div style="float: left;width: 100%;"><div style="height: 24px;float: left;width: 90%;padding-top: 3px;"><h5>{{$item['title']}}</h5></div><div style="float: left;width: 10%;"></div></div>
                        <div style="float: left;width: 100%;">
                            <div><small><div style="float: left;width: 10%;"><span class="glyphicon glyphicon-map-marker" style="color: grey;"></span></div><div style="float: left;width: 90%;padding-top: 3px;"><p class="address_content">{{$item['address']}}</p></div></small></div>
                        </div>
                    </span>
                    </a>
                </div>

                <div id="operate-div-{{$item['id']}}" class="operate-div" style="top: {{$key*95}}px;">
                    <div id="set_private_{{$item['id']}}" @if($item['is_share']) onclick="set_private(this,0);" @else onclick="set_private(this,1);" @endif class="operate-item" style="background-color: grey;color: #FFFFFF;padding-top: 25px;">
                        <div id="pravite-status-{{$item['id']}}"><small><div>设为</div><div>@if($item['is_share'])隐私@else公开@endif</div></small></div>
                    </div>
                    <a href="{{url('/mobile_modify_dynamic?dynamic_id='.$item['id'])}}">
                        <div id="modify_{{$item['id']}}"  class="operate-item" style="background-color: #1AAD19;color: #FFFFFF;padding-top: 21px;">
                            <div><span class="glyphicon glyphicon-pencil"></span></div>
                            <small>修改</small>
                        </div>
                    </a>
                    <div id="delete_{{$item['id']}}" onclick="confirm_delete_dynamic(this);" class="operate-item" style="background-color: #E64340;color: #FFFFFF;padding-top: 21px;">
                        <div><span class="glyphicon glyphicon-trash"></span></div>
                        <small>删除</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    {{--操作通知弹出框--}}
    <div class="js_dialog" id="iosDialog2" style="display: none;">
        <div class="weui-mask"></div>
        <div class="weui-dialog">
            <div id="weui-dialog__bd_notice" class="weui-dialog__bd"></div>
            <div class="weui-dialog__ft">
                <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary">知道了</a>
            </div>
        </div>
    </div>
    {{--删除确认弹出框--}}
    <div class="js_dialog" id="iosDialog1" style="display: none;">
        <div class="weui-mask"></div>
        <div class="weui-dialog">
            <div class="weui-dialog__hd"><strong class="weui-dialog__title">是否删除</strong></div>
            <div class="weui-dialog__bd">一旦删除无法恢复</div>
            <div class="weui-dialog__ft">
                <a href="javascript:;" id="cancel_delete_dynamic" class="weui-dialog__btn weui-dialog__btn_default">取消</a>
                <a href="javascript:;" id="confirm_delete_dynamic" class="weui-dialog__btn weui-dialog__btn_primary">删除</a>
            </div>
        </div>
    </div>
    {{--操作结果反馈弹出框--}}
    <div id="toast" style="display: none;">
        <div class="weui-mask_transparent"></div>
        <div class="weui-toast">
            <i class="weui-icon-success-no-circle weui-icon_toast"></i>
            <p class="weui-toast__content"></p>
        </div>
    </div>

    <script>
        {{--滑动效果--}}
        function onhref(e) {
            window.location.href="{{url('api2/Impl_getDynamicDetail2')}}" + "?dynamic_id="+e
        }
        $(document).ready(function () {
            var startX;
            var endX;
            var objX = 0;
            $(document).on("touchstart",function (e) {
                if(e.target.offsetParent){
                    var id = e.target.offsetParent.offsetParent.id;
                    if(id.indexOf('item_')!=-1){
                        var obj = $("#" + id);
                        hide_other(id);
                        startX = e.originalEvent.changedTouches[0].clientX;
                        var matrix = obj.css("WebkitTransform");
                        objX = matrix.replace("matrix(1, 0, 0, 1,","");
                        objX = (objX.replace(", 0)",""))*1;
                        if(objX == 0){
                            $(document).on("touchmove",function (e) {
                                var id = e.target.offsetParent.offsetParent.id;
                                if(id.indexOf('item_')!=-1){
                                    var obj = $("#" + id);
                                    endX = e.originalEvent.changedTouches[0].clientX;
                                    X = endX - startX;
                                    if(X >= -30){
                                        obj.css("WebkitTransform","translateX(" + 0 + "px)");
                                    }else if(X < -30){
                                        var l = Math.abs(X);
                                        obj.css("WebkitTransform","translateX(" + -l + "px)");
                                        if(l > 150){
                                            obj.css("WebkitTransform","translateX(" + -150 + "px)");
                                        }
                                    }
                                }
                            });
                        }else if(objX < 0){
                            $(document).on("touchmove",function (e) {
                                var id = e.target.offsetParent.offsetParent.id;
                                if(id.indexOf('item_')!=-1){
                                    var obj = $("#" + id);
                                    endX = e.originalEvent.changedTouches[0].clientX;
                                    X = endX - startX;
                                    if(X > 30){
                                        var l = Math.abs(X) - 150;
                                        obj.css("WebkitTransform","translateX(" + l + "px)");
                                        if(l > 0){
                                            obj.css("WebkitTransform","translateX(" + 0 + "px)");
                                        }
                                    }else{
                                        obj.css("WebkitTransform","translateX(" + -150 + "px)");
                                    }
                                }
                            });
                        }
                    }
                }
            });
            $(document).on("touchend",function (e) {
                if(e.target.offsetParent){
                    var id = e.target.offsetParent.offsetParent.id;
                    if(id.indexOf('item_')!=-1){
                        var obj = $("#" + id);
                        var matrix = obj.css("WebkitTransform");
                        objX = matrix.replace("matrix(1, 0, 0, 1,","");
                        objX = (objX.replace(", 0)",""))*1;
                        if(objX >= -75){
                            obj.css("WebkitTransform","translateX(" + 0 + "px)");
                        }else{
                            obj.css("WebkitTransform","translateX(" + -150 + "px)");
                        }
                    }
                }
            });
        });
        //        隐藏自己
        function  hide_own(id) {
            $("#item_" + id).css("WebkitTransform","translateX(" + 0 + "px)");
        }
        //        隐藏其他
        function hide_other(id){
            $('#dynamic_items').children().each(function (key,obj) {
                var dynamic_item_id = $(obj).attr('id');
                if(dynamic_item_id != id){
                    $("#" + dynamic_item_id).css("WebkitTransform","translateX(" + 0 + "px)");
                }
            });
        }
        {{--设置是否公开--}}
        function set_private(obj,is_share) {
            var id = $(obj).attr("id").replace("set_private_","");
            var is_share = is_share;
            $.ajax({
                type : "get",
                url : "{{url('/mobile_set_private')}}",
                data : "id=" + id + "&is_share=" + is_share,
                dataType : "json",
                success : function (data) {
                    if(data.status){
                        if(is_share == 1){
                            $('#pravite-icon-' + id).html('');
                            $("#weui-dialog__bd_notice").text("已设置为公开");
                            $('#pravite-status-' + id).html('<small><div>设为</div><div>隐私</div>');
                            $('#set_private_' + id).attr('onclick','set_private(this,0)');
                            hide_own(id);
                        }else{
                            $('#pravite-icon-' + id).html('<small><span class="glyphicon glyphicon-lock"></span></small>');
                            $("#weui-dialog__bd_notice").text("已设置为隐私");
                            $('#pravite-status-' + id).html('<small><div>设为</div><div>公开</div>');
                            $('#set_private_' + id).attr('onclick','set_private(this,1)');
                            hide_own(id);
                        }
                        $("#iosDialog2").fadeIn(200);
                    }else{
                        console.log("FAIL");
                    }
                },
                error : function (data) {

                }
            });
        }
        //        点击隐藏弹出框
        $('#iosDialog1').on('click', '.weui-dialog__btn', function(){
            $("#iosDialog1").fadeOut(200);
        });
        //        点击隐藏弹出框
        $('#iosDialog2').on('click', '.weui-dialog__btn', function(){
            $("#iosDialog2").fadeOut(200);
        });
        //        确认是否删除
        function confirm_delete_dynamic(obj){
            var id = $(obj).attr('id').replace('delete_','');
            $("#item_" + id).css("WebkitTransform","translateX(" + 0 + "px)");
            $('#confirm_delete_dynamic').attr('onclick','delete_dynamic('+ id +',"")');
            $('#cancel_delete_dynamic').attr('onclick','delete_dynamic('+  id +',"cancel")');
            $("#iosDialog1").fadeIn(200);
        }
        //      删除动态
        function  delete_dynamic(id,cancel) {
            if(cancel==''){
                $.ajax({
                   type : 'get',
                    url : '{{url("/mobile_delete_dynamic")}}',
                    data : 'id=' + id,
                    dataType : 'json',
                    success : function (data){
                        if(data.status){
                            $('.weui-toast__content').text('已完成');
                            if ($('#toast').css('display') != 'none') return;
                            $('#toast').fadeIn(100);
                            setTimeout(function () {
                                $('#toast').fadeOut(100);
                            }, 2000);
                            $('#item_' + id).remove();
                            $('#dynamic_items').children().each(function (key, obj) {
                                var dynamic_item_id = $(obj).attr('id').replace('item_','')
                                $('#operate-div-' + dynamic_item_id).css('top',key*95 + 'px')
                            });
                        }
                    },
                    error : function (data){

                    }
                });
            }else{
                $('.weui-toast__content').text('已取消');
                if ($('#toast').css('display') != 'none') return;
                $('#toast').fadeIn(100);
                setTimeout(function () {
                    $('#toast').fadeOut(100);
                }, 2000);
            }
        }
    </script>
 @endsection

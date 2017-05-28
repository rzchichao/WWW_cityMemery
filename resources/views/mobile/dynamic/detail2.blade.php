@extends('mobile.layouts.ucenter')
@section('content')
    <script>
        $(function(){
            wx.config(<?php echo $js->config(array('onMenuShareTimeline'), false) ?>);
            wx.ready(function () {
                wx.onMenuShareTimeline({
                    title: "{{Session::get('wechat.oauth_user')['nickname']}}的城市记忆---{{$dynamic->cityname}}", // 分享标题
                    link: '', // 分享链接
                    imgUrl: "{{Session::get('wechat.oauth_user')['avatar']}}", // 分享图标
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
        .db {
            display: block;
        }
        .weixinAudio {
            line-height: 1.5;
            margin: 20px;
        }
        .audio_area {
            display: inline-block;
            width: 100%;
            vertical-align: top;
            margin: 0px 1px 0px 0;
            font-size: 0;
            position: relative;
            font-weight: 400;
            text-decoration: none;
            -ms-text-size-adjust: none;
            -webkit-text-size-adjust: none;
            text-size-adjust: none;
        }

        .audio_wrp {
            border: 1px solid #ebebeb;
            background-color: #fcfcfc;
            overflow: hidden;
            padding: 12px 20px 12px 12px;
        }

        .audio_play_area {
            float: left;
            margin: 9px 22px 10px 5px;
            font-size: 0;
            width: 18px;
            height: 25px;
        }

        .playing .audio_play_area .icon_audio_default {
            display: block;
        }

        .audio_play_area .icon_audio_default {
            background: transparent url({{asset('static/images/iconloop.png')}}) no-repeat 0 0;
            width: 18px;
            height: 25px;
            vertical-align: middle;
            display: inline-block;
            -webkit-background-size: 54px 25px;
            background-size: 54px 25px;
            background-position: -36px center;
        }

        .audio_play_area .icon_audio_playing {
            background: transparent url({{asset('static/images/iconloop.png')}}) no-repeat 0 0;
            width: 18px;
            height: 25px;
            vertical-align: middle;
            display: inline-block;
            -webkit-background-size: 54px 25px;
            background-size: 54px 25px;
            -webkit-animation: audio_playing 1s infinite;
            background-position: 0px center;
            display: none;
        }
        .tips_global {
            color: #8c8c8c;
        }

        .audio_area .audio_length {
            float: right;
            font-size: 14px;
            margin-top: 3px;
            margin-left: 1em;
        }
        .audio_area .progress_bar {
            position: absolute;
            left: 0;
            bottom: 0;
            background-color: #0cbb08;
            height: 2px;
        }

        .playing .audio_play_area .icon_audio_default {
            display: none;
        }

        .playing .audio_play_area .icon_audio_playing {
            display: inline-block;
        }

        @-webkit-keyframes audio_playing {
            30% {
                background-position: 0px center;
            }
            31% {
                background-position: -18px center;
            }
            61% {
                background-position: -18px center;
            }
            61.5% {
                background-position: -36px center;
            }
            100% {
                background-position: -36px center;
            }
        }
    </style>
    <section id="detail_section" style="width: 100%;overflow: scroll">
        <header style="margin:16px 9px;">
        <span style="font-weight: 400;font-size:1.5em;font-family: '微软雅黑' ; line-height: 30px;">
            {{$dynamic->title}}
        </span>
        </header>
        <nav style="height:35px;margin-bottom: 10px;">
            <ul style="margin-left: 8px;">
                <li style="float: left;list-style:none;"><img style="width:35px;height:35px; border-radius: 50%" class="img-responsive" src="{{$dynamic->user['avatar']}}"/></li>
                <li style="float: left;list-style:none;margin-left:10px;">
                    <span style="line-height: 35px;">{{$dynamic->user['nickname']}}</span>
                </li>
                <li style="float: right;list-style:none;">
                    <button onclick="guanzhu()" type="button" id="guanzhu" style="width: 73px;line-height: 13px;margin-top:9%;margin-right: 20px;" class="btn btn-info btn-sm">@if($dynamic->is_follow==0)+&nbsp关注@else 已关注  @endif</button>
                </li>
            </ul>
        </nav>
        <nav style="height:50px;">
                     <span style="color:#8e8a8a;font-size: 10px;margin-left: 8px;">
                         <i style="color:#8e8a8a " class="glyphicon glyphicon-calendar"></i>
                         {{$dynamic->time}}
                    </span>
            <span style="color:#8e8a8a;font-size: 10px;">
                        <i style="color:#8e8a8a" class="glyphicon glyphicon-map-marker"></i>
                {{$dynamic->address}}
                    </span>
        </nav>
        @foreach($dynamic->medias as $item)
            @if($item->table_name=='photo')
                <div class="weui-flex">
                    <div class="weui-flex__item">
                        <img style="margin-bottom: 8px" class="img-responsive center-block" src="{{$item->name}}">
                    </div>
                </div>
            @endif
            @if($item->table_name=='text')
                <div class="weui-flex">
                    <div class="weui-flex__item"><div class="placeholder">
                        </div>
                        <p class="weui-article" style="text-indent: 2em;letter-spacing:0.2em;color:rgba(0, 0, 0, .5);">
                            {{$item->body}}
                        </p>
                    </div>
                </div>
            @endif
            @if($item->table_name=='audio')
                <div class="weui-flex">
                    <div class="weui-flex__item">
                        <p class="weixinAudio" style="z-index: 1500">
                            <audio src="{{$item->body}}" id="media" width="1" height="1" preload=""></audio>
                            <span id="audio_area" class="db audio_area">
                            <span class="audio_wrp db">
                            <span class="audio_play_area">
                                <i class="icon_audio_default"></i>
                                <i class="icon_audio_playing"></i>
                            </span>
                            <span id="audio_length" class="audio_length tips_global">{{$item->length}}</span>
                            <span id="audio_progress" class="progress_bar" style="width: 0%;"></span>
                            </span>
                         </span>
                        </p>
                    </div>
                </div>

            @endif
        @endforeach
        <div style="height: 30px;width: 100%">

        </div>
        <footer style="position: fixed;z-index:6;bottom:0px;height:35px;width: 100%;border-bottom: none;border-top: 1px solid #d0d6d6;background-color:#f8f8f8;">
            <ul>
                <li style="float:left;width:40%;height:25px;list-style:none;border: #dcdcdc;color: #999;text-align: center;line-height: 25px;margin-top:5px;">
                    <div  style="width: 80%;height:25px;background-color: #dbe1e1;display: block;margin-right: auto;margin-left: auto;color:#969696;border-radius: 5px;">发表评论</div>
                </li>
                <li style="float: left;width:20%;list-style: none;line-height: 25px;border: 5px;margin-top:5px;font-size: 22px;color: #dbe1e1;">
                    <span class="glyphicon glyphicon-heart-empty"></span>
                </li>
                <li style="float: left;width:20%;list-style: none;line-height: 25px;border: 5px;margin-top:5px;font-size: 22px;color: #dbe1e1;">
                <span class="glyphicon glyphicon-comment">
                </span>
                </li>
                <li onclick="logout()" style="float: left;width:20%;list-style: none;line-height: 25px;border: 5px;margin-top:5px;font-size: 22px;color:#3CC51F;" >
                <span class="glyphicon glyphicon-log-out">

                </span>
                </li>
            </ul>
        </footer>
    </section>
    <div class="js_dialog" id="iosDialog2" style="display: none;">
        <div class="weui-mask"></div>
        <div class="weui-dialog">
            <div class="weui-dialog__bd">不能关注自己奥</div>
            <div class="weui-dialog__ft">
                <a href="javascript:;" style="text-decoration: none" onclick="hidetoast()" class="weui-dialog__btn weui-dialog__btn_primary">知道了</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function logout() {
            $("#tpl").css('display','none');
            $("#tpl").children().remove();
            $(".slimScrollDiv").css('display','none');
        }
        function hidetoast() {
            $("#iosDialog2").css('display','none')
        }
        function guanzhu() {
            var uid="{{$dynamic->user['id']}}";
            var uid_following="{{$dynamic->laifang}}";
            if(uid==uid_following){
                $("#iosDialog2").css('display','block')
            }else {
                $.ajax({
                    type:"get",
                    url:"http://www.city.rztaiyang.com/api4/Impl_follow",
                    async:false,
                    data:{uid:uid,uid_following:uid_following},
                    dataType:"JSON"
                })
                    .done(function(data,textStatus){
                        $("#guanzhu").html('已关注')
                    })
            }

        }
        // 修改了返回的对象,以前的无法接收
        $('.weixinAudio').weixinAudio({
            autoplay:false
        });
        var clitentHeight = document.documentElement.clientHeight;;
        $("#detail_section").css('height',clitentHeight-50)
    </script>
@endsection
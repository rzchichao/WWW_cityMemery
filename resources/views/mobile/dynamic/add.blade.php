@extends('mobile.layouts.header')
@section('content')
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script>
            $(function(){
                wx.config(<?php echo $js->config(array('chooseImage', 'previewImage','uploadImage','startRecord','stopRecord','playVoice','uploadVoice','onVoicePlayEnd'), false) ?>);
            })
    </script>
    <link rel="stylesheet" type="text/css" href="{{asset('plugin/play_button/css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('static/css/addandmodify.css')}}"/>
    <div style="margin-top: 70px;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="open_id" value="{{session('wechat.oauth_user')['id']}}" />
            <input type="hidden" id="dynamic_id" name="dynamic_id" value="{{ $dynamic->id }}" />
            <input type="hidden" id="site_url"  value="{{env('SITE_URL') }}" />
            <input type="hidden" id="actiontype"  value="add" />
            <div class="container" style="padding-bottom: 50px;">
                <div class="form-group">
                    <div class="col-md-5" style="border-bottom:2px solid #d5d5d6;">
                        <input type="text" name="title" class="" style="font-size:21px;background-color:inherit;height:35px ;width:100%;border:none;" id="destination" placeholder="标题">
                    </div>
                </div>
                <div class="media" id="content">
                </div>
                <nav class="navbar navbar-default navbar-fixed-bottom">
                    <div class="container" style="padding-top: 12px;background-color: #FFFFFF;">
                        <div id="text" class="media_nav" onclick="add_textarea();" >
                            <input type="button" style="background-image: url({{asset('static/images/text.png')}});background-repeat: no-repeat;background-size:100%;width: 28px;height: 28px;background-color: #FFFFFF;border: 0px;">
                        </div>
                        <div class="media_nav"  onclick="camera_wx()">
                            <input type="button" style="background-image: url({{asset('static/images/camera.png')}});background-repeat: no-repeat;background-size:100%;width: 28px;height: 28px;background-color: #FFFFFF;border: 0px;">
                        </div>
                        <div class="media_nav">
                            <input onclick="add_audio()" type="button" style="background-image: url({{asset('static/images/microphone.png')}});background-repeat: no-repeat;background-size:100%;width: 28px;height: 28px;background-color: #FFFFFF;border: 0px;">
                        </div>
                        <div class="media_nav"  id="add_draft" style="text-align:center;font-size: 0.9em;"><div><span class="glyphicon glyphicon-floppy-disk"></span></div><div>存为草稿</div></div>
                        <div class="media_nav" id="submit" style="font-size: 0.9em;text-align: center;"><button id="submit" type="button" style="border: 0px;background-color: #FFFFFF;"><div><span class="glyphicon glyphicon-send"></span></div><div>提交</div></button></div>
                    </div>
                </nav>

            </div>
    </div>
    <div id="gallerybody">
    </div>
    @include('mobile.layouts.weui_toast')
    <script src="{{asset('static/js/addandmodifyDynamic.js')}}"></script>
@endsection
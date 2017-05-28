@extends('layouts.comm')
@section('content')
<script src="{{asset('static/js/lavavel_sms.js')}}"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=DuPkVGOVnFFV2LUVC0zB4mkePYZzI6XW"></script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">注册</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">用户名</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">邮箱地址</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('mobile') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">手机号</label>
                            <div class="col-md-4">
                                <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}">
                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                               <button type="button" id="sendVerifySmsButton" onclick="sendsms()" class="btn btn-info">获取</button>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('verifyCode') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">短信验证码</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="verifyCode">
                                @if ($errors->has('verifyCode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('verifyCode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">重复密码</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="lnglat" value=""  name="lnglat">
                        <div class="form-group {{$errors->has('verifyCode') ? ' has-error' : '' }}">
                            <div id="container" style="width:100%;height:500px; "></div>
                                <script type="text/javascript">
                                // 百度地图API功能
                                var map = new BMap.Map("container");

                                map.enableScrollWheelZoom(true);
                                map.enableContinuousZoom(true);
                                var point = new BMap.Point();
                                map.centerAndZoom(point,12);
                                function myFun(result){
                                    var cityName = result.name;
                                    map.setCenter(cityName);
                                }
                                var myCity = new BMap.LocalCity();
                                myCity.get(myFun);               // 初始化地图，设置中心点坐标和地图级别
                                var marker;
                                function showInfo(e){
                                    if(typeof(marker)!='undefined'){
                                        map.removeOverlay(marker);
                                    }
                                    marker = new BMap.Marker(new BMap.Point(e.point.lng,  e.point.lat));
                                    var lnglat=e.point.lng+","+e.point.lat;
                                    $("#lnglat").val(lnglat);
                                    map.addOverlay(marker);
                                }
                                map.addEventListener("click", showInfo);
                            </script>
                        </div>

                        {{--短信验证js--}}
                        <script>
                            function sendsms(){
                                $('#sendVerifySmsButton').sms({
                                    //laravel csrf token
                                    token       : "{{csrf_token()}}",
                                    //请求间隔时间
                                    interval    : 60,
                                    //请求参数
                                    requestData : {
                                        //手机号
                                        mobile : function () {
                                            return $('input[name=mobile]').val();
                                        },
                                        //手机号的检测规则
                                        mobile_rule : 'mobile_required'
                                    }
                                });
                            }

                        </script>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>注册
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

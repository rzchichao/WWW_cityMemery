@extends('mobile.layouts.ucenter')
@section('content')
    <div style="margin-top: 50px;">
        <form action="{{url('/mobile_validate_code')}}" method="post">
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell">
                    <div class="weui-cell__hd"><label class="weui-label">手机号</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="number" name="mobile" pattern="[0-9]*" placeholder="请输入号码">
                    </div>
                </div>
                <div class="weui-cell weui-cell_vcode">
                    <div class="weui-cell__hd">
                        <label class="weui-label">验证码</label>
                    </div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="tel" name="verifyCode" placeholder="请输入验证码">
                    </div>
                    <div class="weui-cell__ft">
                        <button id="sendVerifySmsButton" class="weui-vcode-btn">获取验证码</button>
                    </div>
                </div>
            </div>
            <div class="weui-btn-area">
                <a class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">确定</a>
            </div>
        </form>
    </div>
    <script src="{{asset('static/js/lavavel_sms.js')}}"></script>
    <script>
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
    </script>
@endsection
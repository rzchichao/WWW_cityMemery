@extends('mobile.layouts.ucenter')
@section('content')
<div style="margin-top: 50px;">
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <p>设置HOME</p>
            </div>
            <div class="weui-cell__ft"> > </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__bd">
                <a href="{{url('/mobile_sms')}}"><p>绑定手机</p></a>
            </div>
            <div class="weui-cell__ft"> > </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__bd">
                <p>绑定邮箱</p>
            </div>
            <div class="weui-cell__ft"> > </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <p>绑定QQ</p>
            </div>
            <div class="weui-cell__ft"> > </div>
        </div>
    </div>
</div>
    @endsection
@extends('mobile.layouts.comm')
@section('content')
    <style>
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
            width: 30%;
            height: 95px;
            box-sizing: border-box;
        }
        .weui-grid_list_3 {
            position: relative;
            float: left;
            padding: 20px 10px;
            width: 45%;
            height: 95px;
            box-sizing: border-box;
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
    </style>
    <div style="margin-top: 50px;">
        <div class="weui-grids">
            <a href="{{url('/mobile_list_dynamic')}}" class="weui-grid_list_1">
                <h3>22<small style="color: #000000;">3月</small></h3>
            </a>
            <a href="javascript:;" class="weui-grid_list_2">
                <img height="70" width="70" src="{{asset('uploads/big/2017-03-04-12-32-42-58bab3ea0bf28.jpg')}}" alt="">
            </a>
            <a href="javascript:;" class="weui-grid_list_3">
                <div class="weui-grid__icon">
                    <img src="./images/icon_tabbar.png" alt="">
                </div>
                <p class="weui-grid__label">Grid</p>
            </a>

            <a href="{{url('/mobile_list_dynamic')}}" class="weui-grid_list_1">
                <h3>22<small style="color: #000000;">3月</small></h3>
            </a>
            <a href="javascript:;" class="weui-grid_list_2">
                <img height="70" width="70" src="{{asset('uploads/big/2017-03-04-12-32-42-58bab3ea0bf28.jpg')}}" alt="">
            </a>
            <a href="javascript:;" class="weui-grid_list_3">
                <div class="weui-grid__icon">
                    <img src="./images/icon_tabbar.png" alt="">
                </div>
                <p class="weui-grid__label">Grid</p>
            </a>

            <a href="{{url('/mobile_list_dynamic')}}" class="weui-grid_list_1">
                <h3>22<small style="color: #000000;">3月</small></h3>
            </a>
            <a href="javascript:;" class="weui-grid_list_2">
                <img height="70" width="70" src="{{asset('uploads/big/2017-03-04-12-32-42-58bab3ea0bf28.jpg')}}" alt="">
            </a>
            <a href="javascript:;" class="weui-grid_list_3">
                <div class="weui-grid__icon">
                    <img src="./images/icon_tabbar.png" alt="">
                </div>
                <p class="weui-grid__label">Grid</p>
            </a>

            <a href="{{url('/mobile_list_dynamic')}}" class="weui-grid_list_1">
                <h3>22<small style="color: #000000;">3月</small></h3>
            </a>
            <a href="javascript:;" class="weui-grid_list_2">
                <img height="70" width="70" src="{{asset('uploads/big/2017-03-04-12-32-42-58bab3ea0bf28.jpg')}}" alt="">
            </a>
            <a href="javascript:;" class="weui-grid_list_3">
                <div class="weui-grid__icon">
                    <img src="./images/icon_tabbar.png" alt="">
                </div>
                <p class="weui-grid__label">Grid</p>
            </a>
        </div>
    </div>
@endsection

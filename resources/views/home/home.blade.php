@extends('layouts.comm')
@section('content')
    <div class="location">
        <div class="">
            @if (session('success'))
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info"></i> 提示语!</h4>
                    {{ session('success') }}
                </div>
            @endif
            <div class="bs-callout_home bs-callout-danger" id="callout-tables-striped-ie8" >
                <h4>我的旅行地图</h4>
                <p>就这样，我与世界的距离 <code>更加</code>之手之间</p>
            </div>
            <div class="locat-left" style="float: right;width:50%;">
                <div class="search">
                    <form>
                        <input type="text" value="" placeholder="search...">
                        <input type="submit" value="">
                    </form>
                </div>
            </div>
            <div class="locat-bottm">
                <div class="locat-left">
                    <div id="map" style="height:500px; width:100%"  style="z-index: 0" >
                        <div class="search" style="z-index: 999;display: block; top: -20px;right: 0px;float: right;">
                            <input id="tipinput" type="text" value="" placeholder="直接搜索你的足迹">
                        </div>
                    </div>

                    <script type="text/javascript" src="{{asset('static/js/map/layer.js')}}"></script>
                    <script>
                        ;!function(){
//页面一打开就执行，放入ready是为了layer所需配件（css、扩展模块）加载完毕


                        }();
                    </script>
                    <script type="text/javascript" src="{{asset('static/js/map/maker.js')}}"></script>
                    <script type="text/javascript">
                        window.onload = function(){
                            $.ajax({
                                        type:"get",
                                        url:"{{url("api2/Impl_getMarker")}}",
                                        async:true,
                                        data:{user_id:"{{$user_id}}"}
                                    })
                                    .done(function(data,textStatus){
                                        var fun = init_start; //引用abc函数
                                        fun(data);
                                    })
                                    .always(function(){

                                    });

                        };
                    </script>
                </div>


                <div class="loc-left">
                    <ul>
                        <li><a href="{{url("add_dynamic")}}"><i class="plus"></i></a></li>
                        <li><a href="#"><i class="adm"></i></a></li>
                        <li><a href="#"><i class="set"></i></a></li>
                        <li><a href="#"><i class="str"></i></a></li>
                        <li><a href="#"><i class="plc"></i></a></li>
                        <div class="clearfix"> </div>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
@endsection

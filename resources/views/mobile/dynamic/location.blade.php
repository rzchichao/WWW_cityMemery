@extends('mobile.layouts.header')
@section('search')
    @include('mobile.layouts.comm')
    @endsection
@section('content')
    <script src="http://webapi.amap.com/maps?v=1.3&key=7b9171cfceb0084db4b9c3a62f6b8810&callback=init&plugin=AMap.MarkerClusterer"></script>
    <script src="//webapi.amap.com/ui/1.0/main-async.js"></script>
    <div style="width: 100%;height: 94px;">
    </div>
    <form action="{{url('mobile_add_dynamic')}}" method="post" >
        <div id="contentlocation"  style="width: 100%" >
            {{ csrf_field() }}
            <input type="hidden" id="lnglat" name="lnglat" value="">
            <input id="location_date" name="time" style=" float: left;display: block;margin-left: auto;margin-right: auto;text-align: center;height:50px;font-size: 28px;" class="weui-input" type="date" value=""/>
            <span style="display: block;margin-left: auto;margin-right: auto;text-align:center;font-size: 10px;font-family:'微软雅黑';color:#">选择记录的时间</span>
        </div>
        <div id="address" style="height:30px;line-height: 30px;font-family: '微软雅黑';font-weight: 300;color: #b4b4b4">
            <input name="address" id="address_location" style="width: 100%;border: none;color: #878787;font-size: 18px;" type="text" value=""/>
        </div>
        <div style="width: 100%" id="choosemap">
            <img id="chooseimg" style="width:32px;height: 32px;position:fixed;z-index: 10" src="{{asset('static/img/location.png')}}">
        </div>
        <div>
            <button type="submit" style="width: 100%;height: 45px;border: none; background-color: #f9a64a;color:#ffffff;font-size: 28px;font-weight: 300">下一步</button>
        </div>
    </form>
    <script>
        var toolbar;
        var $searchBar = $('#searchBar'),
            $searchResult = $('#searchResult'),
            $searchText = $('#searchText'),
            $searchInput = $('#tipinput'),
            $searchClear = $('#searchClear'),
            $searchCancel = $('#searchCancel');
        var lnglat;
        function hideSearchResult(){
            $searchResult.hide();
            $searchInput.val('');
        }
        function cancelSearch(){
            hideSearchResult();
            $searchBar.removeClass('weui-search-bar_focusing');
            $searchText.show();
        }
        $searchText.on('click', function(){
            $searchBar.addClass('weui-search-bar_focusing');
            $searchInput.focus();
        });
        $searchInput
            .on('blur', function () {
                if(!this.value.length) cancelSearch();
            })
            .on('input', function(){
                if(this.value.length) {
                    $searchResult.show();
                } else {
                    $searchResult.hide();
                }
            })
        ;
        $searchClear.on('click', function(){
            hideSearchResult();
            $searchInput.focus();
        });
        $searchCancel.on('click', function(){
            cancelSearch();
            $searchInput.blur();
        });
        function init(){
            initAMapUI();
            map = new AMap.Map("choosemap", {
                resizeEnable: true,
                center:[112.34759, 36.0607761],
                zoom: 4
            });
            map.on('touchend',function () {
                lnglat=map.getCenter().toString();
                dealLnglat(lnglat);

            })
            AMapUI.load(['lib/$'], function($){
            });
            AMapUI.loadUI(['misc/PoiPicker'], function(PoiPicker) {
                var poiPicker = new PoiPicker({
                    input: 'tipinput' //输入框id
                });
                poiPickerReady(poiPicker);
            });
            AMap.plugin('AMap.ToolBar',function(){//异步
                toolbar = new AMap.ToolBar({locate:false
                });
                toolbar.hide();
                map.addControl(toolbar);
                toolbar.doLocation();
                AMap.event.addListener(toolbar,'location', onComplete);//返回定位信息
            });
            //解析定位结果
        }
        function onComplete() {
            lnglat=toolbar.getLocation().toString();
            dealLnglat(lnglat);
        }
        function dealLnglat(lnglat) {
            $("#lnglat").val(lnglat);
            $.ajax({
                type:"GET",
                //提交的网址
                url:"{{url('api/Impl_dellnglat')}}",
                //提交的数据
                data:{lnglat:lnglat},
                //返回数据的格式
                datatype: "json",
                //在请求之前调用的函数
                //成功返回之后调用的函数
                success:function(data){
                    $("#address_location").val(data);
                },
                //调用执行后调用的函数
                complete: function(XMLHttpRequest, textStatus){

                },
                //调用出错执行的函数
                error: function(){
                    //请求出错处理
                }
            });
        }
        //解析定位错误信息dfdsf
        function onError(data) {
        }
        function poiPickerReady(poiPicker){
            poiPicker.on('poiPicked', function(poiResult) {
                map.setCenter(poiResult.item.location)
                map.setZoom(17)
                lnglat=poiResult.item.location.toString();
                dealLnglat(lnglat);

            });
        }
        var clitentHeight = document.documentElement.clientHeight;
        var clitentWidth = document.documentElement.clientWidth;
        var content_location= (clitentHeight)/4;
        var choosemap= (clitentHeight-content_location-169);
        var chooseimg= (choosemap)/2+content_location+94;
        $("#contentlocation").css('height',content_location+'px')
        $("#choosemap").css('height',choosemap+'px')
        $("#chooseimg").css('top',chooseimg+'px')
        $("#chooseimg").css('left',clitentWidth/2-16+'px')
        $("#location_date").css('margin-top',content_location/2-25+'px')
        document.getElementById('location_date').valueAsDate = new Date();
    </script>
@endsection
@extends('mobile.layouts.header')
@section('content')
    <script src="http://webapi.amap.com/maps?v=1.3&key=7b9171cfceb0084db4b9c3a62f6b8810&callback=init&plugin=AMap.MarkerClusterer"></script>
    <script src="//webapi.amap.com/ui/1.0/main-async.js"></script>
    <script type="text/javascript" src="{{asset('static/js/map/index.js')}}">
    </script>
    <input type="hidden" id="self_userid" value="{{$user->id}}"/>
    <div class="banner" style="margin-top: 45px;" >
        <div id="tpl"  style="display: none;background-color: #ffffff;position: fixed;top:45px;z-index: 1040;width: 100%">
        </div>
        <div style="width:100%;z-index: 2" id="map-index"></div>
        <script type="text/javascript">
            $(function () {
                $("#map-index").css('height',clitentHeight-45);
            })
        </script>
    </div>
@endsection

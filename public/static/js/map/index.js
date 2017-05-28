var map, geolocation,marker,dynamic,inchina;
//加载地图，调用浏览器定位服务
var cluster, markers = [];
var clitentHeight = document.documentElement.clientHeight;
function init(){
    initAMapUI();
    map = new AMap.Map("map-index", {
        resizeEnable: true,
        center:[112.34759, 36.0607761],
        zoom: 4
    });
    AMapUI.load(['lib/$'], function($){
    });
    $.ajax({
        type:"get",
        url:"http://www.city.rztaiyang.com/api2/Impl_getAllShared",
        async:false,
        dataType:"JSON"
    })
    .done(function(data,textStatus){
            dynamic=data;
    })
    if(dynamic!=null){
        for(var i=0;i<dynamic.length;i++){
            var lnglat=dynamic[i]['lnglat'];
            var markerPosition = [  lnglat.split(",")[0],  lnglat.split(",")[1]];
            marker = new AMap.Marker({
                position: markerPosition,
                icon: "http://www.city.rztaiyang.com/static/img/mark1.png",
                offset: {x: -8,y: -34},
                extData:{dynamicid:dynamic[i]['id'],like_count:dynamic[i]['like_count']}
            });
            marker.on('click',function(e){
                var extdata=this.getExtData();
                var user_id=$("#self_userid").val();
                $("#tpl").load("http://www.city.rztaiyang.com/api2/Impl_getDynamicDetail",{dynamic_id:extdata['dynamicid'],user_id:user_id});
                $("#tpl").css('display','block');

            });
            markers.push(marker);
        }
    }
    addCluster(0);
    // 添加点聚合
    function addCluster(tag) {
        if (cluster) {
            cluster.setMap(null);
        }
        if (tag == 1) {
        } else {
            map.plugin(["AMap.MarkerClusterer"], function() {
                cluster = new AMap.MarkerClusterer(map, markers);
            });
        }
    }
}
function addMarker(lng,lat) {
    if (marker) {
        marker.setMap(null);
        marker = null;
    }
    marker = new AMap.Marker({
        icon: "http://www.city.rztaiyang.com/static/img/mark.png",
        position: [lng,lat],
        draggable: true,
        cursor: 'move',
        raiseOnDrag: true
    });
    marker.setMap(map);
}


var map, geolocation,marker,dynamic;
//加载地图，调用浏览器定位服务
var cluster, markers = [];
function init(){
    initAMapUI();
    map = new AMap.Map("map-ucenter", {
        resizeEnable: true,
        center:[112.34759, 36.0607761],
        zoom: 4
    });
    AMapUI.load(['lib/$'], function($){
    });
    $.ajax({
        type:"get",
        url:"http://www.city.rztaiyang.com/api2/Impl_getSelfDynamic",
        async:false,
        data:{user_id:$("#user_id").val()},
        dataType:"JSON"
    })
    .done(function(data,textStatus){
            dynamic=data;
    })
        for(var i=0;i<dynamic.length;i++){
            var lnglat=dynamic[i]['lnglat'];
            var markerPosition = [  lnglat.split(",")[0],  lnglat.split(",")[1]];
            marker = new AMap.Marker({
                position: markerPosition,
                icon: "http://amappc.cn-hangzhou.oss-pub.aliyun-inc.com/lbs/static/img/marker.png",
                offset: {x: -8,y: -34},
                extData:{dynamicid:dynamic[i]['id'],like_count:dynamic[i]['like_count']}
            });
            marker.on('click',function(e){
                var extdata=this.getExtData();
                var user_id=$("#user_id").val();
                $("#tpl").load("http://www.city.rztaiyang.com/api2/Impl_getDynamicDetail",{dynamic_id:extdata['dynamicid'],user_id:user_id});
                $("#tpl").css('display','block');
            });
            markers.push(marker);
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
                var sts = [{
                    url: "http://a.amap.com/lbs/static/img/1102-1.png",
                    size: new AMap.Size(32, 32),
                    offset: new AMap.Pixel(-16, -30)
                }, {
                    url: "http://a.amap.com/lbs/static/img/2.png",
                    size: new AMap.Size(32, 32),
                    offset: new AMap.Pixel(-16, -30)
                }, {
                    url: "http://lbs.amap.com/wp-content/uploads/2014/06/3.png",
                    size: new AMap.Size(48, 48),
                    offset: new AMap.Pixel(-24, -45),
                    textColor: '#CC0066'
                }];
                cluster = new AMap.MarkerClusterer(map, markers,{
                    styles:sts
                });
            });
        }
    }
}


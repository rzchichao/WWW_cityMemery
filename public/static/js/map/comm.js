var marker,map;
function init(){
    map = new AMap.Map('map', {
        center: [103.811685, 36.043361],
        zoom: 4
    });
    var autoOptions = {
        input: "tipinput"
    };
    var auto = new AMap.Autocomplete(autoOptions);
    var placeSearch = new AMap.PlaceSearch({
        map: map
    });  //构造地点查询类
    AMap.event.addListener(auto, "select", select);//注册监听，当选中某条记录时会触发
    function select(e) {
        placeSearch.setCity(e.poi.adcode);
        placeSearch.search(e.poi.name);  //关键字查询查询
    }
    map.plugin(["AMap.ToolBar"], function() {
        map.addControl(new AMap.ToolBar());
    });
    map.on('click', function(e) {
        var lng=e.lnglat.getLng();
        var lat=e.lnglat.getLat();
        addMarker(lng,lat);
        var lnglat=lng+","+lat;
        $("#lnglat").val(lnglat);
    });
}

function addMarker(lng,lat) {
    if (marker) {
        marker.setMap(null);
        marker = null;
    }
    marker = new AMap.Marker({
        icon: "http://webapi.amap.com/theme/v1.3/markers/n/mark_b.png",
        position: [lng, lat],
        draggable: true,
        cursor: 'move',
        raiseOnDrag: true
    });
    marker.setMap(map);
}


/**
 * Created by chichao on 2017/3/6.
 */
var marker1,map,markers = [];
var infoWindow = new AMap.InfoWindow({
    isCustom: true,  //使用自定义窗体
    offset: new AMap.Pixel(100, -20)
});
function init_start(dynamic){
    map = new AMap.Map('map-ucenter', {
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
    for (var i=0,len=dynamic.length; i<len; i++)
    {
        var marker;
            marker = new AMap.Marker({
                position: [dynamic[i].lng,dynamic[i].lat],
                title:dynamic[i].destination,
                map: map,
                extData:{id:dynamic[i].id,destination:dynamic[i].destination,together:dynamic[i].together,photos:dynamic[i].photos},
            });
        console.log(marker)
        AMap.event.addListener(marker, 'click', markerClick);
        markers.push(marker);
    }
    function markerClick(e){
        layer.ready(function(){
            //官网欢迎页
            var dynamic_id=e.target.G.extData.id;
            $.ajax({
                    type:"get",
                    url:'http://www.city.rztaiyang.com/api2/Impl_getAlbum',
                    data:{dynamic_id:dynamic_id},
                    async:false,
                    dataType:"JSON"
                })
                .done(function(data,textStatus){
                    layer.photos({
                        photos: data //格式见API文档手册页
                        ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机
                    });
                })
        });
        //var destination=e.target.G.extData.destination;
        //var together=e.target.G.extData.together;
        //var photos=e.target.G.extData.photos;
        //infoWindow.setContent(createInfoWindow(destination,photos,together));
        //infoWindow.open(map, e.target.getPosition());
    }
    function createInfoWindow(destination,photos, together) {
        var info = document.createElement("div");
        info.className = "info";
        //可以通过下面的方式修改自定义窗体的宽高
        //info.style.width = "400px";
        // 定义顶部标题
        var top = document.createElement("div");
        var titleD = document.createElement("div");
        var closeX = document.createElement("img");
        top.className = "info-top";
        titleD.innerHTML = destination;
        closeX.src = "http://webapi.amap.com/images/close2.gif";
        closeX.onclick = closeInfoWindow;
        top.appendChild(titleD);
        top.appendChild(closeX);
        info.appendChild(top);
        // 定义中部内容
        var middle = document.createElement("div");
        middle.className = "info-middle";
        middle.style.backgroundColor = 'white';
        var content = [];
        content.push("<div>");
        content.push("<ul style='z-index:999'>");
        content.push("<li style='z-index:999'><img style='width:200px;' src='"+photos[0].name+"'/></li>");
        content.push("</ul>");
        content.push("</div>");
        middle.innerHTML = content;
        info.appendChild(middle);
        // 定义底部内容
        var bottom = document.createElement("div");
        bottom.className = "info-bottom";
        bottom.style.position = 'relative';
        bottom.style.top = '0px';
        bottom.style.margin = '0 auto';
        var sharp = document.createElement("img");
        sharp.src = "http://webapi.amap.com/images/sharp.png";
        bottom.appendChild(sharp);
        info.appendChild(bottom);
        return info;
    }

}
function closeInfoWindow() {
    map.clearInfoWindow();
}
function marker(lnt,lat){
    console.log(lnt,lat);
    marker1= new AMap.Marker({
        icon: "http://webapi.amap.com/theme/v1.3/markers/n/mark_b.png",
        position: [lnt,lat]
    });
    markers.push(marker)
}



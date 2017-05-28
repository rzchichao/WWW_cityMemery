var Audio_num=0;
var START,END;
var localVoice = new Array();
var localId;
var voice_time = new Array();
var voice_time_display;
var voice_num = 0;
var dynamicid=$("#dynamic_id").val();
var site_url=$("#site_url").val();
var actiontype=$("#actiontype").val();

function add_audio() {
    if(Audio_num==0){
        console.log(Audio_num)
        Audio_num++;
        $('#content').append('<div  class="switch demo1" style="display: flex;" ><input onclick="audio(this)" type="checkbox"><label></label></div>');
        $('html,body').animate({scrollTop: (document.body.clientHeight + document.documentElement.clientHeight) + 'px'}, 0);
    }
}
function add_modifyaudio(audio){
    if(audio['type']=='self'){
        $('#content').append('<div style="width:100%;float: left;margin-bottom: 8px;" id="' +audio['id'] + '" class="audio" ><span onclick="playvoice(this,'+ voice_num +')" id="audio_area" class="db audio_area" > <span class="audio_wrp db" style="float: left;width: 95%;"> <span class="audio_play_area"> <i class="icon_audio_default"></i> <i class="icon_audio_playing"></i> </span> <span id="audio_length_'+ audio['id'] +'" class="audio_length tips_global">'+ voice_time_display +'</span><span id="audio_progress_'+ audio['id'] +'" class="progress_bar"></span> </span></span><span style="float: right;height: 46px;line-height: 46px;font-size: 25px;" onclick="del_audio(this)" class="glyphicon glyphicon-trash"></span></div>');
        $('html,body').animate({scrollTop: (document.body.clientHeight + document.documentElement.clientHeight)+'px'}, 0);
        voice_num++;
    }else{
        var timelength=audio['timelength'];
        var strs= new Array(); //定义一数组
        strs=timelength.split(":"); //字符分割
        $('#content').append('<div style="width:100%;float: left;margin-bottom: 8px;" id="' +audio['id'] + '" class="audio" >' +
            '<span onclick="playmodifyvoice(this,'+strs[1]+')" id="audio_area" class="db audio_area" >' +
            '<span class="audio_wrp db" style="float: left;width: 95%;"> <span class="audio_play_area">' +
            '<i class="icon_audio_default"></i> <i class="icon_audio_playing"></i> </span> ' +
            '<span id="audio_length_'+ audio['id'] +'" class="audio_length tips_global">' + audio['timelength'] +'</span>' +
            '<span id="audio_progress_'+ audio['id'] +'" class="progress_bar"></span> ' +
            '</span></span>' +
            '<span style="float: right;height: 46px;line-height: 46px;font-size: 25px;" onclick="del_audio(this)" class="glyphicon glyphicon-trash"></span></div>');
        $('html,body').animate({scrollTop: (document.body.clientHeight + document.documentElement.clientHeight)+'px'}, 0);
        voice_num++;
    }
}
function audio(obj) {
    var audiostatus=$(obj).is(':checked');
    wx.ready(function () {
        if(audiostatus){
            START = new Date().getTime();
            wx.startRecord({
                success: function () {
                    localStorage.rainAllowRecord = 'true';
                },
                cancel: function () {
                    alert('用户拒绝授权录音');
                }
            });
        }else {
            END = new Date().getTime();
            voice_time[voice_num] = END - START;
            START = 0;
            END = 0;
            voice_time_display = formatDuring(voice_time[voice_num]);
            wx.stopRecord({
                success: function (res) {
                    localVoice[voice_num]=res.localId;
                    localId = res.localId.toString();
                    uploadVoice();
                    $(".demo1").remove();
                    Audio_num=Audio_num-1;
                }
            });
        }
    });
}
function fix(num, length) {
    return ('' + num).length < length ? ((new Array(length + 1)).join('0') + num).slice(-length) : '' + num;
}
//                    将毫秒转化成时间格式
function formatDuring(mss) {
    var days = parseInt(mss / (1000 * 60 * 60 * 24));
    var hours = parseInt((mss % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = parseInt((mss % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = (mss % (1000 * 60)) / 1000;
    return fix(minutes,2) + ":" + fix(seconds.toFixed(0),2);
}
//                    播放音频
function playvoice(obj,num) {
    var id = $(obj).parent().attr('id');
    $('#audio_progress_'+id).css('width','0%');
    $('#audio_progress_'+id).css('border-radius','0 0 10px 0');
    $('#audio_progress_'+id).each(function(i,item){
        $(item).animate({
            width: "94%"
        },voice_time[num]);
    });
    wx.playVoice({
        localId: localVoice[num] // 需要播放的音频的本地ID，由stopRecord接口获得
    });
}
function playmodifyvoice(obj,timelength) {

    var id = $(obj).parent().attr('id');
    $('#audio_progress_'+id).css('width','0%');
    $('#audio_progress_'+id).css('border-radius','0 0 10px 0');
    $('#audio_progress_'+id).each(function(i,item){
        $(item).animate({
            width: "94%"
        },timelength*1000);
    });
}
//                    上传音频
function uploadVoice(){
    //调用微信的上传录音接口把本地录音先上传到微信的服务器
    //不过，微信只保留3天，而我们需要长期保存，我们需要把资源从微信服务器下载到自己的服务器

   url=site_url +'/api/Impl_uploadWxVoice';
    wx.uploadVoice({
        localId: localId, // 需要上传的音频的本地ID，由stopRecord接口获得
        isShowProgressTips: 1, // 默认为1，显示进度提示
        success: function (res) {
            //把录音在微信服务器上的id（res.serverId）发送到自己的服务器供下载。
            $.ajax({
                url: url,
                type: 'get',
                data: {mediaid:res.serverId,dynamicid:dynamicid},
                dataType: "json",
                success: function (data) {
                    var audio=new Array();
                    audio['id']=data.id;
                    audio['type']='self';
                    add_modifyaudio(audio)
                },
                error: function (xhr, errorType, error) {
                    console.log(error);
                }
            });
        }
    });
}
function del_audio(obj) {
    $(obj).parent().remove();
}
function del_text(obj) {
    $(obj).parent().remove();
}
function del_photo(obj) {
    var gallery_id=$(obj).attr('id');
    console.log(gallery_id)
    var strs=new Array();
    strs=gallery_id.split('q');
    $(".photo").each(function () {
        if($(this).attr('id')==strs[1]){
            $(this).remove()
        }
    })
}
//添加文本
function add_textarea(){
    var textclass=$('#content').children("div:last-child").attr('class');
    if(textclass!='text'){
        $('#content').append('' +
            '<div class="text" style="width: 100%;float: left;margin-bottom: 0px;border-bottom: 2px solid #faf2cc">' +
            '<textarea  name="" onpropertychange="MaxMe(this)" oninput="MaxMe(this)" style="overflow-y:visible ;font-size: 21px;color:#666;height:80px;"  class="weui-textarea" placeholder="输入您想说的话" ></textarea>' +
            '<span style="position: relative;top:-46px;float: right;height: 46px;line-height: 46px;font-size: 25px;" onclick="del_text(this)" class="glyphicon glyphicon-trash"></span>' +
            '</div>');
        $('html,body').animate({scrollTop: (document.body.clientHeight + document.documentElement.clientHeight) + 'px'}, 0);
    }
}
//添加修改文本
function add_modifytextarea(modifytext){
    var textclass=$('#content').children("div:last-child").attr('class');
    if(textclass!='text'){
        $('#content').append('' +
            '<div class="text" style="width: 100%;float: left;margin-bottom: 0px;border-bottom: 2px solid #faf2cc">' +
            '<textarea  name="" onpropertychange="MaxMe(this)" oninput="MaxMe(this)" style="overflow-y:visible ;font-size: 21px;color:#666;height:80px;"  class="weui-textarea" placeholder="输入您想说的话" >' +modifytext+
            '</textarea>' +
            '<span style="position: relative;top:-46px;float: right;height: 46px;line-height: 46px;font-size: 25px;" onclick="del_text(this)" class="glyphicon glyphicon-trash"></span>' +
            '</div>');
        $('html,body').animate({scrollTop: (document.body.clientHeight + document.documentElement.clientHeight) + 'px'}, 0);
    }
}
function MaxMe(o) {
    o.style.height = o.scrollTop + o.scrollHeight + "px";
}
$.fn.stringify = function() {
    return JSON.stringify(this);
}
function camera_wx(){
    wx.ready(function(){
        wx.chooseImage({
            count: 1, // 默认9
            sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
            sourceType: ['album','camera'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
                localIds = res.localIds[0].toString();
                wx.uploadImage({
                    localId: localIds, // 需要上传的图片的本地ID，由chooseImage接口获得
                    isShowProgressTips: 1, // 默认为1，显示进度提示
                    success: function (res) {
                        mediaId = res.serverId; // 返回图片的服务器端ID
                        var photo=uploadimg(mediaId)
                        addpic(photo);
                    },
                    fail: function (error) {
                        picPath = '';
                        localIds = '';
                        alert(Json.stringify(error));
                    }
                });
            }
        });

    });
}
function uploadimg(e){
    var photo;
    url=site_url+'/api/Impl_uploadWxImg';
    $.ajax({
        type:"get",
        url:url,
        data:{mediaid:e,dynamicid:dynamicid},
        async:false,
        dataType:"JSON"
    })
        .done(function(data,textStatus){
            photo=data;
        })
    return photo;
}
function addpic(photo){
    $('#content').append('<div id="'+photo.id+'" class="photo" style="width: 100%;float: left;background-color:#ffffff;float: left;padding:5px;"><img id="uploaderFiles'+photo.id+'" style="width:100%;" class="img-responsive" src="'+photo.name+'"/></div>');
    $('html,body').animate({scrollTop: (document.body.clientHeight + document.documentElement.clientHeight) + 'px'}, 0);
    $(function(){
        $("#gallerybody").after(' <div class="weui-gallery" style="z-index:2000"  id="gallery'+photo.id+'">' +
            ' <span class="weui-gallery__img"  id="galleryImg'+photo.id+'" style="background-image:url('+photo.name+')"></span>' +
            ' <div class="weui-gallery__opr">' +
            '<a href="javascript:" id="galleryq'+photo.id+'"  onclick="del_photo(this)" class="weui-gallery__del">' +
            ' <i class="weui-icon-delete weui-icon_gallery-delete"></i>' +
            ' </a>' +
            ' </div>' +
            '</div>' +
            "")
        $("#uploaderFiles"+photo.id+"").on("click", function(){
            $("#gallery"+photo.id+"").fadeIn(100);
        });
        $("#gallery"+photo.id+"").on("click", function(){
            $("#gallery"+photo.id+"").fadeOut(100);
        });
    });
}
function addmodifypic(photo){
    $('#content').append('<div id="'+photo['id']+'" class="photo" style="width: 100%;float: left;background-color:#ffffff;float: left;padding:5px;"><img id="uploaderFiles'+photo['id']+'" style="width:100%;" class="img-responsive" src="'+photo['name']+'"/></div>');
    $('html,body').animate({scrollTop: (document.body.clientHeight + document.documentElement.clientHeight) + 'px'}, 0);
    $(function(){
        $("#gallerybody").after(' <div class="weui-gallery" style="z-index:2000"  id="gallery'+photo.id+'">' +
            ' <span class="weui-gallery__img"  id="galleryImg'+photo['id']+'" style="background-image:url('+photo['name']+')"></span>' +
            ' <div class="weui-gallery__opr">' +
            '<a href="javascript:" id="galleryq'+photo['id']+'"  onclick="del_photo(this)" class="weui-gallery__del">' +
            ' <i class="weui-icon-delete weui-icon_gallery-delete"></i>' +
            ' </a>' +
            ' </div>' +
            '</div>' +
            "")
        $("#uploaderFiles"+photo['id']+"").on("click", function(){
            $("#gallery"+photo['id']+"").fadeIn(100);
        });
        $("#gallery"+photo['id']+"").on("click", function(){
            $("#gallery"+photo['id']+"").fadeOut(100);
        });
    });

}
$('#submit').on('click',function () {
    dealdynamic('submit')
});
function dealdynamic(type) {
    $("#loadingToast").css('display','block');
    var medias = new Array();
    var id;
    var val;
    $('.media').children().each(function (key,obj) {
        medias[key] = new Array;
        var type = $(obj).attr('class');
        if(type == 'text') {
            val = $(obj).children().val();
            medias[key] = new Array();
            medias[key][0] = null;
            medias[key][1] = val;
            medias[key][2] = type;

        }else if(type == 'photo'){
            id = $(obj).attr('id');
            val = null;
            medias[key][0] = id;
            medias[key][1] = val;
            medias[key][2] = type;
        }else if(type == 'audio'){
            id = $(obj).attr('id');
            val = $('#audio_length_'+id).text();
            medias[key][0] = id;
            medias[key][1] = val;
            medias[key][2] = type;
        }
    });
    var title = $("input[name='title']").val();
    var time = $("input[name='time']").val();
    var _token = $("input[name='_token']").val();
    var open_id = $("input[name='open_id']").val();
    var toast__content;
    if(actiontype=='add'){
        if(type=='draft'){
           toast__content="成功保存为草稿";
        }else {
           toast__content="发布成功";
        }
        var url=site_url+'/api/Impl_addWxDynamic';
    }else{
        toast__content="修改成功";
        var url=site_url+'/api/Impl_modifyWxDynamic';
    }
    $("#toast__content").html(toast__content);
    $.ajax({
        url : url,
        type : 'POST',
        datatype : 'json',
        data:{
            medias : $(medias).stringify(),
            title : title,
            _token : _token,
            open_id : open_id,
            dynamic_id : dynamicid,
            status:type
        },
        success : function () {
            $("#loadingToast").css('display','none');
            $("#toast").css('display','block');
            setTimeout(function () {
                $("#toast").css('display','none');
                var url=site_url+'/mhome'
                window.location.href=url;
            },300)
        },
        error : function () {
        }
    });
}
$("#add_draft").on('click',function () {

    dealdynamic('draft')
})

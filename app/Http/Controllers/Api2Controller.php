<?php

namespace App\Http\Controllers;

use App\Area;
use App\Follow;
use App\Citys;
use App\Dynamic;
use App\Dynamic_photo;
use App\Http\Requests;
use App\Photos;
use App\Wx_user;
use App\User;
use Illuminate\Http\Request;
use Redis;
use Illuminate\Support\Facades\Session;

// 指定允许其他域名访问
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:GET');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
class Api2Controller extends Controller
{
    public function Impl_getMarker(Request $request){
        $user_id=$request->input('user_id');
        $dynamics=Dynamic::where('user_id',$user_id)->get();
        foreach($dynamics as $item){
            $lnglat=$item->lnglat;
            $arraylnglat= explode(',',$lnglat);
            $item->lng=$arraylnglat[0];
            $item->lat=$arraylnglat[1];
            $item->photos=$this->getPhotos($item->photos());
        }
        return response()->json($dynamics);
    }
    public function Impl_getAlbum(Request $request){
        $dynamic_id=$request->input('dynamic_id');
        $dynamics=Dynamic::where('id',$dynamic_id)->first();
        $dynamics->data=$this->getPhotos($dynamics->photos());
        $dy=new Dynamic;
        $dy->status=1;
        $dy->msg=1;
        $dy->title="test";
        $dy->id=8;
        $dy->start=0;
        $dy->data=$this->getPhotos($dynamics->photos());
        return response()->json($dy);
    }
    private function getPhotos($photos){
        if(!empty($photos)){
           $photos= $photos->select("photo_id")->get();
            $photosArr=array();
            foreach ($photos as $item) {
                array_push($photosArr,$item->photo_id);
            }
            $rs= Photos::wherein('id',$photosArr)->select(['name as src','id as pid','thumb as thumb'])->get();
           foreach($rs as $item){
                $item->alt=Dynamic_photo::where('photo_id',$item->pid)->first()->body;
           }
        }
        return $rs;
    }
    public function getSharedByProvince(){
        $pdynamics = Provinces::select('id','name','center')->get();
        foreach ($pdynamics as $pitem){
            $pitem->count = Provinces::find($pitem->id)->dynamic()->count();
            $citysarray = array();
            foreach ($pitem->citys()->get() as $index=> $citem){
                $city=new Citys();
                $city->name= $citem->name;
                $city->center=$citem->center;
                $city->count = Citys::find($citem->id)->dynamic()->count();
                $citysarray[$index]=$city;
                $dynamicsarray = array();
                foreach ($citem->dynamic()->get() as $key => $ditem) {
                    $dynamic = new Dynamic();
                    $dynamic->destination = $ditem->destination;
                    $dynamic->lnglat = $ditem->lnglat;
                    $dynamicsarray[$index] = $dynamic;
                }
                $city->subdynamics = $dynamicsarray;
            }
            $pitem->subcitys = $citysarray;
        }
        return response()->json($pdynamics);
    }
    public function Impl_getAllShared(){
        $dynamics = Dynamic::where('is_share','=',1)->where('is_save','=',1)->select('id','lnglat')->get();
        foreach ($dynamics as $dynamic) {
            $dynamic->like_count=$dynamic->dynamic_like()->where('stutas',1)->count();
        }
        return response()->json($dynamics);
    }
    public function Impl_getSelfDynamic(Request $request){
        $user_id=$request->user_id;
        $dynamics =User::find($user_id)->dynamic()->where('is_save','=',1)->select('id','lnglat')->get();
        return response()->json($dynamics);
    }
    public  function Impl_getInChina(Request $request){
        $lng=$request->lng;
        $lat=$request->lat;
        $lnglat=$lng.",".$lat;
        $rs=$this->dealLnglat($lnglat);
        return response()->json($rs);
    }
    public  function Impl_getDynamicDetail(Request $request){
        $dynamic_id=$request->dynamic_id;
        $user_id=$request->user_id;
        $dynamic=Dynamic::find($dynamic_id);
        $dyarray=array();
        $dy_photos=$dynamic->dynamic_photos()->get();
        foreach ($dy_photos as $dy_photo) {
            $dyarray[$dy_photo->sort]=$dy_photo;
        }
        $dy_texts=$dynamic->dynamic_texts()->get();
        foreach ($dy_texts as $dy_text) {
            $dyarray[$dy_text->sort]=$dy_text;
        }
        $dy_audios=$dynamic->dynamic_audios()->get();
        foreach ($dy_audios as $dy_audio) {
            $dyarray[$dy_audio->sort]=$dy_audio;
        }
        $dynamic->user=$dynamic->user()->first();
        $dynamic->laifang=$user_id;
        $result = Follow::where('uid_following','=',$dynamic->user()->first()->id)->where('uid_followed','=',$user_id)->first();
            if($result){
                $dynamic->is_follow = 1;
            }else{
                $dynamic->is_follow = 0;
         }
        $dynamic->medias=array_sort_recursive($dyarray);
        return view('mobile.dynamic.detail')->with('dynamic',$dynamic);
    }

    public  function Impl_getDynamicDetail2(Request $request){
        $dynamic_id=$request->dynamic_id;
        $dynamic=Dynamic::find($dynamic_id);
        $dyarray=array();
        $dy_photos=$dynamic->dynamic_photos()->get();
        foreach ($dy_photos as $dy_photo) {
            $dyarray[$dy_photo->sort]=$dy_photo;
        }
        $dy_texts=$dynamic->dynamic_texts()->get();
        foreach ($dy_texts as $dy_text) {
            $dyarray[$dy_text->sort]=$dy_text;
        }
        $dy_audios=$dynamic->dynamic_audios()->get();
        foreach ($dy_audios as $dy_audio) {
            $dyarray[$dy_audio->sort]=$dy_audio;
        }
        $dynamic->user=$dynamic->user()->first();
        $dynamic->medias=array_sort_recursive($dyarray);
        $dynamic->cityname=Area::find($dynamic->city_id)->name;
        $date=explode('-',$dynamic->time);
        $dynamic->date=$date;
        $app = app('wechat');
        $js=$app->js;
        return view('mobile.dynamic.detail2')->with(['dynamic'=>$dynamic,'js'=>$js]);
    }
}

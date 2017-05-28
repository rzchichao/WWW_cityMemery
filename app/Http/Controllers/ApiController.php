<?php

namespace App\Http\Controllers;
use App\Area;
use App\Audios;
use App\Dynamic;
use App\Dynamic_like;
use App\Dynamic_media;
use App\Dynamic_photo;
use App\Http\Requests;
use App\Photos;
use App\Texts;
use App\Wx_user;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use zgldh\QiniuStorage\QiniuStorage;
use Qiniu;

header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:GET');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
class ApiController extends Controller
{
    public function __construct()
    {
    }
    public function test(){

    $rs=User::find(15)->dynamicMedia()->get();
    dd($rs);
    }
    public function  Impl_addLikeDynamic(Request $request){
        $dynamic_id=$request->dynamic_id;
        $user_id=$request->user_id;
        $rs_like=User::find($user_id)->dynamic_like()->where('dynamic_id',$dynamic_id)->first();
        if(empty($rs_like)){
            $rs_like=new Dynamic_like();
            $rs_like->user_id=$user_id;
            $rs_like->dynamic_id=$dynamic_id;
            $rs=1;
        }else{
            if($rs_like->stutas==1){
                $rs_like->stutas=-1;
                $rs=-1;
            }else{
                $rs_like->stutas=1;
                $rs=1;
            }
        }
        $rs_like->save();
        return return_json($rs);

    }
    public function  Impl_isLikeDynamic(Request $request){
        $dynamic_id=$request->dynamic_id;
        $user_id=$request->user_id;
        $like_count=Dynamic::find($dynamic_id)->dynamic_like()->where('stutas',1)->count();
        $rs_like=User::find($user_id)->dynamic_like()->where('dynamic_id',$dynamic_id)->first();
        if(!empty($rs_like)){
            if($rs_like->stutas==1){
                $rs=1;
            }else{
                $rs=-1;
            }
        }else{
            $rs=-1;
        }
        $rsdy=new Dynamic();
        $rsdy->rs=$rs;
        $rsdy->like_count=$like_count;
        return response()->json($rsdy);

    }
    //添加动态信息
  public function  Impl_addWxDynamic(Request $request){
        $title=$request->input('title');
        $openid=$request->input('open_id');
        $user=User::where('open_id',$openid)->first();
        $time=$request->input('time');
        $status=$request->input('status');
        $dynamicid=$request->input('dynamic_id');
        $medias=$request->medias;
        $medias=json_decode($medias);
        $dynamic=Dynamic::find($dynamicid);
        $dynamicLnglat = $this->dealLnglat($dynamic->lnglat);
        $dynamic->address=$dynamicLnglat['formatted_address'];
        $dynamicArea = $this->getArea($dynamicLnglat);
        $dynamic->province_id=$dynamicArea['province_id'] ?: 1;
        $dynamic->city_id=$dynamicArea['city_id'];
        $dynamic->area_id=$dynamicArea['area_id'];
        $dynamic->title=$title;
        if($status=='submit')
        $dynamic->is_save=1;
        else
        $dynamic->is_save=-2;
        $dynamic->user_id=$user->id;
        $this->InsertMedia($medias,$dynamicid);
        if($dynamic->save()){
          return return_json('1');
        } else{
          return return_json('-1');
        }
    }
    //修改动态信息
    public function  Impl_modifyWxDynamic(Request $request){
        $title=$request->input('title');
        $time=$request->input('time');
        $dynamicid=$request->input('dynamic_id');
        $medias=$request->medias;
        $medias=json_decode($medias);
        $dynamic=Dynamic::find($dynamicid);
        $dynamic->title=$title;
        $dynamic->time=$time;
        $dynamic->is_save=1;
        foreach ($dynamic->media()->get() as $item){
            $item->delete();
        }
        $this->InsertMedia($medias,$dynamicid);
        if($dynamic->save()){
            return return_json('1');
        } else{
            return return_json('-1');
        }
    }
    //把动态的媒体信息插入数据库
    private  function  InsertMedia($medias,$dynamicid){
        foreach ($medias as $key => $item){
            if($key!='length'){
                $sort=$key;
                $id=$item[0];
                $body=$item[1];
                $table=$item[2];
                $dy_media=new Dynamic_media();
                if($table=='photo'){
                    $media=Photos::find($id);
                    $dy_media->photo_id=$id;
                }
                if($table=='text'){
                    $media=new Texts;
                    $media->save();
                    $dy_media->text_id=$media->id;
                    $media->body=$body;
                }
                if($table=='audio'){
                    $media=Audios::find($id);
                    $dy_media->audio_id=$id;
                    $media->length=$body;
                }
                $dy_media->dynamic_id=$dynamicid;
                $media->sort=$sort;
                $media->save();
                $dy_media->save();
            }
        }

    }
    private function createIcon($dynamic){
      //制作个性化icon
        $dynamic=Dynamic::find(3579);
        $rs=$dynamic->dynamic_photos()->first();
        $imgs = array();
        $imgs[0] = "$rs->name?imageMogr2/thumbnail/!20x20r";
        $target = 'center.jpg';//背景图片
        $target_img = Imagecreatefromjpeg($target);
        $source= array();
        foreach ($imgs as $k=>$v){
            $source[$k]['source'] = Imagecreatefromjpeg($v);
            $source[$k]['size'] = getimagesize($v);
        }
        $num1=0;
        $num=1;
        $tmp=4;
        $tmpy=7;//图片之间的间距
        for ($i=0; $i<1; $i++){
            imagecopy($target_img,$source[$i]['source'],$tmp,$tmpy,0,0,$source[$i]['size'][0],$source[$i]['size'][1]);
            $tmp = $tmp+$source[$i]['size'][0];
            $tmp = $tmp+5;
            if($i==$num){
                $tmpy = $tmpy+$source[$i]['size'][1];
                $tmpy = $tmpy+5;
                $tmp=2;
                $num=$num+3;
            }
        }
        Imagejpeg($target_img,'pin.jpg');

    }
  public function  Impl_addDynamic(Request $request){
      $destination=$request->input('destination');
      $together=$request->input('together');
      $time=$request->input('time');
      $body=$request->input('body');
      $lnglat=$request->input('lnglat');
      $photos=$request->input('photos');
      $array_photos=explode(",",$photos);
      $dynamic=new Dynamic;
      $dynamic->destination=$destination;
      $dynamic->together=$together;
      $dynamic->body=$body;
      $dynamic->lnglat=$lnglat;
      $dynamicLnglat = $this->dealLnglat($lnglat);
      $dynamic->address=$dynamicLnglat['formatted_address'];
      $dynamicArea = $this->getArea($dynamicLnglat);
      $dynamic->province_id=$dynamicArea['province_id'] ?: 1;
      $dynamic->city_id=$dynamicArea['city_id'];
      $dynamic->area_id=$dynamicArea['area_id'];
      $dynamic->user_id=$request->user()->id;
      if($dynamic->save()){
          foreach($array_photos as $key =>  $item){
              if($item!=""){
                  $dynamic_photo=new Dynamic_photo;
                  $dynamic_photo->photo_id=$item;
                  $dynamic_photo->dynamic_id=$dynamic->id;
                  $dynamic_photo->sort=222;
                  $dynamic_photo->save();
              }
          }
          return redirect('home')->with('success', '上传成功');
      }else{
          return redirect('home')->with('success', '上传成功');
      }
    }

    private function dealLnglat($lnglat){
        $url="http://restapi.amap.com/v3/geocode/regeo?key=fdc3bf6dffffa9cc5adb2072afa95483&location=$lnglat";
        //初始化
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        //打印获得的数据
        $rs=json_decode($output);
        $formatted_address=$rs->regeocode->formatted_address;
        $citycode=$rs->regeocode->addressComponent->citycode;
        $adcode=$rs->regeocode->addressComponent->adcode;
        $dynamicArray=array();
        $dynamicArray['formatted_address']=$formatted_address;
        $dynamicArray['citycode']=$citycode;
        $dynamicArray['adcode']=$adcode;
        return $dynamicArray;
    }
    public function Impl_dellnglat(Request $request){
        $lnglat=$request->lnglat;
        $url="http://restapi.amap.com/v3/geocode/regeo?key=fdc3bf6dffffa9cc5adb2072afa95483&location=$lnglat";
        //初始化
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        //打印获得的数据
        $rs=json_decode($output);
        $formatted_address=$rs->regeocode->formatted_address;
        return $formatted_address;
    }
    private function getArea($dynamicLnglat){
            $area=Area::where('adcode',$dynamicLnglat['adcode'])->first();
            $city=Area::where('citycode',$area->citycode)->where('level','city')->first();
            $areaArray=array();
            $areaArray['area_id']=$area->id;
            $areaArray['city_id']=$city->id;
            $areaArray['province_id']=$city->parent_id;
            return $areaArray;
    }

    public function Impl_uploadWxImg(Request $request){
        $photo=new Photos;
        $mediaid=$request->input('mediaid');
        $dynamicid=$request->dynamicid;
        $app = app('wechat');
        $accessToken = $app->access_token; // EasyWeChat\Core\AccessToken 实例
        $token = $accessToken->getToken();
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=$token&media_id=$mediaid";
        $url = file_get_contents($url);
        $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . str_random(15).'.jpg';
        $disk = QiniuStorage::disk('qiniu');
        $rs=$disk->put($filename,$url);
        $filsrc="http://onzey6ze4.bkt.clouddn.com/".$filename;
        $photo->name=$filsrc;
        $photo->save();
        return response()->json($photo);
    }
    public function Impl_uploadWxVoice(Request $request){
        $audio=new Audios();
        $mediaid=$request->input('mediaid');
        $dynamicid=$request->dynamicid;
        $app = app('wechat');
        $accessToken = $app->access_token; // EasyWeChat\Core\AccessToken 实例
        $token = $accessToken->getToken();
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=$token&media_id=$mediaid";
        $filename_pre='voice'.date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . str_random(15);
        $filename = $filename_pre.'.amr';
        $filename2 =$filename_pre.'.mp3';
        $disk = QiniuStorage::disk('qiniu');
        $rs=$disk->put($filename,$this->httpGet($url));
        $savekey = Qiniu\base64_urlSafeEncode("city-bpyh:".$filename2);
        $fops="avthumb/mp3";
        $fops = $fops.'|saveas/'.$savekey;
        $rs=$disk->persistentFop($filename,$fops);
        $filsrc="http://onzey6ze4.bkt.clouddn.com/".$filename2;
        $audio->body=$filsrc;
        $audio->save();
        return response()->json($audio);
    }
    private function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
        // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }

}

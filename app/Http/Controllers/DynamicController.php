<?php
namespace App\Http\Controllers;
use App\Category;
use App\Dynamic;
use App\Http\Requests;
use App\Photos;
use App\Tags;
use App\Wx_user;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:x-requested-with,content-type');
class DynamicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_dynamic(){
       return view('dynamic.add');
    }
    public function mobile_add_dynamic(Request $request){

        $lnglat=$request->input("lnglat");
        $time=$request->input("time");
        $address=$request->input("address");
        $app = app('wechat');
        $dynamic=new Dynamic;
        $dynamic->lnglat=$lnglat;
        $dynamic->time=$time;
        $dynamic->address=$address;
        $dynamic->save();
        $js=$app->js;
        return view('mobile.dynamic.add')->with(['js'=>$js,'dynamic'=>$dynamic]);
    }
    public function mobile_location(Request $request){
        return view('mobile.dynamic.location');
    }

    /*用户动态列表*/
    public function mobile_list_dynamic(Request $request){
        $oauth_user=Session::get('wechat.oauth_user');
        $user=User::where("open_id",$oauth_user['id'])->first();
        $dy=User::find($user->id)->dynamic()->where('is_save',1)->select('id','is_share','title','address','time')->get();
        foreach($dy as $item){
            $photo=$item->dynamic_photos()->first();
            if(!empty($photo)){
                $item->photo=$photo;
            }else{
                $photo=Photos::find(21);
                $item->photo=$photo;
            }
            $item->day=explode('-',$item->time)[2];
            $item->month=explode('-',$item->time)[1];
        }

        return view('mobile.dynamic.list')->with('dy',$dy);
    }
    public function mobile_draftlist_dynamic(Request $request){
        $oauth_user=Session::get('wechat.oauth_user');
        $user=User::where("open_id",$oauth_user['id'])->first();
        $dy=User::find($user->id)->dynamic()->where('is_save',-2)->select('id','is_share','title','address','time')->get();
        foreach($dy as $item){
            $photo=$item->dynamic_photos()->first();
            if(!empty($photo)){
                $item->photo=$photo;
            }else{
                $photo=Photos::find(21);
                $item->photo=$photo;
            }
            $item->day=explode('-',$item->time)[2];
            $item->month=explode('-',$item->time)[1];
        }

        return view('mobile.dynamic.draftlist')->with('dy',$dy);
    }


    //    设置动态是否公开
    public function mobile_set_private(Request $request)
    {
        $id = $request->id;
        $is_share = $request->is_share;
        if(Dynamic::where('id',$id)->update(['is_share' => $is_share])){
            return json_encode(['status' => 1]);
        }else{
            return json_encode(['status' => 0]);
        }
    }
//    删除动态
    public function mobile_delete_dynamic(Request $request){
        $id = $request->id;
        if(Dynamic::where('id',$id)->delete()){
            return json_encode(['status' => 1]);
        }else{
            return json_encode(['status' => 0]);
        }
    }

    public function  home(Request $request){
        return view('home.home');
    }
    public function mobile_modify_dynamic(Request $request){
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
        $dynamic->user=$dynamic->user()->first()->name;
        $dynamic->medias=array_sort_recursive($dyarray);
        $app = app('wechat');

        $js=$app->js;
        return view('mobile.dynamic.modify')->with(['dynamic'=>$dynamic,'js'=>$js]);
    }

}

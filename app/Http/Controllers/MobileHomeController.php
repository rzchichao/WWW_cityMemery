<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use SmsManager;
use Validator;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redis;
class MobileHomeController extends Controller
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
    public function index()
    {
        $oauth_user=Session::get('wechat.oauth_user');
        $user=User::where("open_id",$oauth_user['id'])->first();
        return view('mobile.home.index')->with(['user'=>$user]);
    }
    public function  home(Request $request){
        $app = app('wechat');
        $js=$app->js;
        $oauth_user=Session::get('wechat.oauth_user');
        $user=User::where("open_id",$oauth_user['id'])->first();
        return view('mobile.home.home')->with(['user'=>$user,'js'=>$js]);
    }
    public function mobile_setting(){
        return view('mobile.home.setting');
    }
    public function mobile_sms(){
        return view('mobile.home.sms');
    }
    public function mobile_validate_code(Request $request){
        //验证数据
        $validator = Validator::make($request->all(), [
            'mobile'     => 'required|confirm_mobile_not_change|confirm_rule:mobile_required',
            'verifyCode' => 'required|verify_code',
            //more...
        ]);
        if ($validator->fails()) {
            //验证失败后建议清空存储的发送状态，防止用户重复试错
            SmsManager::forgetState();
            return redirect()->back()->withErrors($validator);
        }else{
            echo "aaa";
        }
    }
}

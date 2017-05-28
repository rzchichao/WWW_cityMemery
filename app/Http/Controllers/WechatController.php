<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\News;
use App\User;
use App\Wx_user;
use EasyWeChat\Staff\Session;
use Log;


class WechatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function serve()
    {
        $app = app('wechat');
        $server=$app->server;
        $server->setMessageHandler(function ($message) {
            switch ($message->MsgType) {
                case 'event':
                    switch ($message->Event) {
                        case 'subscribe':
                            //get post data, May be due to the different environments
                            $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

                            //extract post data
                            if (!empty($postStr)){
                                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                                   the best way is to check the validity of xml by yourself */
                                libxml_disable_entity_loader(true);
                                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                                $fromUsername = $postObj->FromUserName;
                                $toUsername = $postObj->ToUserName;
                                $ticket = $postObj->Ticket;
                                $keyword = "aa";
                                $time = time();
                                $textTpl = "<xml><ToUserName><![CDATA[%s]]></ToUserName>
                                            <FromUserName><![CDATA[%s]]></FromUserName>
                                            <CreateTime>%s</CreateTime>
                                            <MsgType><![CDATA[%s]]></MsgType>
                                            <Event><![CDATA[subscribe]]></Event>
                                            <EventKey><![CDATA[qrscene_123]]></EventKey>
                                            <Ticket><![CDATA[%s]]></Ticket>
                                            </xml>";
                                if(!empty( $keyword ))
                                {
                                    $msgType = "event";
                                    $contentStr = "Welcome to wechat world!";
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType,$ticket,$contentStr);
                                    $arr = $this->xmlToArray($resultStr);
                                    $open_id = $arr['ToUserName'];
                                    return $arr['ToUserName'];
                                }else{
                                    return "Input something...";
                                }

                            }else {
                                return "";
                            }
                            break;
                        case 'SCAN':
                            //get post data, May be due to the different environments
                            $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

                            //extract post data
                            if (!empty($postStr)){
                                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                                   the best way is to check the validity of xml by yourself */
                                libxml_disable_entity_loader(true);
                                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                                $fromUsername = $postObj->FromUserName;
                                $toUsername = $postObj->ToUserName;
                                $ticket = $postObj->Ticket;
                                $keyword = "aa";
                                $time = time();
                                $textTpl = "<xml><ToUserName><![CDATA[%s]]></ToUserName>
                                            <FromUserName><![CDATA[%s]]></FromUserName>
                                            <CreateTime>%s</CreateTime>
                                            <MsgType><![CDATA[%s]]></MsgType>
                                            <Event><![CDATA[SCAN]]></Event>
                                            <EventKey><![CDATA[qrscene_123]]></EventKey>
                                            <Ticket><![CDATA[%s]]></Ticket>
                                            </xml>";
                                if(!empty( $keyword ))
                                {
                                    $msgType = "event";
                                    $contentStr = "Welcome to wechat world!";
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType,$ticket,$contentStr);
                                    $arr = $this->xmlToArray($resultStr);
                                    $open_id = $arr['ToUserName'];
                                    $app = app('wechat');
                                    $userService = $app->user;
                                    $user = $userService->get($open_id);
                                    $this->check_user($open_id);
                                    return $user->nickname;
                                }else{
                                    return "Input something...";
                                }

                            }else {
                                return "";
                            }

                            break;
                        default:
                            # code...
                            break;
                    }
                    break;
                case 'text':
                    return '收到文字消息';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }

            // ...
        });
        $server->serve()->send();
    }

    function xmlToArray($xml){

        //禁止引用外部xml实体

        libxml_disable_entity_loader(true);

        $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);

        $val = json_decode(json_encode($xmlstring),true);

        return $val;

    }

    public  function  wx_login(){
        $app = app('wechat');
        $oauth = $app->oauth;
        // 未登录
        if (!session()->has('wechat_user')) {
            session(['target_url'=>'index']);
            return $oauth->redirect();
        }
    // 已经登录过
    }
    public function oauth_callback(){
        $app = app('wechat');
        $oauth = $app->oauth;
        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        session(['wechat_user' => $user->toArray()]);
        $targetUrl = session()->has('target_url') ? session('target_url') : '/' ;
        $this->check_user($user);
        return redirect()->action('MobileHomeController@index');

    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    private function  check_user($open_id){
        $wx_user=Wx_user::where('open_id',$open_id)->first();
        if(empty($wx_user)){
            $wx_user=new Wx_user;
            $wx_user->open_id=$user->original['openid'];
            $wx_user->name=$user->name;
            $wx_user->nickname=$user->original['nickname'];
            $wx_user->avatar=$user->original['headimgurl'];
            $wx_user->city=$user->original['city'];
            $wx_user->province=$user->original['province'];
            $wx_user->country=$user->original['country'];
            $wx_user->sex=$user->original['sex'];
            $wx_user->save();
        }
        return $wx_user;
    }
}

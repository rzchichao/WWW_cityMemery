<?php
/**
 * Created by PhpStorm.
 * User: sunzexin
 * Date: 2017/5/14
 * Time: 下午12:09
 */

namespace App\Http\Controllers;
use App\Comment;
use Illuminate\Support\Facades\Session;
use App\Dynamic;
use App\Follow;
use Illuminate\Http\Request;
// 指定允许其他域名访问
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:GET');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
class Api4Controller extends Controller
{
    public function Impl_getDynamicDetail(Request $request){
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
        $dynamic->uid = $dynamic->user()->first()->id;
//        判断关注关系
        if(!empty(Session::get('user'))){
            $result = Follow::where('uid_following','=',Session::get('user')['id'])->where('uid_followed','=',$dynamic->uid)->first();
            if($result){
                $dynamic->is_follow = 1;
            }else{
                $dynamic->is_follow = 0;
            }
        }
        $dynamic->avatar = $dynamic->user()->first()->avatar;
        $dynamic->user=$dynamic->user()->first()->nickname;
        $dynamic->medias=array_sort_recursive($dyarray);
        return view('home.dynamic.detail')->with('dynamic',$dynamic);
    }

    //关注
    public function Impl_follow(Request $request){
//        被关注的人的ID
        $uid_followed = $request->uid;
//        登陆者自己的ID
        if(empty(Session::get('user')['id'])){
            $uid_following=$request->uid_following;
        }else{
            $uid_following = Session::get('user')['id'];
        }
        $follow = new Follow();
        $follow->uid_following = $uid_following;
        $follow->uid_followed = $uid_followed;
        $follow->save();
        $id = $follow->id;
        if($id){
            $result = ['status' => 1, 'error' => ''];
            return json_encode($result);
        }else{
            $result = ['status' => 0, 'error' => '关注失败'];
            return json_encode($result);
        }
    }

    //    取消关注
    public function Impl_cancelFollow(Request $request){
//        被关注的人的ID
        $uid_followed = $request->uid;
//        登陆者自己的ID
        $uid_following = Session::get('user')['id'];
        if(Follow::where('uid_followed','=',$uid_followed)->where('uid_following','=',$uid_following)->delete()){
            $result = ['status' => 1, 'error' => ''];
            return json_encode($result);
        }else{
            $result = ['status' => 0, 'error' => '取消关注失败'];
            return json_encode($result);
        }
    }
//    发表评论
    public function Impl_postComment(Request $request){
        $dynamic_id = $request->dynamic_id;
        $author_id =$request->author_id;
        $reviewer_id = Session::get('user')['id'];

        $content = $request->comment_content;
        $comment = new Comment();
        if(!empty($request->parent_id)){
            $comment->parent_id = $request->parent_id;
        }else{
            $comment->parent_id = 0;
        }
        $comment->dynamic_id = $dynamic_id;
        $comment->author_id = $author_id;
        $comment->reviewer_id = $reviewer_id;
        $comment->content = $content;
        $comment->save();
        $comment_id = $comment->id;
        if($comment_id){
            $result = ['status' => 1, 'error' => ''];
            return json_encode($result);
        }else{
            $result = ['status' => 0, 'error' => '发表评论失败！'];
            return json_encode($result);
        }
    }
//    获取评论
    public function Impl_getComments(Request $request){
        $dynamic_id = $request->dynamic_id;
        $comments = Comment::with('user')->where('dynamic_id','=',$dynamic_id)->where('parent_id','=',0)->get();
        if($comments){
            return json_encode($comments);
        }else{
            $result = ['status' => 0, 'error' => '获取评论失败！'];
            return json_encode($result);
        }
    }
}
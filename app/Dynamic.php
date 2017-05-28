<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Dynamic extends Model
{
    use SoftDeletes;
    //指定表名
    protected $table='dynamic';
    //该字段若非空，则被软删除
    protected $dates = ['deleted_at'];
    //指定id
    public function photos()
    {
        return $this->hasMany('App\Dynamic_photo','dynamic_id');
    }
    public function manyphoto(){
        return $this->belongsToMany('App\Photos','dynamic_photo','dynamic_id','photo_id');
    }
    public function tags(){
        return $this->hasMany('App\Tags','dynamic_id');
    }
    public function media(){
        return $this->hasMany('App\Dynamic_media','dynamic_id');
    }
    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
    public function category(){
        return $this->hasMany('App\Dynamic_category','dynamic_id');
    }
    public function dynamic_category(){
        return $this->belongsToMany('App\Category','dynamic_category','dynamic_id','category_id');
    }
    public function dynamic_photos(){
        return $this->belongsToMany('App\Photos','dynamic_media','dynamic_id','photo_id');
    }
    public function dynamic_texts(){
        return $this->belongsToMany('App\Texts','dynamic_media','dynamic_id','text_id');
    }
    public function dynamic_audios(){
        return $this->belongsToMany('App\Audios','dynamic_media','dynamic_id','audio_id');
    }
    public function dynamic_like(){
        return $this->hasMany('App\Dynamic_like','dynamic_id');
    }
}

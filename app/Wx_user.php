<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Wx_user extends Model
{
    //指定表名
    protected $table='wx_user';
    //指定id
    public function dynamic(){
        return $this->hasMany('App\Dynamic','user_id');
    }
    public function dynamicMedia(){
        return $this->hasManyThrough('App\Dynamic_media', 'App\Dynamic','user_id','dynamic_id');
    }
    public function dynamic_like(){
        return $this->hasMany('App\Dynamic_like','user_id');
    }
}


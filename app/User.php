<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile','lnglat','password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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

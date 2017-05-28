<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model{

    protected $table = 'provinces';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function dynamic(){
        return $this->hasMany('App\Dynamic','province_id','id');
    }

    public function citys(){
        return $this->hasMany('App\Citys','parent_id');
    }
}
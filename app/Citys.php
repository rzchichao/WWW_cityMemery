<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Citys extends Model{

    protected $table = 'citys';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function dynamic(){
        return $this->hasMany('App\Dynamic','city_id','id');
    }
}
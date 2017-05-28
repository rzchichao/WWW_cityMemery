<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model{

    protected $table = 'area';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function dynamic(){
        return $this->hasMany('App\Dynamic','province_id');
    }
}
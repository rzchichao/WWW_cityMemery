<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model{

    protected $table = 'areas';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
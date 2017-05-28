<?php

namespace App\Http\Controllers;
use App\Citys;
use App\Dynamic;
use App\Http\Controllers\Controller;
use App\Provinces;
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:GET');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
class Api3Controller extends Controller{
    public function test(){
        return "a";
    }

}
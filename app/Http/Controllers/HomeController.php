<?php

namespace App\Http\Controllers;

use App\Dynamic;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        foreach($users as $item){
            $lnglat=$item->lnglat;
            $arraylnglat= explode(',',$lnglat);
            $item->lng=$arraylnglat[0];
            $item->lat=$arraylnglat[1];
        }
        return view('home.index')->with('users',$users);
    }
    public function  home(Request $request){
        $this->middleware('auth');
        $user_id=$request->user()->id;
        return view('home.home')->with('user_id',$user_id);
    }
}

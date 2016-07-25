<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\Notif;

use Auth;

class NotifController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // public function notifDetail($type=null)
    // {
    //     if($type=='followRequest')
    //     {
    //         $followRequest = Auth::user()->followRequest;
    //         return view('notif.notif')->with(array('followRequest'=>$followRequest,'type'=>$type));
    //     }
        
    // }

    public function read()
    {
        $user_id = Auth::user()->id;
        $notif = Notif::where('user_id',$user_id)->update(array('flag'=>'seen'));
        echo 'done';
    }
}

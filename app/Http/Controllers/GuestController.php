<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Redirect;
use Auth;
use App\Models\Post;


//BUAT GUEST TOUR AJA
class GuestController extends Controller
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
    public function index()
    {
      if(Auth::check()) //jika user loggin lagnsung ke home dashboard
        {
            return Redirect::to('/home');
        }
        else
        {
            //urutkan beradasarkan update_at
             // $allPost = Post::with('user','postDetails','postTags')->orderBy('updated_at', 'desc')->get();

            //urutkan berdasarkan jumlah subscriber
             $allPost = Post::with('user','postDetails','postTags','subscriber')->get()->sortByDesc('subscriber');
             
             return view('welcome')->with(array('allPost'=>$allPost));
        }
    }

     public function register()
    {
        return Redirect::to('/login');
    }

    public function forget()
    {
        return Redirect::to('/login');
    }


 
}

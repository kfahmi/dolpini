<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use View;
use Auth;

use App\Models\PostFlag;
use App\Models\ReplyFlag;


class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

     public function __construct($guard = null) {
     	if(!Auth::guard($guard)->guest())
     	{
     		 if(Auth::user()->level == 'admin')
	       {
	       	 $reportedTopik = PostFlag::where('flag_type','report')->groupBy('post_id')->get();
	       	 $reportedReply = ReplyFlag::where('flag_type','report')->groupBy('reply_kubu_id')->get();

	      	 View::share ( 'reportedTopik', $reportedTopik );
	      	 View::share ( 'reportedReply', $reportedReply );
	       }
	       elseif(Auth::user()->level == 'user')
	       {
	       	 $unseenNotif = Auth::user()->hasNewNotif;
	       	 $allNotif = Auth::user()->hasNotif;
	       	 $followRequest = Auth::user()->followRequest;

	      	 View::share ( 'unseenNotif', $unseenNotif );
	      	 View::share ( 'allNotif', $allNotif );
	      	 View::share ( 'followRequest', $followRequest );
	       }
     	}

    }  
}

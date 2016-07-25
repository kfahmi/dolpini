<?php
namespace App\Services;

use App\Models\Follow;
use App\Models\ReplyKubu;
use App\Models\PostKubu;
use App\Models\User;

use Auth;
use DB;

class Counter
{

	//replies counter
    public static function userInKubuCounter($post_kubu_id)
    {
    	$reply = ReplyKubu::where('post_kubu_id','=',$post_kubu_id)->distinct('user_id')->count('user_id');

		echo $reply;
    }

    //replies counter
    public static function counterViewer($user_id)
    {
    	$user = User::findOrFail($user_id);

    	$user->viewer = $user->viewer + 1;

    	$user->save();
    }


    public static function kubuPercentage($post_kubu_id,$post_id)
    {
        $userInKubu = ReplyKubu::where('post_kubu_id','=',$post_kubu_id)->distinct('user_id')->count('user_id');

        $totalUserInPost = DB::table('reply_kubu')
                                ->join('post_kubu', function ($join) use ($post_id){
                                    $join->on('post_kubu.id', '=', 'reply_kubu.post_kubu_id')
                                         ->where('post_id', '=', $post_id);
                                })->distinct('reply_kubu.user_id')->count('reply_kubu.user_id');

        if($userInKubu != 0 && $totalUserInPost != 0)
        {
            $percentage  = ( $userInKubu / $totalUserInPost ) * 100;
        }     
        else
        {
            $percentage = 0;
        }                 

        echo number_format((float)$percentage, 2, '.','');
    }
  

}

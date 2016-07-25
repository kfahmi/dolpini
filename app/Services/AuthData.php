<?php
namespace App\Services;
use App\Models\Post;
use Auth;

class AuthData
{


	public static function ownerPost($post_id,$user_id)
	{
		$cek = Post::where('id',$post_id)->where('user_id',$user_id)->withTrashed()->get();

		//kalo user ini ownernya berarti true
		if($cek->count() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}


}

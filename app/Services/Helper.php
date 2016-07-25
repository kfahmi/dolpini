<?php
namespace App\Services;

use App\Models\Follow;
use App\Models\ReplyKubu;
use App\Models\PostKubu;
use App\Models\Post;
use App\Models\PostSubscribe;
use App\Models\User;
use App\Models\PostFlag;
use App\Models\ReplyFlag;


use Auth;
use Carbon\Carbon;

class Helper
{
	//user status
	public static function userStatus($id,$type = null)
	{
		$user = User::withTrashed()->findOrFail($id);


		if($type=='html')
		{
			if(isset($user->deleted_at))
			{
				echo '<span class="badge badge-important">Inactive</span>';
			}
			else if($user->confirmation_code != null)
			{
				echo '<span class="badge badge-important">Unverified</span>';
			}
			else
			{
				echo '<span class="badge badge-info">Active</span>';
			}
		}
		else if($type=='value')
		{
			if(isset($user->deleted_at))
			{
				return 'inactive';
			}
			else if($user->confirmation_code != null)
			{
				return 'unverified';
			}
			else
			{
				return 'active';
			}
		}
		
	}

	//model apa, type itu outputnya mau apa
	public static function kontenStatus($id,$model = null,$type = null)
	{	
		if($model == 'post')
		{
			$post = Post::withTrashed()->findOrFail($id);
			$deleted = $post->deleted_at;
			$report = PostFlag::where('post_id',$id)->where('flag_type','report')->count();
		}
		else if($model = 'replyKubu')
		{
			$ReplyKubu = ReplyKubu::withTrashed()->findOrFail($id);
			$deleted = $ReplyKubu->deleted_at;
			$report = ReplyFlag::where('reply_kubu_id',$id)->where('flag_type','report')->count();
		}

		if($type == 'html')
		{
			if(isset($deleted))
			{
				echo  "<i class='badge badge-important'> Dihapus / Tidak Aktif</i>";
			}
			else if($report > 0 )
			{
				echo  "<i class='badge badge-warning'> Dilaporkan</i>";
			}
			else
			{
				echo "<i class='badge badge-info'> Aman</i>";
			}
		}
		else
		if($type == 'value')
		{
			if(isset($deleted))
			{
				return 'deleted';
			}
			else if($report > 0 )
			{
				return 'reported';
			}
			else
			{
				return 'safe';
			}
		}
	}


	public static function lessChar($string,$limit)
	{
		// strip tags to avoid breaking any html
		$string = strip_tags($string);

		if (strlen($string) > $limit) {

		    // truncate string
		    $stringCut = substr($string, 0, $limit);

		    // make sure it ends in a word so assassinate doesn't become ass...
		    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
		}
		echo $string;
	}


	public static function homepage($level)
	{
		if($level == 'user')
		{
			return '/home';
		}
		else if($level == 'admin')
		{
			return '/homeAdmin';
		}
	}


	public static function minMaxData($var)
	{
		//syarat menjadi topTopic adalah minimal x user yang subscribe
		if($var == 'minTopTopic')
		{
			return 10;
		}
	}

	//limit berapa data yang ditampilkan
	public static function limitData($var)
	{
		//data yang dishow trending tags
		if($var == 'limitTrendingTag')
		{
			return 5;//
		}
		//data yang di show most commented topic
		else if($var == 'limitMostCommentedTopic')
		{
			return 10;//10 topik diambil
		}
		//limit new notif show
		else if($var == 'limitNewNotif')
		{
			return 2;
		}
	}

	//check apakah user login ini udah subscribe topik atau belom
	public static function alreadySubscribe($post_id = null, $user_id = null)
	{
		$check = PostSubscribe::where('post_id',$post_id)->where('user_id',$user_id)->get();
		
		if($check->count() > 0)
		{
			return true;
		}
		else if($check->count() == 0)
		{
			return false;
		}
	}

	//get replies kubu
	public static function getReplies($post_kubu_id)
	{
		$replies = ReplyKubu::where('post_kubu_id',$post_kubu_id)->orderBy('created_at','DESC')->get();
		return $replies;
	}

	public static function postDateFormat($date=null,$tipe = null)
	{
		if($tipe == null)
		{
			$date = Carbon::parse($date)->format('M d, Y - H:i:s');
		}
		else if($tipe == 'month')
		{
			$monthNum  = $date;
			$dateObj   = Carbon::createFromFormat('!m', $monthNum);
			$date = $dateObj->format('F'); 
		}
		else if($tipe == 'monthyear')
		{
			$date = Carbon::parse($date)->format('M, Y');
		}
		return $date;
	}

	public static function userInitial($id)
	{
		$user = User::withTrashed()->findOrFail($id);

		  $realname = $user->real_name;
          $realname_explode = explode(" ",$realname);

          // kalo satu kosa kata
          if(count($realname_explode) == 1)
          {
            $userInitial = strtoupper($realname_explode[0][0]);
          }
          else //lebih dari satu kosa kata
          {
            $userInitial = strtoupper($realname_explode[0][0]." ".$realname_explode[1][0]);
          }

          return $userInitial;
	}

	public static function checkFollow($user_id=null,$follow_id=null)
	{
		$follow = Follow::where('user_id','=',$user_id)->where('follow_user_id','=',$follow_id)->first();

       if(count($follow) > 0)
	      {
	        if($follow->accepted_at == NULL)
	        {
	        	$relationStatus = 'waiting';
	        }
	        else
	        {
	        	$relationStatus = 'approved';
	        }
	      }
	      else
	      {
	        $relationStatus = 'none';
	      }

		return $relationStatus;
	}


	//apakah user ini kubu ini atau tidak
	public static function checkKubu($user_id=null,$kubu_id=null)
	{
		$reply = ReplyKubu::where('user_id','=',$user_id)->where('post_kubu_id','=',$kubu_id)->first();

		if(count($reply) > 0)//jika kubu ini
		{
			return true;
		}
		else if(count($reply) < 1) //jika bukan kubu ini
		{
			return false;
		}
	}

	//check apakah user ini udah pernah reply di post ini?
	public static function checkReplyPost($user_id=null,$post_id=null)
	{
		$data = PostKubu::whereHas("replies", function($q) use ($user_id,$post_id){//yang gak punya harga aktif
										  $q->where('user_id', '=',$user_id);
										  $q->where('post_id','=',$post_id); 
										})->first();


		if(count($data) > 0)//jika dah pernah reply di kubu ini
		{
			return true;
		}
		else if(count($data) < 1)//jika blm pernah reply
		{
			return false;
		}
	}



	//showNickname
	public static function showName($user_id)
	{
		$user = User::withTrashed()->findOrFail($user_id);

		$show_as = $user->show_as;

		if($user_id == Auth::user()->id)
		{
			echo "Me";
		}
		else if($show_as == 'real')
		{
			echo $user->real_name;
		}
		else if($show_as == 'nick')
		{
			echo $user->nick_name;
		}
		else if($show_as == 'anonim')
		{
			echo "Anonim";
		}

	}
	

}

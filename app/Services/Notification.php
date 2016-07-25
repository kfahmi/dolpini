<?php
namespace App\Services;
use App\Models\Post;
use App\Models\PostFlag;
use App\Models\Notif;
use App\Models\User;

use Auth;
use Mail;

class Notification
{

	//MAIL NOTIF HANYA UNTUK USER REGIS?VERIVY?DANBANNED
	//type = registration - atau apa saja.
	public static function email($user_id, $type = null)
	{
		if($type == "userVerification")
		{
			$user = User::withTrashed()->findOrFail($user_id);

			$admins = User::where('level','=','admin')->get();//ADMIN
			
			$adminEmails = array();
			foreach($admins as $admin)
			{
				$adminEmails [] = $admin->email;
			}
			
			Mail::send('emails.userVerification_ToUser', array('data'=>$user), function($message) use($user)
			{
			    	$message->to($user->email)->subject('Verify your dolpini account, now!');
			});

			if(count($adminEmails) > 0)
			{
				Mail::send('emails.userVerification_ToAdmin', array('data'=>$user), function($message) use($adminEmails)
				{
				    	$message->to($adminEmails)->subject('New User has Been Registered!');
				});
			}
			
		}
		else if($type == "userVerified")
		{
			$user = User::withTrashed()->findOrFail($user_id);

			Mail::send('emails.userVerified_ToUser', array('data'=>$user), function($message) use($user)
			{
			    	$message->to($user->email)->subject('Congratulation, your account has been verified!');
			});
			
		}
		else if($type == "userDeactivate")
		{
			$user = User::withTrashed()->findOrFail($user_id);

			Mail::send('emails.userDeactivate_ToUser', array('data'=>$user), function($message) use($user)
			{
			    	$message->to($user->email)->subject('Sorry, your account has been Deactivate!');
			});
		}
		
	}


	//create notif
	public static function createNotif($activity_id = null, $activity_id_type = null, $parent_id = null, $parent_id_type = null, $additionalInfo = null)
	{
		//notif saat ada yang reply di kubu/topik
		if($activity_id_type == 'ReplyKubu')
		{
			$post = Post::with('subscriber')->findOrFail($parent_id);

			//save notif berdasarkan subscribernya
			if($post->subscriber->count() > 0)
			{
				foreach($post->subscriber as $sub)
				{
					//yang login kan yang nge nge reply jd gausah dapet notif
					if($sub->user_id != Auth::user()->id)
					{
						$notif = new Notif;
						$notif->user_id = $sub->user_id;

						//replyKubu
						$notif->activity_id = $activity_id;
						$notif->activity_id_type = $activity_id_type;
						//post
						$notif->parent_id = $parent_id;
						$notif->parent_id_type = $parent_id_type;
						$notif->flag = 'unseen';
						$notif->save();

						Mail::send('emails.topikNewComment_toSubscriber', array('data'=>$notif), function($message) use($notif)
	                    {
	                          $message->to($notif->user->email)->subject('New Comment / Reply in ['.$notif->parentPost->type.'] '.$notif->parentPost->title.' !');
	                    });

					}//end validasi tidak usah kasih notif ke yang ngereply
					
				}//end loopingsubscriber
			}

		}//end replykubu

		//notif saat ada yang post topik baru.
		else if($activity_id_type == 'Post')
		{
			//jika create post/topic baru.... maka cari follower dia.
			if(Auth::user()->followers->count() > 0)
			{
				foreach(Auth::user()->followers as $f)
				{
					//kasih notif ke followers nya kalo dia baru submit data baru
					$notif = new Notif;
					$notif->user_id = $f->user_id;
					//post
					$notif->activity_id = $activity_id;
					$notif->activity_id_type = $activity_id_type;
					//NULL
					$notif->parent_id = $parent_id;
					$notif->parent_id_type = $parent_id_type;

					$notif->flag = 'unseen';
					$notif->save();

					Mail::send('emails.newTopik_toFollower', array('data'=>$notif), function($message) use($notif)
	                {
	                      $message->to($notif->user->email)->subject('New Topic ['.$notif->activityPost->type.'] '.$notif->activityPost->title.' (created by '.$notif->activityPost->user->nick_name.') !');
	                });
				}//end looping folower
			}

		}//end post
	}

}

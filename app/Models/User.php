<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Helper;
class User extends Authenticatable
{
    use SoftDeletes;

    protected $table = "users";
    protected $topTopicMin = 10;//10user yang subscribe topik
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email','password','level','nick_name','real_name','auto_accept_follower',
        'show_as','email_notif','premium_until','mobile_phone','gender','birth_date','confirmation_code'
    ];

    public static function rules($id = null,$type = null)
    {
        if($type == null)//create new
        {
             return [
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'level'=>'required',
            'nick_name'=>'required|unique:users',
            'show_as'=>'required',
            'gender'=>'required',
            'birth_date'=>'required',
            'mobile_phone'=>'required|digits_between:1,14',
            ];
        }
        else if($type =='data')
        {
            return [
            'email'=>'required|email|unique:users,email,'.$id,
            'mobile_phone'=>'required|digits_between:1,14',
            ];
        }
        else if($type == 'changePassword')
        {
            return [
            'password'=>'required',
            ];
        }


        
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getNickNameAttribute($value)
    {
        return ucfirst($value);
    }

     public function getRealNameAttribute($value)
    {
        return ucfirst($value);
    }

     public function setPasswordAttribute($value)
    {
         $this->attributes['password'] = bcrypt($value);
    }

    public function setConfirmationCodeAttribute($value)
    {
        if($value != null)
        {
            $t=time();
            $now = (date("Y-m-d H:i:s",$t));
            $join = $value + $now;
            $code = bcrypt($join);
            $this->attributes['confirmation_code'] = preg_replace('/[^A-Za-z0-9\-]/', '', $code);
        }
        else
        {
            $this->attributes['confirmation_code'] = null;
        }
       
    }



    //follow siapa aja
    public function followings()
    {
      return $this->hasMany('App\Models\Follow','user_id','id')->whereNotNull('accepted_at');
    }

    //followers nya/ alias siapa aja yg follow dia
    public function followers()
    {
      return $this->hasMany('App\Models\Follow','follow_user_id','id')->whereNotNull('accepted_at');
    }

    //request follow yang blm di accept
    public function followRequest()
    {
      return $this->hasMany('App\Models\Follow','follow_user_id','id')->whereNull('accepted_at');
    }

    //semua topic milik user
    public function hasTopics()
    {
      return $this->hasMany('App\Models\Post','user_id','id');
    }

    //top topics itu most subscriber min > x user
    public function hasTopTopics()
    {
      return $this->hasMany('App\Models\Post','user_id','id')->whereHas("subscriber", function($q){
                       },'>',Helper::minMaxdata('minTopTopic'));
    }
 
    //new notif, notif yang unseen
    public function hasNewNotif()
    {
            return $this->hasMany('App\Models\Notif','user_id','id')->where('flag','unseen')->orderBy('id','DESC');
    }

     public function hasNotif()
    {
            return $this->hasMany('App\Models\Notif','user_id','id')->orderBy('id','DESC');
    }

  

}

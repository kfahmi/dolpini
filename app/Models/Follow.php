<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follow extends Model
{
   use SoftDeletes;

    protected $table = "follow";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','follow_user_id','accepted_at',
    ];


    public static function rules($id = null)
    {
        if($id == null)//create new
        {
             return [
            'user_id'=>'required',
            'follow_user_id'=>'required',
            ];
        }
        else//update
        {
            return [
          	'user_id'=>'required',
            'follow_user_id'=>'required',
            ];
        }
        
    }

    //yang request
    public function user()
    {
      return $this->belongsTo('App\Models\User','user_id','id')->withTrashed();
    }

    //yang difollow
    public function followUser()
    {
      return $this->belongsTo('App\Models\User','follow_user_id','id')->withTrashed();
    }

    



  
}

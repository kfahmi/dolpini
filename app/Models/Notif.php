<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    protected $table = "notif";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activity_id','activity_id_type','parent_id','parent_id_type','user_id'
     ];

    public static function rules($id = null)
    {
        if($id == null)//create new
        {
             return [
             'user_id'=>'required',
            'activity_id'=>'required',
            'activity_id_type'=>'required',
            'parent_id'=>'required',
            'parent_id_type'=>'required',
            ];
        }
        else//update
        {
            return [
            'user_id'=>'required',
            'activity_id'=>'required',
            'activity_id_type'=>'required',
            'parent_id'=>'required',
            'parent_id_type'=>'required',
            ];
        }
        
    }


    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id')->withTrashed();
    }


    public function activityReply()
    {
        return $this->belongsTo('App\Models\ReplyKubu','activity_id','id')->withTrashed();
    }

    public function activityPost()
    {
        return $this->belongsTo('App\Models\Post','activity_id','id')->withTrashed();
    }

    public function activityPostFlag()
    {
        return $this->belongsTo('App\Models\PostFlag','activity_id','id');
    }

    public function activityReplyFlag()
    {
        return $this->belongsTo('App\Models\ReplyFlag','activity_id','id');
    }


    public function parentPost()
    {
         return $this->belongsTo('App\Models\Post','parent_id','id')->withTrashed();
    }

    public function parentReplyKubu()
    {
        return $this->belongsTo('App\Models\ReplyKubu','parent_id','id')->withTrashed();
    }



}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
class ReplyFlag extends Model
{
   use SoftDeletes;

    protected $table = "reply_flag";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','reply_kubu_id','flag_type'
     ];

    public static function rules($id = null)
    {
        if($id == null)//create new
        {
             return [
            'user_id'=>'required',
            'reply_kubu_id'=>'required',
            'flag_type'=>'required',
            ];
        }
        else//update
        {
             return [
             'user_id'=>'required',
            'reply_kubu_id'=>'required',
            'flag_type'=>'required',
            ];
        }
        
    }

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::deleting(function($model)
    //     {
    //             // softdelete Relationnya
    //             try
    //             {
    //                 DB::beginTransaction();
                    
    //                 //notif nya juga didelete
    //                 if(count($model->notif)>0)
    //                 {
    //                     $model->notif()->delete();
    //                 }

    //                 DB::commit();  
    //             }
    //             catch(Exception $e)
    //             {
    //                 DB::rollback();
    //                 throw new Exception("Error Processing Request", 1);
    //             }

    //     });
    // }


    public function notif()
    {
      return $this->hasMany('App\Models\Notif','activity_id','id')->where('activity_id_type','ReplyFlag');
    }

    public function reply()
    {
        return $this->belongsTo('App\Models\ReplyKubu','reply_kubu_id','id');
    }

     public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id')->withTrashed();
    }
  
}

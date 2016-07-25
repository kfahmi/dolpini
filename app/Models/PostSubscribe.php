<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostSubscribe extends Model
{
    protected $table = "post_subscribe";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id','user_id'
     ];

    public static function rules($id = null)
    {
        if($id == null)//create new
        {
             return [
             'user_id'=>'required',
            'post_id'=>'required',
            ];
        }
        else//update
        {
            return [
            'user_id'=>'required',
            'post_id'=>'required',
            ];
        }
        
    }


    public function post()
    {
        return $this->belongsTo('App\Models\Post','post_id','id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id')->withTrashed();
    }



}

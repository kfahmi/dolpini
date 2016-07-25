<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;
use URL;

class PostDetail extends Model
{
   use SoftDeletes;

    protected $table = "post_detail";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content','type','post_id','extension'
     ];

    public static function rules($id = null)
    {
        if($id == null)//create new
        {
             return [
             'post_id'=>'required',
            'content'=>'required',
            'type'=>'required',
            ];
        }
        else//update
        {
             return [
             'post_id'=>'required',
            'content'=>'required',
            'type'=>'required',
            ];
        }
        
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function($model)
        {
            if ($model->forceDeleting && $model->type == 'image') {
               File::delete('uploads/post/'.$model->id.$model->content);
            } 
        });
    }
  
}


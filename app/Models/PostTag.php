<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostTag extends Model
{
   use SoftDeletes;

    protected $table = "post_tag";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id','tag_id'
  ];

    public static function rules($id = null)
    {
        if($id == null)//create new
        {
             return [
            'post_id'=>'required',
            'tag_id'=>'required',
            ];
        }
        else//update
        {
            return [
          	'post_id'=>'required',
            'tag_id'=>'required',
            ];
        }
        
    }

   public function tag()
    {
      return $this->belongsTo('App\Models\Tag','tag_id','id');
    }

    public function post()
    {
      return $this->belongsTo('App\Models\Post','post_id','id');
    }
  
}

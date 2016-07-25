<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostKubu extends Model
{
   use SoftDeletes;

    protected $table = "post_kubu";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label','description','post_id','position'
     ];

    public static function rules($id = null)
    {
        if($id == null)//create new
        {
             return [
             'label'=>'required',
            'post_id'=>'required',
            ];
        }
        else//update
        {
            return [
             'label'=>'required',
            'post_id'=>'required',
            ];
        }
        
    }



    public function replies()
    {
        return $this->hasMany('App\Models\ReplyKubu','post_kubu_id','id')->orderBy('created_at','DESC');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post','post_id','id')->withTrashed();
    }


}

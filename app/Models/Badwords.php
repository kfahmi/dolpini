<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Badwords extends Model
{
   use SoftDeletes;

    protected $table = "badwords";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'word','replace_to'
  ];

    public static function rules($id = null)
    {
        if($id == null)//create new
        {
             return [
            'word'=>'required|unique:badwords',
            ];
        }
        else//update
        {
            return [
            'word'=> 'required|unique:badwords,word,'.$id,  
            ];
        }
        
    }

    public function setWordAttribute($value)
    {
         $this->attributes['word'] = strtolower($value);
    }

    public function setReplaceToAttribute($value)
    {
         $this->attributes['replace_to'] = strtolower($value);
    }


    public function hasPostTag()
    {
      return $this->hasMany('App\Models\PostTag','tag_id','id');
    }

  
}

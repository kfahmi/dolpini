<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
   use SoftDeletes;

    protected $table = "tag";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag_name'
  ];

    public static function rules($id = null)
    {
        if($id == null)//create new
        {
             return [
            'tag_name'=>'required|unique:tag',
            ];
        }
        else//update
        {
            return [
          	'tag_name'=>'required|unique:tag,tag_name,'.$id, 
            ];
        }
        
    }

    public function getTagNameAttribute($value)
    {
        return strtolower($value);
    }

    public function hasPostTag()
    {
      return $this->hasMany('App\Models\PostTag','tag_id','id');
    }

  
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class ReplyKubu extends Model
{
   use SoftDeletes;

    protected $table = "reply_kubu";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text','post_kubu_id','user_id'
     ];

    public static function rules($id = null)
    {
        if($id == null)//create new
        {
             return [
            'text'=>'required',
            'post_kubu_id'=>'required',
            'user_id'=>'required',
            ];
        }
        else//update
        {
             return [
              'text'=>'required',
            'post_kubu_id'=>'required',
            'user_id'=>'required',
            ];
        }
        
    }

    public function getTextAttribute($value)
    {
        $bw = Badwords::all();

        $badWords = array();
        $replaceWords = array();
        foreach($bw as $w)
        {
            $badWords[$w->word]=$w->replace_to;
            $replaceWords[$w->word]=$w->replace_to;
        }
        
        

        $input = $value;
        $arr = explode(' ', $input);

        foreach($arr as $key => $word)
        {
            $word = preg_replace('/[^A-Za-z0-9\-]/', '', $word);
            if(in_array($word, array_keys($badWords)))
            {
                $arr[$key] = $badWords[$word];
            }
        }

        $output = implode(' ', $arr);

        return strtolower($output);
    }



    public function kubu()
    {
        return $this->belongsTo('App\Models\PostKubu','post_kubu_id','id');
    }

     public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id')->withTrashed();
    }
  
    public function hasLikes()
    {
       return $this->hasMany('App\Models\ReplyFlag','reply_kubu_id','id')->where('flag_type','like');
    }
    public function hasDislikes()
    {
       return $this->hasMany('App\Models\ReplyFlag','reply_kubu_id','id')->where('flag_type','dislike');
    }
    public function hasReports()
    {
       return $this->hasMany('App\Models\ReplyFlag','reply_kubu_id','id')->where('flag_type','report');
    }



    //userlogin nge like
    public function userLiked()
    {
      return $this->hasMany('App\Models\ReplyFlag','reply_kubu_id','id')->where('flag_type','like')->where('user_id',Auth::user()->id);
    }
    public function userDisliked()
    {
      return $this->hasMany('App\Models\ReplyFlag','reply_kubu_id','id')->where('flag_type','dislike')->where('user_id',Auth::user()->id);
    }
    public function userReported()
    {
      return $this->hasMany('App\Models\ReplyFlag','reply_kubu_id','id')->where('flag_type','report')->where('user_id',Auth::user()->id);
    }

}

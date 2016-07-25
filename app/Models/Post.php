<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Auth;
use App\Models\Badwords;
use DB;

class Post extends Model
{
   use SoftDeletes;

    protected $table = "post";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','title','type','header_content'
    ];


    public static function rules($id = null)
    {
        if($id == null)//create new
        {
             return [
            'user_id'=>'required',
            'title'=>'required',
            'type'=>'required',
            'header_content'=>'required',
            ];
        }
        else//update
        {
            return [
            'title'=>'required',
            'type'=>'required',
            'header_content'=>'required',
            ];
        }
        
    }

     protected static function boot()
    {
        parent::boot();
        static::deleting(function($model)
        {
                // softdelete Relationnya
                try
                {
                    DB::beginTransaction();
                    
                    //notif nya juga didelete
                    if(count($model->hasFlags)>0)
                    {
                        $model->hasFlags()->delete();
                    }

                    DB::commit();  
                }
                catch(Exception $e)
                {
                    DB::rollback();
                    throw new Exception("Error Processing Request", 1);
                }


            if(Auth::user()->level == 'admin')
            {
                $model->lock_by_admin = 1;
                $model->save();
            }

        });

        static::restoring(function($model)
        {
             // Restore Relationnya
            try
            {
                DB::beginTransaction();
                if(count($model->hasFlags_trashed)>0)
                {
                     foreach($model->hasFlags_trashed as $data)
                    {
                         $data->restore();
                    }
                }
               
                DB::commit();  
            }
            catch(Exception $e)
            {
                DB::rollback();
                throw new Exception("Error Processing Request", 1);
            }


            //restoring perform by siapa kan last updated
            $model->lock_by_admin = 0;
            $model->save();
        });
    }

    public function getHeaderContentAttribute($value)
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

        return ucfirst(strtolower($output));
    }

    public function getTitleAttribute($value)
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

        return ucfirst(strtolower($output));
    }

    public function getTypeAttribute($value)
    {
        return strtoupper($value);
    }


    

    public function setTitleAttribute($value)
    {
         $this->attributes['title'] = strtolower($value);
    }

    public function setHeaderContentAttribute($value)
    {
         $this->attributes['header_content'] = strtolower($value);
    }


    public function user()
    {
      return $this->belongsTo('App\Models\User','user_id','id')->withTrashed();
    }

    public function postDetails()
    {
      return $this->hasMany('App\Models\PostDetail','post_id','id');
    }

    public function postTags()
    {
      return $this->hasMany('App\Models\PostTag','post_id','id');
    }

    public function postKubu()
    {
      return $this->hasMany('App\Models\PostKubu','post_id','id');
    }

    public function subscriber()
    {
      return $this->hasMany('App\Models\PostSubscribe','post_id','id');
    }


    public function replies()
    {
        $replies = array();

        foreach ($this->PostKubu as $p)
        {
            foreach ($p->replies as $r)
            {
                if ($r->id !== $this->id && !isset($products[$r->id]))
                {
                    $replies[$r->id] = $replies;
                }
            }
        }

        $tes = \Illuminate\Database\Eloquent\Collection::make($replies);

        var_dump($tes);
        exit();
    }

    public function postDetailsImage()
    {
      return $this->hasMany('App\Models\PostDetail','post_id','id')->where('type','=','image');
    }

    public function postDetailsYoutube()
    {
      return $this->hasMany('App\Models\PostDetail','post_id','id')->where('type','=','youtube');
    }

    public function postDetailsUrl()
    {
      return $this->hasMany('App\Models\PostDetail','post_id','id')->where('type','=','url');
    }


    public function hasFlags()
    {
       return $this->hasMany('App\Models\PostFlag','post_id','id');
    }

    public function hasFlags_trashed()
    {
       return $this->hasMany('App\Models\PostFlag','post_id','id')->onlyTrashed();
    }

    public function hasLikes()
    {
       return $this->hasMany('App\Models\PostFlag','post_id','id')->where('flag_type','like');
    }
    public function hasDislikes()
    {
       return $this->hasMany('App\Models\PostFlag','post_id','id')->where('flag_type','dislike');
    }
    public function hasReports()
    {
       return $this->hasMany('App\Models\PostFlag','post_id','id')->where('flag_type','report');
    }


    //userlogin nge like
    public function userLiked()
    {
      return $this->hasMany('App\Models\PostFlag','post_id','id')->where('flag_type','like')->where('user_id',Auth::user()->id);
    }
    public function userDisliked()
    {
      return $this->hasMany('App\Models\PostFlag','post_id','id')->where('flag_type','dislike')->where('user_id',Auth::user()->id);
    }
    public function userReported()
    {
      return $this->hasMany('App\Models\PostFlag','post_id','id')->where('flag_type','report')->where('user_id',Auth::user()->id);
    }



  
}

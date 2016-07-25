<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\ReplyKubu;
use App\Models\Tag;
use App\Models\PostTag;
use App\Models\User;


use Auth;
use Redirect;
use Helper;

class HomeController extends Controller
{
   
    public function index(Request $request, $tag=null)
    {
        //allpost
        if($tag == null)
        {
            $allPost = Post::with('user','postDetails','postTags','subscriber')->orderBy('updated_at', 'DESC')->get();

            $t = Tag::find($tag);
        }
        //trending (MOST COMMENTED)
        else if($tag == 'mostCommented')
        {
            $allPost = Post::with('user','postDetails','postTags','subscriber')->get()->sortByDesc(function ($post) {
            $total = 0;
            foreach($post->postKubu as $pk)
            {
              $total += $pk->replies->count();
            }
            return $total;
            });

            $t = null;
        }
        //top topic (most subscriber)
        else if($tag == 'mostSubscriber')
        {
           $allPost = Post::with('user','postDetails','postTags','subscriber')->get()->sortByDesc('subscriber');

           $t = null;
        }
        //yang di subscribe user ini
        else if($tag == 'subscribed')
        {
            $user_id = Auth::user()->id;
            $allPost = Post::with('user','postDetails','postTags','subscriber')->whereHas("subscriber", function($q) use($user_id) {
                                $q->where('user_id',$user_id);
                       },'>',0)->get();

            $t = null;
        }
        else if($tag == 'artikel' || $tag == 'debat' || $tag == 'rating')
        {
            $allPost = Post::with('user','postDetails','postTags','subscriber')->where('type',$tag)->orderBy('updated_at', 'DESC')->get();
            $t = null;
        }
        //kalo ada hashtagsnya
        else
        {
              $allPost = Post::with('user','postDetails','postTags','subscriber')->whereHas("postTags", function($q) use($tag) {
                                  $q->where('tag_id',$tag);
                         },'>',0)->orderBy('updated_at', 'DESC')->get();

              $t = Tag::find($tag);
              $topTags = NULL;
              if(count($t) > 0)
              {
                 $pt = PostTag::where('tag_id',$tag)->count();
                 $request->session()->flash('alert-info', $pt.' data mengandung hashtags #'.$t->tag_name);
              }
              else
              {
                 $request->session()->flash('alert-danger', 'Hashtags tidak Ditemukan');
              }
        }

        //TOPTAGS trending hashtags
        $topTags = Tag::get()->sortByDesc(function ($tag){
        return $tag->hasPostTag->count();
        });

        return view('home')->with(array('allPost'=>$allPost,'tag'=>$t,'topTags'=>$topTags));
    }

    public function search()
    {
        $text = $_POST['textSearch'];

        if (preg_match('/#/',$text))
        {
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $text);

            $tagCount = Tag::where('tag_name',$string)->count();

            if($tagCount < 1 )
            {
                return redirect('/home/tagNotFound');
            }
            else
            {

                $tag = Tag::where('tag_name',$string)->first();
                return redirect('/home/'.$tag->id);
            }
        }
        else
        {
            return redirect('/');
        }
    }





    //ADMINISTRATOR
    public function indexAdmin(Request $request, $tag=null)
    {
        $user = User::where('level','user')->orderBy('id','DESC')->withTrashed()->limit(5)->get();
        $post = Post::withTrashed()->orderBy('id','DESC')->limit(5)->get();
        $replyKubu = ReplyKubu::withTrashed()->orderBy('id','DESC')->limit(5)->get();


        return view('admin.home')->with(array('user'=>$user,'post'=>$post,'replyKubu'=>$replyKubu));
    }
}

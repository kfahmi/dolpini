<?php
namespace App\Http\Controllers\Post;

use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use App\Http\Controllers\Controller;
use Redirect;

use Validator;
use Auth;

use App\Models\Post;
use App\Models\Tag;
use DB;

class PostTagController extends Controller
{
  // public function listPost(Request $request,$tag)
  // {
  //   $posttags = Post::whereHas("postTags", function($q) use($tag) {
  //   						$q->where('tag_id',$tag);
		// 		   },'<',1)->get();

  //   return view('post.listPostByTag')->with(array('allPost'=>$posttags));
  // }
}
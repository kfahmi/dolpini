<?php
namespace App\Http\Controllers\Post;

use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use App\Http\Controllers\Controller;
use Redirect;

use Validator;
use Auth;
use AuthData;
use Notification;

use App\Models\Tag;
use App\Models\PostTag;

use DB;
use Carbon\Carbon;
use Helper;

class TagController extends Controller
{

    public function admin(Request $request)
    {
        $tag = Tag::withTrashed()->get()->sortByDesc(function ($tag){
        return $tag->hasPostTag->count();
        });
        return view('admin.tag.index')->with(array('tag'=>$tag));
    }


}


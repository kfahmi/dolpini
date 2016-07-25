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

use App\Models\Post;
use App\Models\PostDetail;
use App\Models\PostKubu;
use App\Models\PostSubscribe;
use App\Models\ReplyKubu;
use App\Models\PostTag;
use App\Models\Tag;
use DB;
use Carbon\Carbon;
use Helper;

use Cookie;

use URL;
use File;

class PostController extends Controller
{
      public function subscribe(Request $request,$post_id = null)
          {
            //kalo udah subscribe
            if(Helper::alreadySubscribe($post_id,Auth::user()->id) ==  true)
            {
                PostSubscribe::where('post_id',$post_id)->where('user_id',Auth::user()->id)->delete();
                $request->session()->flash('alert-danger', 'Sudah tidak mengikuti Topik!');
                return Redirect::to('/post/detail/'. $post_id);
            }
            //kalo blm subscribe
            else if(Helper::alreadySubscribe($post_id,Auth::user()->id) ==  false)
            {
                $input = Input::all();
                $input['user_id'] = Auth::user()->id;
                $input['post_id'] = $post_id;

                    $v = Validator::make($input, PostSubscribe::rules());
                    if($v->fails())
                    {
                            // redirect our user back with error messages       
                            $messages = $v->messages();

                            // also redirect them back with old inputs so they dont have to fill out the form again
                            // but we wont redirect them with the password they entered
                            $request->session()->flash('alert-danger', 'Gagal Mengikuti Topik!');
                            return Redirect::to('/post/detail/'. $post_id)
                                ->withErrors($v)
                                ->withInput();
                    }
                    else
                    {
                       try
                         {
                            DB::beginTransaction();
                            PostSubscribe::create($input);

                            DB::commit();  
                        }
                        catch(Exception $e)
                        {
                            DB::rollback();
                            throw new Exception("Error Processing Request", 1);
                        }

                        $request->session()->flash('alert-info', 'Berhasil mengikuti Topik!');
                        return Redirect::to('/post/detail/'. $post_id);
                    }
            }
          }  


      //delete post
      public function delete(Request $request, $id=null)
      {
        if(AuthData::ownerPost($id,Auth::user()->id) == true || Auth::user()->level == 'admin')
        {
            $data = Post::findOrFail($id);
            $data->delete();
            $request->session()->flash('alert-info', 'Topik telah dihapus!');

            // return Redirect::to(Helper::homepage(Auth::user()->level));
            return Redirect::back();
        }
        else
        {
            $request->session()->flash('alert-danger', 'Permintaan ditolak!');
            return Redirect::back();
        }
      }

      public function deleteDetail(Request $request, $id=null)
      {
        $data = PostDetail::findOrFail($id);

        if(AuthData::ownerPost($data->post_id,Auth::user()->id) == true || Auth::user()->level == 'admin')
        {
            $data->forceDelete();
            $request->session()->flash('alert-info', 'Detail topik telah dihapus!');

            // return Redirect::to(Helper::homepage(Auth::user()->level));
            return Redirect::back();
        }
        else
        {
            $request->session()->flash('alert-danger', 'Permintaan ditolak!');
            return Redirect::back();
        }
      }


      //reactivate
      public function reactivate(Request $request, $id=null)
      {
        $data = Post::onlyTrashed()->findOrFail($id);

        //kalau di lock admin.
        if($data->lock_by_admin == 1)
        {
            if(Auth::user()->level == 'admin')
            {
                if($data->restore())
                {
                    $request->session()->flash('alert-info', 'Topik telah dikembalikan!');
                    // return Redirect::to(Helper::homepage(Auth::user()->level));
                    return Redirect::back();
                }
                else
                {
                    $request->session()->flash('alert-danger', 'Permintaan Error!');
                    return Redirect::back();
                }
            }
            else
            {
                $request->session()->flash('alert-danger', 'Permintaan ditolak! Block By Administrator, Hubungi admin dolpini di admin@dolpini.com');
                return Redirect::back();
            }
        }
        else
        {
            if(AuthData::ownerPost($id,Auth::user()->id) == true || Auth::user()->level == 'admin')
            {
                if($data->restore())
                {
                    $request->session()->flash('alert-info', 'Topik telah dikembalikan!');
                    // return Redirect::to(Helper::homepage(Auth::user()->level));
                    return Redirect::back();
                }
                else
                {
                    $request->session()->flash('alert-danger', 'Permintaan Error!');
                    return Redirect::back();
                }
            }
            else
            {
                $request->session()->flash('alert-danger', 'Permintaan ditolak!');
                return Redirect::back();
            }
        }
      }



    //reply post
      public function reply(Request $request)
      {
        $input = Input::all();
        $input['user_id'] = Auth::user()->id;
        $post_id = $input['post_id'];
        // var_dump($input['kubuLabel']);
        // exit();

        $v = Validator::make($input, ReplyKubu::rules());
        if($v->fails())
        {
                // redirect our user back with error messages       
                $messages = $v->messages();

                // also redirect them back with old inputs so they dont have to fill out the form again
                // but we wont redirect them with the password they entered
                $request->session()->flash('alert-danger', 'Gagal membalas topic!');
                return Redirect::to('/post/detail/'. $post_id)
                    ->withErrors($v)
                    ->withInput();
        }
        else
        {
               try
                 {
                    DB::beginTransaction();
                    $data = ReplyKubu::create($input);
                    $reply_id = $data->id;

                    //ubah last update topic
                    $post = Post::findOrFail($post_id);
                    $post->updated_at = Carbon::now();
                    $post->save(); 

                    //jika belom subscribe topic ini otomatis langsung subscribe abis bales
                    if(Helper::alreadySubscribe($post_id,Auth::user()->id) ==  false)
                    {
                        //subscribe topic ini otomatis
                        $this->postSub($post_id);
                    }

                    //notif untuk subscriber
                    //createNotif(activity_id, activity_id_type, parent_id, parent_id_type);
                    //e.g createNotif(reply_id, ReplyKubu, post_id, Post)
                    Notification::createNotif($reply_id,'ReplyKubu', $post_id, 'Post');



                    DB::commit();  
                }
                catch(Exception $e)
                {
                    DB::rollback();
                    throw new Exception("Error Processing Request", 1);
                }

                $request->session()->flash('reply_id', $reply_id);
                $request->session()->flash('alert-info', 'Telah berhasil membalas!');
                return Redirect::to('/post/detail/'. $post_id);
            }
           
        }



        //create new post
        public function store(Request $request)
          {
            $input = Input::all();
            $input['user_id'] = Auth::user()->id;

            // var_dump($input['kubuLabel']);
            // exit();

            $v = Validator::make($input, Post::rules());
            if($v->fails())
            {
                    // redirect our user back with error messages       
                    $messages = $v->messages();

                    // also redirect them back with old inputs so they dont have to fill out the form again
                    // but we wont redirect them with the password they entered
                    $request->session()->flash('alert-danger', 'Gagal membuat Topik!');
                    return Redirect::to('home')
                        ->withErrors($v)
                        ->withInput();
            }
            else
            {
                   try
                     {
                        DB::beginTransaction();
                        $data = Post::create($input);
                        $post_id = $data->id;

                        //kalo ada detailnya
                        if(!empty($input['detail']))
                        {
                            //DETAILS
                            if(isset($input['detail']) == true)//kalo ada
                            {
                                $details = $input['detail'];


                                $inputDetails = Input::all();

                                foreach($details as $key=>$value)
                                {
                                    if($value['content'] != '')
                                    {  
                                        $inputDetails['post_id'] = $post_id;
                                        $inputDetails['type'] = $value['type'];

                                        if($value['type'] == 'image')
                                        { 
                                            $extension = $value['content']->getClientOriginalExtension();
                                            $destinationPath = 'uploads/post';
                                           
                                            $inputDetails['content'] = '.'.$extension;
                                            $inputDetails['extension'] = $extension;
                                            
                                            $pd = PostDetail::create($inputDetails);


                                            $filename = $pd->id.'.'.$extension;
                                            $upload_success = $value['content']->move($destinationPath, $filename); 

                                        }
                                        else if($value['type'] == 'youtube')
                                        {
                                            //bersihkan youtube url ambil var nya aja.
                                            $getVar = substr($value['content'], strpos($value['content'], "=") + 1);    
                                            $inputDetails['content'] = $getVar;
                                             PostDetail::create($inputDetails);
                                        }
                                        else
                                        { 
                                             $inputDetails['content'] = $value['content'];
                                            PostDetail::create($inputDetails);
                                        }

                                       
                                    }
                                }
                             }
                         }  

                        //HASHTAGS
                          if(isset($input['tags']) == true)
                            {
                                $tagsPlain = $input['tags'];
                                $tags = explode(",", $tagsPlain);

                                foreach($tags as $t)
                                {
                                    $t = strtolower(str_replace(' ','',$t));
                                    $t = preg_replace('/[^A-Za-z0-9\-]/', '', $t);
                                    $cekTag = Tag::where('tag_name','=',$t)->first();
                                    //kalo tag blm ada di DB
                                    if(count($cekTag) < 1 && $t !== '')
                                    {
                                       $createTag = Tag::create(array('tag_name' => $t));
                                       $tag_id = $createTag->id;

                                       //masukin ke table post tag
                                       $postTag = PostTag::create(array('post_id'=>$post_id,'tag_id'=>$tag_id));
                                    }
                                    else if(count($cekTag) > 0 && $t !== '')
                                    {
                                        $postTag = PostTag::create(array('post_id'=>$post_id,'tag_id'=>$cekTag->id));
                                    }
                                    
                                }
                            }

                        //KUBU
                            if(isset($input['kubuLabel']) == true)
                            {
                                $kubuLabel = $input['kubuLabel'];
                                $inputKubu = Input::all();
                                $inputKubu['post_id'] = $post_id;

                                foreach($kubuLabel as $key=>$value)
                                {
                                    if($value != '')
                                    {
                                       $inputKubu['label'] = $value;
                                        PostKubu::create($inputKubu); 
                                    }
                                    
                                }
                            }

                            //subscribe topic ini otomatis
                            $this->postSub($post_id);

                            //KIRIM NOTIF KE FOLLOWER SI YANG POST
                            Notification::createNotif($post_id,'Post');

                            DB::commit();  
                        }
                        catch(Exception $e)
                        {
                            DB::rollback();
                            throw new Exception("Error Processing Request", 1);
                        }

                        $request->session()->flash('alert-info', 'Berhasil membuat Topik!');
                        return Redirect::to('/');
                }
               
            }


            public function view(Request $request,$id,$reply_id = null)
            {
                $post = Post::with('postKubu','postTags','postDetailsImage','postDetailsYoutube','postDetailsUrl')->withTrashed()->findOrFail($id);


                if($reply_id != null)
                {
                    $request->session()->flash('reply_id', $reply_id);
                }

                return view('post.view')->with(array('post'=>$post));

                // if(isset($post->deleted_at))
                // {
                //     return view('post.view_deleted')->with(array('post'=>$post));
                // }
                // else
                // {
                //     return view('post.view')->with(array('post'=>$post));
                // }
            }


            public function editProcess(Request $request,$id)
            {
                if(AuthData::ownerPost($id,Auth::user()->id) == true || Auth::user()->level == 'admin')
                {
                   $input = Input::all();
                   $post = Post::withTrashed()->findOrFail($id);

                    $v = Validator::make($input, Post::rules($id));
                    if($v->fails())
                    {
                          // redirect our user back with error messages       
                          $messages = $v->messages();
                          // also redirect them back with old inputs so they dont have to fill out the form again
                          // but we wont redirect them with the password they entered
                          $request->session()->flash('alert-danger', 'Failed to Update!');
                          return Redirect::to('post/edit/'.$id)
                              ->withErrors($v)
                              ->withInput();
                    }
                    else
                    {
                        try
                         {
                            DB::beginTransaction();
                                $post->update($input);
                                DB::commit();  
                            }
                            catch(Exception $e)
                            {
                                DB::rollback();
                                throw new Exception("Error Processing Request", 1);
                            }
                            
                            $request->session()->flash('alert-info', 'Topik was successful Updated!');
                            return Redirect::to('post/edit/'.$id);
                    }

                }
                else
                {
                    $request->session()->flash('alert-danger', 'you are not authorized to perform that action!');
                    return redirect('/post/detail/'.$id);
                }
            }

            public function edit(Request $request,$id)
            {
                if(AuthData::ownerPost($id,Auth::user()->id) == true || Auth::user()->level == 'admin')
                {
                    $post = Post::with('postKubu','postTags','postDetailsImage','postDetailsYoutube','postDetailsUrl')->withTrashed()->findOrFail($id);
                    return view('post.edit')->with(array('post'=>$post));
                }
                else
                {
                    return redirect('/post/detail/'.$id);
                }
            }


            public function postSub($post_id)
            {
                $subscribe = new PostSubscribe;
                $subscribe->post_id = $post_id;
                $subscribe->user_id = Auth::user()->id;
                $subscribe->save();
            }


            public function deleteRestoreReply(Request $request)
            {
                $id = $_POST['id'];
                $data = ReplyKubu::withTrashed()->findOrFail($id);

                if(isset($data->deleted_at))
                {
                    $data->deleted_at = null;
                    $data->save();
                    $request->session()->flash('alert-info', 'Komentar telah direstore!');
                }
                else
                {
                    $data->delete();
                    $request->session()->flash('alert-info', 'Komentar telah dihapus!');
                }
                return redirect('post/reply/admin');
            }



            //ADIMINISTRATOR
            public function admin(Request $request)
            {
                $topik = Post::with('user','postDetails','postTags','subscriber')->orderBy('updated_at', 'DESC')->withTrashed()->get();
                return view('admin.post.index')->with(array('topik'=>$topik));
            }


            public function adminReply(Request $request)
            {
                $replyKubu = ReplyKubu::orderBy('created_at', 'DESC')->withTrashed()->get();
                return view('admin.post.indexReply')->with(array('replyKubu'=>$replyKubu));
            }


          
}

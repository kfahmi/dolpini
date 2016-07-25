<?php
namespace App\Http\Controllers\Post;

use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use App\Http\Controllers\Controller;
use Redirect;

use Validator;
use Auth;
use Notification;

use App\Models\Post;
use App\Models\PostFlag;
use DB;
use Carbon\Carbon;

class PostFlagController extends Controller
{
        //create new post
        public function store(Request $request, $type, $id)
        {
            $user_id = Auth::user()->id;

            $q = PostFlag::where('user_id',$user_id)->where('post_id',$id);


            if($q->count() > 0)
            {
                try
                    {
                        DB::beginTransaction();
                        $postFlag = $q->first();
                        $postFlag->flag_type = $type;
                        $postFlag->save(); 

                        //create notif, $type itu additional info type flag aja
                        // Notification::createNotif($postFlag->id,'PostFlag',$id,'Post',$type);
                        
                        DB::commit();  
                    }
                    catch(Exception $e)
                    {
                        DB::rollback();
                        throw new Exception("Error Processing Request", 1);
                    }

                    $request->session()->flash('alert-info', 'Kamu Berhasil '.$type.' Topic ini!');
                    // return Redirect::back();
                     return Redirect::to('/post/detail/'. $id);
            }
            //kalo blm ada flag di post ini
            else
            {
                $input = Input::all();
                $input['user_id'] = $user_id;
                $input['post_id'] = $id;
                $input['flag_type'] = $type;
                $v = Validator::make($input, PostFlag::rules());
                if($v->fails())
                {
                        // redirect our user back with error messages       
                        $messages = $v->messages();

                        // also redirect them back with old inputs so they dont have to fill out the form again
                        // but we wont redirect them with the password they entered
                        $request->session()->flash('alert-danger', ' Kamu Gagal '.$type.' Topic ini!');
                        return Redirect::to('/home')
                            ->withErrors($v)
                            ->withInput();
                }
                else
                {
                   try
                     {
                        DB::beginTransaction();
                        $flag = PostFlag::create($input);

                        //create notif, $type itu additional info type flag aja
                        // Notification::createNotif($flag->id,'PostFlag',$id,'Post',$type);

                        DB::commit();  
                    }
                    catch(Exception $e)
                    {
                        DB::rollback();
                        throw new Exception("Error Processing Request", 1);
                    }

                    $request->session()->flash('alert-info', 'Kamu Berhasil '.$type.' Topic ini!');
                    // return Redirect::back();
                    return Redirect::to('/post/detail/'. $id);
                }
            }               
        }




        //ADMIN

        public function cleanReported(Request $request,$post_id)
        {
            $flag = PostFlag::where('flag_type','report')->where('post_id',$post_id)->get();

            foreach($flag as $f)
            {
                $f->forceDelete();
            }

            $request->session()->flash('alert-info', 'Laporan tentang topik telah dihapuskan. topik dianggap aman oleh sistem dolpini.');
            return Redirect::back();
        }


      
}

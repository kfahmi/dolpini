<?php
namespace App\Http\Controllers\Post;

use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use App\Http\Controllers\Controller;
use Redirect;

use Validator;
use Auth;

use App\Models\ReplyFlag;
use App\Models\ReplyKubu;
use DB;
use Carbon\Carbon;
use Notification;

class ReplyFlagController extends Controller
{
        //create new post
        public function store(Request $request, $type, $id)
        {
            $user_id = Auth::user()->id;

            $q = ReplyFlag::where('user_id',$user_id)->where('reply_kubu_id',$id);
            $r = ReplyKubu::findOrFail($id);

            if($q->count() > 0)
            {
                try
                    {
                        DB::beginTransaction();
                        $replyFlag = $q->first();
                        $replyFlag->flag_type = $type;
                        $replyFlag->save(); 

                        //create notif, $type itu additional info type flag aja
                        Notification::createNotif($replyFlag->id,'ReplyFlag',$id,'ReplyKubu',$type);

                        DB::commit();  
                    }
                    catch(Exception $e)
                    {
                        DB::rollback();
                        throw new Exception("Error Processing Request", 1);
                    }
            }
            //kalo blm ada flag di post ini
            else
            {
                $input = Input::all();
                $input['user_id'] = $user_id;
                $input['reply_kubu_id'] = $id;
                $input['flag_type'] = $type;
                $v = Validator::make($input, ReplyFlag::rules());
                if($v->fails())
                {
                        // redirect our user back with error messages       
                        $messages = $v->messages();

                        // also redirect them back with old inputs so they dont have to fill out the form again
                        // but we wont redirect them with the password they entered
                        $request->session()->flash('alert-danger', 'Gagal '.$type.' Komentar!');
                        return Redirect::to('/home')
                            ->withErrors($v)
                            ->withInput();
                }
                else
                {
                   try
                     {
                        DB::beginTransaction();
                        $replyFlag = ReplyFlag::create($input);

                        //create notif, $type itu additional info type flag aja
                        Notification::createNotif($replyFlag->id,'ReplyFlag',$id,'ReplyKubu',$type);

                        DB::commit();  
                    }
                    catch(Exception $e)
                    {
                        DB::rollback();
                        throw new Exception("Error Processing Request", 1);
                    }
                }

            }               

            $request->session()->flash('reply_id', $id);
            $request->session()->flash('alert-info', 'Berhasil '.$type.' Komentar!');
            return Redirect::to('/post/detail/'. $r->kubu->post_id.'/'.$id);
        }



        //admin
        public function cleanReported(Request $request,$reply_id)
        {
            $flag = ReplyFlag::where('flag_type','report')->where('reply_kubu_id',$reply_id)->get();

            foreach($flag as $f)
            {
                $f->forceDelete();
            }

            $request->session()->flash('alert-info', 'Laporan tentang komentar telah dihapuskan. topik dianggap aman oleh sistem dolpini.');
            return Redirect::back();
        }


      
}

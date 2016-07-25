<?php
namespace App\Http\Controllers\User;

use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use App\Http\Controllers\Controller;
use Redirect;

use Validator;
use Auth;
use DB;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Follow;

use Mail;

class FollowController extends Controller
{

        public function store(Request $request, $id)
        {
          if(Auth::user()->id != $id)
          {
              $user = User::where('id','=',$id)->first();

              if($user->auto_accept_follower == 0)//gak autoaccept
              {
                $follow = new Follow;
                $follow->user_id = Auth::user()->id;
                $follow->follow_user_id = $user->id;
             
                if($follow->save())
                {
                  $request->session()->flash('alert-info', 'request follow sent!');
                  Mail::send('emails.followRequest', array('data'=>$follow), function($message) use($follow)
                  {
                        $message->to($follow->followUser->email)->subject('You have new follow request!');
                  });

                  return Redirect::to('user/profile/'.$user->nick_name);
                }
                
              }
              else if($user->auto_accept_follower == 1)
              {

                $follow = new Follow;
                $follow->user_id = Auth::user()->id;
                $follow->follow_user_id = $user->id;
                $follow->accepted_at =  Carbon::now();
                if($follow->save())
                {
                    $request->session()->flash('alert-info', 'request follow accepted!');
                    Mail::send('emails.followApproved', array('data'=>$follow), function($message) use($follow)
                    {
                          $message->to($follow->user->email)->subject('Follow request has been approved!');
                    });

                    return Redirect::to('user/profile/'.$user->nick_name);
                }
                
              }
          }
          else //kalau dia add diri sendiri
          {
            $request->session()->flash('alert-danger', 'Your request are not allowed!');
            return Redirect::back();
          }
            
        }

        public function app(Request $request, $id)
        {
         
          $input = Input::all();
          $follow = Follow::findOrFail($id);
          $follow->accepted_at = Carbon::now();

          // Start transaction!
            DB::beginTransaction();
            try 
            {
                //approve update customer po
                $follow->update();
                DB::commit();
                //masukin mail notification
            } 
            catch(ValidationException $e)
            {
                // Rollback and then redirect
                // back to form with errors
                DB::rollback();
                $request->session()->flash('alert-info', 'Failed to Approve!');
                return Redirect::to('/')
                    ->withErrors( $e->getErrors() )
                    ->withInput();
            } 
            catch(\Exception $e)
            {
                DB::rollback();
                throw $e;
            }

            $request->session()->flash('alert-info', 'Now '.$follow->user->nick_name.' has been following you!');
            Mail::send('emails.followApproved', array('data'=>$follow), function($message) use($follow)
            {
                  $message->to($follow->user->email)->subject('Follow request has been approved!');
            });
            return Redirect::to('/home');
          
        }
}

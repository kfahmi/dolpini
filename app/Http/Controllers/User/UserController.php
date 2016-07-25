<?php
namespace App\Http\Controllers\User;

use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use App\Http\Controllers\Controller;
use Redirect;

use Validator;
use Auth;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Follow;
use Helper;
use Counter;
use DB;
use Notification;


class UserController extends Controller
{
        //create new post
        public function profile(Request $request, $nick_name)
        {
          $user = User::where('nick_name','=',$nick_name)->first();

          //+1 views kalo bukan dia sendiri yang lihat profilenya dia.
          if(Auth::user()->id != $user->id)
          {
              Counter::counterViewer($user->id);
          }

          $realname = $user->real_name;
          $realname_explode = explode(" ",$realname);

          // kalo satu kosa kata
          if(count($realname_explode) == 1)
          {
            $userInitial = strtoupper($realname_explode[0][0]);
          }
          else //lebih dari satu kosa kata
          {
            $userInitial = strtoupper($realname_explode[0][0]." ".$realname_explode[1][0]);
          }

          //jika bukan profile sndiri
          if($nick_name != Auth::user()->nick_name)
          {
              $relationStatus = Helper::checkFollow(Auth::user()->id,$user->id);

              return view('user.profile')->with(array('user'=>$user,'userInitial'=>$userInitial,'relationStatus'=>$relationStatus));
          }
          else
          {
            return view('user.profile')->with(array('user'=>$user,'userInitial'=>$userInitial));
          }

        }


        public function edit(Request $request)
        {

          $input = Input::all();
          if(isset($input['email_notif']))
          {
            $input['email_notif'] = '1';
          }
          else
          {
            $input['email_notif'] = '0';
          }

          if(isset($input['auto_accept_follower']))
          {
            $input['auto_accept_follower'] = '1';
          }
          else
          {
            $input['auto_accept_follower'] = '0';
          }

          $id = $input['id'];
          $user = User::findOrFail($id);

           $v = Validator::make($input, User::rules($id,'data'));
            if($v->fails())
            {
                  // redirect our user back with error messages       
                  $messages = $v->messages();

                  // also redirect them back with old inputs so they dont have to fill out the form again
                  // but we wont redirect them with the password they entered
                  $request->session()->flash('alert-danger', 'Failed to Update!');
                  return Redirect::to('user/profile/'.$user->nick_name)
                      ->withErrors($v)
                      ->withInput();
            }
            else
            {
                  try
                     {
                        DB::beginTransaction();
                              //kalo ada photonya
                            if(!empty($input['newPhoto']))
                            {
                                $extension = $input['newPhoto']->getClientOriginalExtension();
                                $destinationPath = 'uploads/userImg';
                                $filename = $id.'.'.$extension;
                                $upload_success = $input['newPhoto']->move($destinationPath, $filename); 
                                $user->img = $filename;
                                $user->save();
                             }
                             
                            $user->update($input);
                            DB::commit();  
                        }
                        catch(Exception $e)
                        {
                            DB::rollback();
                            throw new Exception("Error Processing Request", 1);
                        }

                       $request->session()->flash('alert-info', 'Your profile was successful Updated!');
                      return Redirect::to('user/profile/'.$user->nick_name);

            }
        }





        //ADMINISTRATOR
            public function admin(Request $request)
            {
                $user = User::withTrashed()->get();

                return view('admin.user.index')->with(array('user'=>$user));
            }


            public function deleteRestore(Request $request)
            {
               $id = $_POST['id'];
               $data = User::withTrashed()->findOrFail($id);

               //jika deleted_at ada valuenya
                if(isset($data->deleted_at))
                {
                    $data->deleted_at = null;
                    $data->save();
                    $request->session()->flash('alert-info', 'User telah direstore!');
                }
                else
                {
                    $data->delete();
                    $request->session()->flash('alert-info', 'User telah dihapus!');
                }
                return redirect('user/admin');
            }

            public function verify_unverify_ByAdmin(Request $request,$id)
            {
               $data = User::withTrashed()->findOrFail($id);

               //AKTIFASI - jika kondisinya ada confirmation code
                if($data->confirmation_code != null)
                {
                    $data->confirmation_code = null;
                    $data->deleted_at = null;
                    $data->save();
                    Notification::email($id,$type = 'userVerified');
                    $request->session()->flash('alert-info', $data->nick_name.' has been verified and activated.!');
                    return redirect('user/profile/'.$data->nick_name);
                }
                //deactivate
                else if($data->confirmation_code == null)
                {
                    $data->confirmation_code = $data->nick_name;
                    $data->save();
                    $data->delete();
                    Notification::email($id,$type = 'userDeactivate');
                    $request->session()->flash('alert-info', $data->nick_name.' has been deactivate and unverified.!');
                    return redirect('user/admin');
                }
             
            }

            public function sendCode(Request $request, $user_id)
            {

              $user = User::withTrashed()->findOrFail($user_id);

               Notification::email($user_id,$type = 'userVerification');

               $request->session()->flash('alert-info', 'Confirmation Code has been sent to '.$user->email);
               return redirect('user/profile/'.$user->nick_name);
            }

            public function verifyByUser(Request $request, $user_id, $confirmation_code)
            {

              $user = User::withTrashed()->find($user_id);

              if(count($user) > 0)
              {
                if($user->confirmation_code == $confirmation_code)
                {
                  $user->confirmation_code = null;
                  $user->deleted_at = null;
                  $user->save();
                  Notification::email($user_id,$type = 'userVerified');
                  $request->session()->flash('alert-info', $user->nick_name.' berhasil di verifikasi, silahkan login menggunakan email dan password yang terdaftar untuk akun tersebut.');
                  return redirect('/login');
                }
                else
                {
                  $request->session()->flash('alert-danger', $user->nick_name.' gagal di verifikasi, silahkan hubungi administrator dolpini di admin@dolpini.com.');
                  return redirect('/login');
                }
              }
              else
              {
                  $request->session()->flash('alert-danger', 'Confirmation code tidak berlaku.');
                  return redirect('/login');
              }
              


            }

}

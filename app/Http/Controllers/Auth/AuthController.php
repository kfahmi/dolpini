<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Input;
use Illuminate\Http\Request;
use Notification;

use DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'=>'required|email|unique:users',
            'mobile_phone'=>'required',
            'real_name'=>'required',
            'nick_name'=>'required|unique:users',
            'gender'=>'required',
            'birth_date'=>'required',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $input = $data;
        // $input['password'] = bcrypt($data['password']);
        $input['level'] = 'user';
        $input['viewer'] = 0;
        $input['confirmation_code'] = $data['nick_name'];

        return User::create($input);
    }


    //override
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

         try
         {
            DB::beginTransaction();
                $data = $this->create($request->all());
                $user_id = $data->id;
                $data->delete();

                //kirim email verifikasi dan kodenya disini.
                Notification::email($user_id,$type = 'userVerification');
                DB::commit();  
            }
            catch(Exception $e)
            {
                DB::rollback();
                throw new Exception("Error Processing Request", 1);
            }


        $request->session()->flash('alert-info', 'Registrasi berhasil, silahkan check email verifikasi yang telah dikirimkan ke email anda atau hubungi administrator kami!');
        return redirect('/login');
    }
}

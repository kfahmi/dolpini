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

use App\Models\Badwords;

use App\Models\Post;

use DB;
use Carbon\Carbon;
use Helper;

class BadwordsController extends Controller
{
    //ADIMINISTRATOR
    public function forceDelete(Request $request)
      {
            $id = $_POST['id'];
            $data = Badwords::findOrFail($id);
            $data->forceDelete();
            $request->session()->flash('alert-info', 'Sensor kata telah dihapus!');
            return redirect('badwords/admin');
      }


    public function edit(Request $request,$id)
    {
        $badword = Badwords::findOrFail($id);

        return view('admin.badwords.edit')->with(array('badword'=>$badword));
    }

    public function update(Request $request)
    {
        $input = Input::all();
        $id = $input['id'];
        $badwords = Badwords::findOrFail($id);
        $input['updated_by'] = Auth::user()->id;
         $v = Validator::make($input, Badwords::rules($id));
            if($v->fails())
            {
                    // redirect our user back with error messages       
                    $messages = $v->messages();

                    // also redirect them back with old inputs so they dont have to fill out the form again
                    // but we wont redirect them with the password they entered
                    $request->session()->flash('alert-danger', 'Failed to Update Badwords!');
                    return Redirect::back()
                        ->withErrors($v)
                        ->withInput();
            }
            else
            {
                    if($badwords->update($input))
                    {
                        $request->session()->flash('alert-info', 'Badwords was successful Updated!');
                        return Redirect::to('badwords/admin');
                    }
            }

    }


    public function admin(Request $request)
    {
        $word = Badwords::withTrashed()->get();

        return view('admin.badwords.index')->with(array('word'=>$word));
    }

    public function create(Request $request)
    {
        return view('admin.badwords.create');
    }

    public function store(Request $request)
    {
        $input = Input::all();
        $word = $input['word'];
        $replacement = $input['replace_to'];
        $v = Validator::make($input, Badwords::rules());
        if($v->fails())
        {
                // redirect our user back with error messages       
                $messages = $v->messages();

                // also redirect them back with old inputs so they dont have to fill out the form again
                // but we wont redirect them with the password they entered
                $request->session()->flash('alert-danger', 'Gagal membuat sensor kata, coba sensor kata yang lain!');
                return Redirect::back()
                    ->withErrors($v)
                    ->withInput();
        }
        else
        {
           try
             {
                DB::beginTransaction();
                Badwords::create($input);

                DB::commit();  
            }
            catch(Exception $e)
            {
                DB::rollback();
                throw new Exception("Error Processing Request", 1);
            }

            $request->session()->flash('alert-info', 'Berhasil, kata "'.$word.'" disensor menjadi "'.$replacement.'" !');
            return redirect('badwords/admin');
        }
    }



}


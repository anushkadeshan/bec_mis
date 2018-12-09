<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
Use App\User;
Use Auth;
use App\Notifications\Activation;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if(Auth::user()->isAdmin==1){
        $users = DB::table('users')->get();
        $roles = DB::table('roles')->get();
        return view('users', ['users' => $users, 'roles' => $roles]);
        }
    else{
        abort(403, 'Unauthorized action.');
    }
    }

    public function userActivate(Request $request){
        if(Auth::user()->isAdmin==1){
        $id = Input::get('id');
        $post = User::findOrFail($id);
        $post->isActive = !$post->isActive;
        $activate= $post->save();
        if(!$activate){
            abort(500, 'Something Error. Data Not inserted');
        }

        else{
            $user = $post;
            $name = $post->name;
            if($post->isActive==null){

            }

            else{
                $user->notify(new Activation($name));
                echo "<script>console.log( 'Debug Objects: " . $name . "' );</script>";
            }
            
        }


        }
       else{
         abort(403, 'Unauthorized action.');
        } 
    }

    public function userDelete(Request $request){
        if(Auth::user()->isAdmin==1){
        $id = Input::get('id');
        $user = User::find($id);
        $user->delete();
    }
        else{
        abort(403, 'Unauthorized action.');
    }
    }

    public function changeRole(Request $request){
        if(Auth::user()->isAdmin==1){
        $id = Input::get('id');
        $isAdmin = Input::get('isAdmin');
        echo("<script>console.log('PHP: ".$isAdmin."');</script>");
        User::findOrFail($id)->update(['isAdmin'=>$isAdmin]);

        }
        else{
        abort(403, 'Unauthorized action.');
    }
    }

    public function ds(Request $request){
        $dsd = DB::connection('mysql2')->select('select * from dsd_office');
        return json_encode($dsd);
    }
}

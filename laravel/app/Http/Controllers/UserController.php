<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
Use App\User;
Use Auth;
use App\Notifications\Activation;
use App\Role;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if(Auth::user()->isAdmin==1){
        $users = User::with('roles')->get(); 
        $roles = DB::table('roles')->get();
        return view('users')->with(['users'=> $users , 'roles' => $roles]);
        
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
        $user_id = Input::get('user_id');
        $role_id = Input::get('role_id');
        echo "<script>console.log( 'Debug Objects: " . $role_id . "' );</script>";
        $inputs = array(
            'user_id' => $user_id,
            'role_id' => $role_id,
        );
        $user = \App\User::find($user_id);
        $user->roles()->sync($role_id);

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

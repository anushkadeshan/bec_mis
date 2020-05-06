<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Auth;
use DB;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Notifications\TaskCreated;

class TodoController extends Controller
{
    public function index(){
    	$tasks = Todo::get();
    	return view('tasks')->with(['tasks'=>$tasks]);
    }

    public function add(Request $request){
    	$data = $request->all();
    	$tasks = Todo::create($data);

    	//send notofications 
        $notifyTo = User::whereHas('roles', function($q){$q->whereIn('slug', [ 'admin' ]);})->get();
        foreach ($notifyTo as $notifyUser) {
            $notifyUser->notify(new TaskCreated($tasks));
        }
    }

     public function update(Request $request){
    	$id = $request->id;
    	$tasks = Todo::find($id);
        $tasks->task = $request->task;
        $tasks->due_date = $request->due_date;
        $tasks->severity = $request->severity;
        $tasks->save();


    }

    public function delete(Request $request)
	    {
	        $id = $request->id;
	        $task = Todo::find($id);
	        $task->delete();
	    }
}

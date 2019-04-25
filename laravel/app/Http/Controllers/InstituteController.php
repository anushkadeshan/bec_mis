<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Institute;
use Illuminate\Support\Facades\Validator;
use App\Notifications\instituteAdd;
use App\User;
use App\Course;
class InstituteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$institutes = Institute::with('courses')->get();
    	return view('Institute.institutes')->with('institutes',$institutes);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
                'name' => 'required|unique:institutes',
                'address' => 'required',
                'phone' => 'required|numeric',
                'location' => 'required',
                'is_registerd' => 'required',
                'type' => 'required',
            ]);
    	if($validator->passes()){
              $added_by = auth()->user()->id;
              $data = $request->all();
              $institute = Institute::create($data+['added_by'=>$added_by]);

              $notifyTo = User::whereHas('roles', function($q){$q->whereIn('slug', ['admin' , 'branch','youth']);})->get();

              foreach ($notifyTo as $notifyUser) {
                     $notifyUser->notify(new instituteAdd($institute));
              }

    	}

    	else{
               return response()->json(['error' => $validator->errors()->all()]);
    	}

    }

    public function update(Request $request){
    	$validator = Validator::make($request->all(),[
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'location' => 'required',
            'is_registerd' => 'required',
            'type' => 'required',

        ]);

        if($validator->passes()){
            $added_by = auth()->user()->id;

            $institute = Institute::find($request->id);
            $institute->name = $request->name;
            $institute->phone = $request->phone;
            $institute->email = $request->email;
            $institute->address = $request->address;
            $institute->contact_person = $request->contact_person;
            $institute->is_registerd = $request->is_registerd;
            $institute->type = $request->type;
            $institute->reg_no = $request->reg_no;
            $institute->added_by = $added_by;

            $institute->save(); 
        }

        else{
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

	public function delete(Request $request)
	    {
	        $id = $request->id;
	        $institute = Institute::find($id);
	        $institute->delete();
	    }

	public function view($id){
		$institute = Institute::where('id',$id)->with('courses')->first();
		//dd($institute->toArray());
        $courses = Course::get();
		return view('Institute.view-institute')->with(['institute'=>$institute , 'courses' => $courses]);
	}   

    public function update_courses(Request $request){
          $course_id = $request->course_id;
          $institute_id = $request->institute_id;

          $institute = \App\Institute::find($institute_id);
          $institute->courses()->sync($course_id);

      } 
}

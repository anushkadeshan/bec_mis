<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Course;
use App\User;
use App\Notifications\courseAdd;
use App\Institute;
use DB;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$courses = Course::get();
      $course_categories = DB::table('course_categories')->get();

    	return view('Courses.courses')->with(['courses'=> $courses, 'course_categories' => $course_categories]);
    }

    public function insert(Request $request){
   			$validator = Validator::make($request->all(),[
                'name' => 'required',
                'duration' => 'required|numeric',
                'course_fee' => 'required|numeric',
                'course_type' => 'required',
                'course_time' => 'required',
                'medium' => 'required',
                'min_qualification' => 'required'
            ]);
    	if($validator->passes()){
              $added_by = auth()->user()->id;
              $medium = json_encode($request->medium);
              if($request->course_type=="Vocational Training"){
              	$standard = "NVQ Level ".$request->standard;
              }
              else{
              	$standard = $request->standard;
              }
              $data = array(
              	'name' => $request->name,
              	'duration' => $request->duration,
              	'course_fee' => $request->course_fee,
              	'course_type' => $request->course_type,
              	'standard' => $standard,
              	'course_time' => $request->course_time,
              	'medium' => $medium,
              	'min_qualification' => $request->min_qualification,
                'course_catogery' => $request->course_catogery,
                'embeded_softs_skills' => $request->embeded_softs_skills,
              	'added_by' => $added_by
              );

              $course = Course::create($data);

              $notifyTo = User::whereHas('roles', function($q){$q->whereIn('slug', ['admin' , 'branch','youth']);})->get();

              foreach ($notifyTo as $notifyUser) {
                     $notifyUser->notify(new courseAdd($course));
              }

    	}

    	else{
            return response()->json(['error' => $validator->errors()->all()]);
    	}
    }

    public function delete(Request $request)
	    {
	        $id = $request->id;
	        $course = Course::find($id);
	        $course->delete(); 
	    }

      public function update(Request $request){
        $validator = Validator::make($request->all(),[
                'name' => 'required',
                'duration' => 'required|numeric',
                'course_fee' => 'required|numeric',
                'course_type' => 'required',
                'course_time' => 'required',
                'medium' => 'required',
                'standard' => 'required',
                'min_qualification' =>'required'
        ]);

        if($validator->passes()){
            $added_by = auth()->user()->id;

              $medium = json_encode($request->medium);
              if($request->course_type=="Vocational Training"){
                $standard = "NVQ Level ".$request->standard;
              }
              else{
                $standard = $request->standard;
              }

            $course = Course::find($request->id);
            $course->name = $request->name;
            $course->duration = $request->duration;
            $course->course_fee = $request->course_fee;
            $course->course_type = $request->course_type;
            $course->course_time = $request->course_time;
            $course->medium = $medium;
            $course->standard = $standard;
            $course->min_qualification = $request->min_qualification;
            $course->course_catogery = $request->course_catogery;
            $course->embeded_softs_skills = $request->embeded_softs_skills;
            $course->added_by = $added_by;

            $course->save(); 
        }

        else{
            return response()->json(['error' => $validator->errors()->all()]);
        }
      }

      public function view($id){
        $course = Course::where('id',$id)->with('institutes')->first();
        $course_catogery = DB::table('course_categories')->whereid($course->course_catogery)->first();
        //dd($course->toArray());
        $institutes = Institute::get();
        return view('Courses.view-course')->with(['course'=>$course, 'institutes' => $institutes,'course_catogery'=>$course_catogery]);
      }

      public function update_institutes(Request $request){
          $course_id = $request->course_id;
          $institute_id = $request->institute_id;

          $course = \App\Course::find($course_id);
          $course->institutes()->sync($institute_id);

          dd($institute_id);
      }

      public function cat(){
        $cat = DB::table('course_categories')->get();
        return view('Courses.add-course-cat')->with('cat',$cat);
      }

      public function addCat(Request $request){
          $course_category = $request->course_category;
          $category = DB::table('course_categories')->insert(['course_category' => $course_category]);
      }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Youth;
use DB;
use Illuminate\Support\Facades\Validator;


class ProgressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cg(Request $request){
    	$id = Input::get('youth_id');
        $cg = Youth::findOrFail($id);
        $cg->cg = !$cg->cg;
        $cg->save();
    }

    public function soft(Request $request){
    	$id = Input::get('youth_id');
        $soft = Youth::findOrFail($id);
        $soft->soft_skills = !$soft->soft_skills;
        $soft->save();
    }

    public function vt(Request $request){
    	$id = Input::get('youth_id');
        $vt = Youth::findOrFail($id);
        $vt->vt = !$vt->vt;
        $vt->save();
    }

    public function prof(Request $request){
    	$id = Input::get('youth_id');
        $prof = Youth::findOrFail($id);
        $prof->prof = !$prof->prof;
        $prof->save();
    }

    public function jobs(Request $request){
    	$id = Input::get('youth_id');
        $jobs = Youth::findOrFail($id);
        $jobs->jobs = !$jobs->jobs;
        $jobs->save();
    }

    public function view($id){

    	$youth = Youth::with('family')->where('id',$id)->first();
    	return view('Progress.view-progress')->with('youth',$youth);
    }

    public function cgList(Request $request){
        if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('career_guidances')
            ->where('date', 'LIKE', "%{$query}%")
            ->get();
          $output = '<ul class="dropdown-menu" id="autocomplete" style="display:block; position:relative">';
          foreach($data as $row)
          {
           $output .= '
           <li id="'.$row->id.'"><a href="#" >'.$row->date.' at '.$row->venue.' in '.$row->ds_division.' </a></li>
           ';
          }
          $output .= '</ul>';
          echo $output;
         }
    }

    
    public function add(Request $request){
        $validator = Validator::make($request->all(),[
                'careerGuidance_id' => 'required',
            ]);
        if($validator->passes()){

              $careerGuidance_id = $request->careerGuidance_id;
              $youth_id = $request->youth_id;
              $branch = DB::table('youths_career_guidances')->insert(['careerGuidance_id' => $careerGuidance_id, 'youth_id' => $youth_id ]);



        }

        else{
               return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    public function softCourseList(Request $request){
        if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('courses')
            ->where('name', 'LIKE', "%{$query}%")->where('course_type', 'Soft Skills')
            ->get();
          $output = '<ul class="dropdown-menu" id="autocomplete1" style="display:block; position:relative">';
          foreach($data as $row)
          {
           $output .= '
           <li id="'.$row->id.'"><a href="#" >'.$row->name.'</a></li>
           ';
          }
          $output .= '</ul>';
          echo $output;
         }
    }

    public function add_soft(Request $request){
        $validator = Validator::make($request->all(),[
                'course_id' => 'required',
                'status' => 'required',
            ]);
        if($validator->passes()){

              $course_id = $request->course_id;
              $status = $request->status;
              $completed_at = $request->completed_at;              
              $youth_id = $request->youth_id;
              $soft_skills = DB::table('youths_courses')->insert(['course_id' => $course_id, 'youth_id' => $youth_id, 'status'=> $status,'completed_at'=> $completed_at ]);
        }

        else{
               return response()->json(['error' => $validator->errors()->all()]);
        }
    }
public function vtCourseList(Request $request){
        if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('courses')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
          $output = '<ul class="dropdown-menu" id="autocomplete2" style="display:block; position:relative">';
          foreach($data as $row)
          {
           $output .= '
           <li id="'.$row->id.'"><a href="#" >'.$row->name.'</a></li>
           ';
          }
          $output .= '</ul>';
          echo $output;
         }
    }

    public function add_vt(Request $request){
        $validator = Validator::make($request->all(),[
                'course_id' => 'required',
                'status' => 'required',
            ]);
        if($validator->passes()){

              $course_id = $request->course_id;
              $status = $request->status;
              $completed_at = $request->completed_at;              
              $youth_id = $request->youth_id;
              $vt = DB::table('youths_courses')->insert(['course_id' => $course_id, 'youth_id' => $youth_id, 'status'=> $status,'completed_at'=> $completed_at ]);

              if(!$vt){
                return response()->json(['error' => 'mysql_error()']);
              }
        }

        else{
               return response()->json(['error' => $validator->errors()->all()]);
        }
    }
} 

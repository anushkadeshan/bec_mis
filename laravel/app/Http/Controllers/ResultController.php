<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Result;
use App\Course;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;

class ResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create_education(Request $request){
      $validator = Validator::make($request->all(),[
                'youth_id' => 'required',
            ]);

            if($validator->passes()){
                $data = $request->all();
                $added_by = auth()->user()->name;
                $results = Result::create($data+['added_by'=> $added_by]);

                $youth_id = $results->youth_id;
                return response()->json(['youth_id' => $youth_id]);

                

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

     public function courseList(Request $request){
        if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('courses')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
          $output = '<ul class="dropdown-menu" id="followed" style="display:block; position:relative">';
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

    public function courseList1(Request $request){
        if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('courses')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
          $output = '<ul class="dropdown-menu" id="following" style="display:block; position:relative">';
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

    public function create_course(Request $request, Course $course){
      $validator = Validator::make($request->all(),[
                'youth_id' => 'required',
            ]);

            if($validator->passes()){
                $data = $request->all();
                $course_id = $request->course_id;
                $youth_id = $request->youth_id;
                $status = $request->status;
                $provided_by_bec = $request->provided_by_bec;
                $completed_at = $request->completed_at;
                $courses = DB::table('youths_courses')->insert(
                    array('course_id' => $course_id, 'youth_id' => $youth_id, 'status' => $status, 'completed_at' => $completed_at, 'provided_by_bec' => $provided_by_bec)
                );    

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

    public function update_results(Request $request){
      $validator = Validator::make($request->all(),[
                
            ]);

            if($validator->passes()){

              $results = Result::find($request->id);
              $results->ol_year = $request->ol_year;
              $results->ol_attempt = $request->ol_attempt;
              $results->ol_pass_or_fail = $request->ol_pass_or_fail;
              $results->al_year = $request->al_year;
              $results->al_attempt = $request->al_attempt;
              $results->al_pass_or_fail = $request->al_pass_or_fail;
              $results->stream = $request->stream;
              $results->degree = $request->degree;
              $results->pass_out_year = $request->pass_out_year;
              $results->medium = $request->medium;
              $results->grade = $request->grade;
              $results->university = $request->university;
              $results->other_professional_qualifications = $request->other_professional_qualifications;
              $results->save();

            }

            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

    
}

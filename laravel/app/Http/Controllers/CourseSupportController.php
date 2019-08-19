<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
class CourseSupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.skill-development.course-support')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function instituesList(Request $request){
    	if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('institutes')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
          $output = '<ul class="dropdown-menu" id="institute" style="display:block; position:relative">';
          foreach($data as $row)
          {
           $output .= '
           <li class="nav-item" id="'.$row->id.'"><a href="#" >'.$row->name.' | '.$row->location.'</a></li>
           ';
          }
          $output .= '</ul>';
          echo $output;
         }
    }

    public function courseList(Request $request){
    	if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('courses')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
          $output = '<ul class="dropdown-menu" id="course" style="display:block; position:relative">';
          foreach($data as $row)
          {
           $output .= '
           <li class="nav-item" id="'.$row->id.'"><a href="#" >'.$row->name.'</a></li>
           ';
          }
          $output .= '</ul>';
          echo $output;
         }
    }

    public function youthList(Request $request){
      $branch_id = auth()->user()->branch;

    	if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('youths')
            ->where('branch_id', '=',$branch_id)
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('nic', 'LIKE', "%{$query}%")
            
            ->get();
          $output = '<ul class="dropdown-menu" id="youths" style="display:block; position:relative">';
          foreach($data as $row)
          {
           $output .= '
           <li class="nav-item" id="'.$row->id.'"><a href="#" >'.$row->name.' | '.$row->nic.'</a></li>
           ';
          }
          $output .= '</ul>';
          echo $output;
         }
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
    		    'program_date'  => 'required',
    		    'total_male'  => 'required',
    		    'total_female'  => 'required',
                'district' => 'required',
                'dm_name' =>'required',	
                'review_report' => 'required',
                'institute_id' => 'required',
                'course_id' => 'required',
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
                
                $data1 = array(
                	'district' => $request->district,
                	'dsd' => $request->dsd,
	                'dm_name' =>$request->dm_name,
	                'title_of_action' =>json_encode($request->title_of_action),  
                    'activity_code' =>json_encode($request->activity_code),	
	                'program_date'	=>$request->program_date,
	                'start_date'=>$request->start_date,
	                'end_date' =>$request->end_date,
	                'institute_id'	=>$request->institute_id,
	                'institutional_review' =>$request->institutional_review,
	                'total_male' => $request->total_male,
	                'total_female'=>$request->total_female,
	                'pwd_male'=>$request->pwd_male,
	                'pwd_female'=>$request->pwd_female,
	                'course_id'=>$request->course_id,
	                'review_report' => $request->review_report,
	                'branch_id'	=> $branch_id,
                  'created_at' => date('Y-m-d H:i:s')
                );

                //insert general data 
                $course_support = DB::table('course_supports')->insert($data1);
                $course_support_id = DB::getPdo()->lastInsertId();

                //insert youths
              	$number = count($request->youth_id);
                if($number>0){
                    for($i=0; $i<$number; $i++){
                        $participants = DB::table('course_supports_youth')->insert(['youth_id'=>$request->youth_id[$i],'nature_of_support'=>$request->nature_of_support[$i],'institute_type'=> $request->institute_type[$i],'course_support_id'=>$course_support_id]);
                    }

                }
                else{
                    return response()->json(['error' => 'Submit youth details.']);
                }
            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    
    }

    public function reviewList(Request $request){

      if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('institutes')
                  ->join('institute_reviews','institute_reviews.institute_id','=','institutes.id')
                  ->where('institutes.name', 'LIKE', "%{$query}%")
                  ->select('institutes.*','institute_reviews.id as ins_id','institute_reviews.*')
                  ->get();
          $output = '<ul class="dropdown-menu" id="review_reports" style="display:block; position:relative">';
          foreach($data as $row)
          {
           $output .= '
           <li class="nav-item" id="'.$row->ins_id.'"><a href="#" >'.$row->name.' | '.$row->district.'</a></li>
           ';
          }
          $output .= '</ul>';
          echo $output;
         }
    }
}

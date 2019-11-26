<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;


class InstituteReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.skill-development.institute-review')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
                'district' => 'required',
                'dm_name' =>'required',	
                'institute_id' => 'required',
                'course_id' => 'required',
                'review_date'=> 'required'
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $data1 = array(
                	'district' => $request->district,
                	'dsd' => $request->dsd,
	                'dm_name' =>$request->dm_name,
	                'title_of_action' =>json_encode($request->title_of_action),  
                    'activity_code' =>json_encode($request->activity_code),	
	                'review_date'	=>$request->review_date,
	                'institute_id'	=>$request->institute_id,
	                'head_of_institute' =>$request->head_of_institute,
	                'contact' => $request->contact,
	                'commencement_date' => $request->commencement_date,
	                'tvec_ex_date' => $request->tvec_ex_date,
	                'ojt_compulsory' => $request->ojt_compulsory,
	                'courses_not_compulsory' => $request->courses_not_compulsory,
	                'followup' => $request->followup,
	                'services_offered'=>json_encode($request->services_offered),
	                'trainee_allowance'=>$request->trainee_allowance,
	                'amount'=>$request->amount,
	                'source' => $request->source,
	                'soft_skill' => $request->soft_skill,
	                'agreement_soft_skill' => $request->agreement_soft_skill,
	                'gaps' => $request->gaps,
	                'branch_id'	=> $branch_id,
	                'created_at' => date('Y-m-d H:i:s')
                );

                //insert general data 
                $institute_reviews = DB::table('institute_reviews')->insert($data1);
                $institute_reviews_id = DB::getPdo()->lastInsertId();

                //insert youths
              	$number = count($request->course_id);
                if($number>0){
                    for($i=0; $i<$number; $i++){
                        $courses = DB::table('institute_review_courses')->insert(['course_id'=>$request->course_id[$i],'period_intake'=>$request->period_intake[$i],'intake_per_batch'=>$request->intake_per_batch[$i],'current_following'=>$request->current_following[$i],'passed_out'=>$request->passed_out[$i],'institute_reviews_id'=>$institute_reviews_id]);
                    }

                    for($i=0; $i<$number; $i++){
                        $courses_instiutes = DB::table('courses_institutes')->insert(['course_id'=>$request->course_id[$i],'institute_id'=>$request->institute_id]);
                    }

                }
                else{
                    return response()->json(['error' => 'Submit course details.']);
                }
            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    
    }

    public function view(){
        $meetings = DB::table('institute_reviews')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','institute_reviews.branch_id')
                      ->get();
        //dd($mentorings);       
        //dd($participants2018);
        $branches = DB::table('branches')->get();

        $institutes = DB::table('institute_reviews')
                   ->join('institutes','institutes.id','=','institute_reviews.institute_id')
                   ->select('institutes.name as institute_name','institutes.*')
                   ->distinct()
                   ->get();
        return view('Activities.Reports.Skill-Development.institute_review')->with(['meetings'=>$meetings,'branches'=>$branches,'institutes'=>$institutes]);
    }

    public function fetch(Request $request){
        if($request->ajax())
        {
            if($request->dateStart != '' && $request->dateEnd != '')
            {
                
                switch (true) {
                  case ($request->branch!=''):
                    $data = DB::table('institute_reviews') 
                      ->join('branches','branches.id','=','institute_reviews.branch_id')
                      ->join('institutes','institutes.id','=','institute_reviews.institute_id')
                      ->whereBetween('review_date', array($request->dateStart, $request->dateEnd))
                      ->where('branch_id',$request->branch)
                      ->select('institute_reviews.*','branches.*','institute_reviews.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','review_date as meeting_date')
                      ->orderBy('review_date', 'desc')
                      ->get();    
                    break;


                  case ($request->branch!='' and $request->institute !=''):
                  $data = DB::table('institute_reviews') 
                    ->join('branches','branches.id','=','institute_reviews.branch_id')
                    ->join('institutes','institutes.id','=','institute_reviews.institute_id')
                    ->whereBetween('review_date', array($request->dateStart, $request->dateEnd))
                    ->where('branch_id',$request->branch)
                    ->where('institute_id',$request->institute)
                    ->select('institute_reviews.*','branches.*','institute_reviews.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','review_date as meeting_date')
                    ->orderBy('review_date', 'desc')
                    ->get();    
                  break;

                

                  case ($request->institute!=''):
                  $data = DB::table('institute_reviews') 
                    ->join('branches','branches.id','=','institute_reviews.branch_id')
                    ->join('institutes','institutes.id','=','institute_reviews.institute_id')
                    ->whereBetween('review_date', array($request->dateStart, $request->dateEnd))
                    ->where('institute_id',$request->institute)
                    ->select('institute_reviews.*','branches.*','institute_reviews.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','review_date as meeting_date')
                    ->orderBy('review_date', 'desc')
                    ->get();    
                  break;

                  default:
                    $data = DB::table('institute_reviews') 
                        ->join('branches','branches.id','=','institute_reviews.branch_id')
                        ->join('institutes','institutes.id','=','institute_reviews.institute_id')
                        ->select('institute_reviews.*','branches.*','institute_reviews.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','review_date as meeting_date')
                        ->whereBetween('review_date', array($request->dateStart, $request->dateEnd))
                        ->select('institute_reviews.*','branches.*','institute_reviews.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','review_date as meeting_date')
                        ->orderBy('review_date', 'desc')
                        ->get();
                    break;
                }
                
            }
        else
            {
                $data = DB::table('institute_reviews') 
                        ->join('branches','branches.id','=','institute_reviews.branch_id')
                        ->join('institutes','institutes.id','=','institute_reviews.institute_id')
                        ->select('institute_reviews.*','branches.*','institute_reviews.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','review_date as meeting_date')
                        ->orderBy('review_date', 'desc')
                        ->get();
            }
                return response()->json($data);
        }
    
        

    }


    public function view_meeting($id){
        $meeting = DB::table('institute_reviews')
                   ->join('branches','branches.id','=','institute_reviews.branch_id')
                   ->join('institutes','institutes.id','=','institute_reviews.institute_id')
                   ->select('institute_reviews.*','branches.*','institute_reviews.id as m_id','institute_reviews.institute_id as i_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','review_date as meeting_date')
                   ->where('institute_reviews.id',$id)
                   ->first();
        $courses = DB::table('institute_review_courses')
                  ->join('courses','courses.id','=','institute_review_courses.course_id')
                  ->where('institute_review_courses.institute_reviews_id',$id)
                  ->get();


       // dd($meeting);
        //dd($participants);

        return response()->json(array(
            'courses' => $courses,
            'meeting' => $meeting,

        ));
        

    }
}

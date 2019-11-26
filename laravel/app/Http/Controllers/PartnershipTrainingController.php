<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Carbon\Carbon;


class PartnershipTrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.skill-development.partner-training')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
    		    'program_date'  => 'required',
                'district' => 'required',
                'dm_name' =>'required',	
                'institute_id' => 'required',
                'course_id' => 'required'
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
            	if($request->hasFile('mou_report')){
	            	$input['mou_report'] = time().'.'.$request->file('mou_report')->getClientOriginalExtension();
	            	$request->mou_report->move(storage_path('activities/files/skill/partner-support/mou_report'), $input['mou_report']);
            	}
            	if($request->hasFile('group_photo')){
	            	$input['group_photo'] = time().'.'.$request->file('group_photo')->getClientOriginalExtension();
	            	$request->group_photo->move(storage_path('activities/files/skill/partner-support/group-photo'), $input['group_photo']);
            	}
                $data1 = array(
                	'district' => $request->district,
                	'dsd' => $request->dsd,
	                'dm_name' =>$request->dm_name,
	                'title_of_action' =>json_encode($request->title_of_action),  
                    'activity_code' =>json_encode($request->activity_code),	
	                'program_date'	=>$request->program_date,
	                'start_date'=>$request->start_date,
	                'end_date' =>$request->end_date,
	                'mou_signed' =>$request->mou_signed,
	                'date_mou_signed' =>$request->date_mou_signed,
	                'institute_id'	=>$request->institute_id,
	                'institutional_review' =>$request->institutional_review,
	                'course_id' => $request->course_id,
	                'bec_contribution' => $request->bec_contribution,
	                'partner_contribution' => $request->partner_contribution,
	                'student_contribution' => $request->student_contribution,
	                'total_cost' => $request->total_cost,
	                'total_male' => $request->total_male,
	                'total_female'=>$request->total_female,
	                'pwd_male'=>$request->pwd_male,
	                'pwd_female'=>$request->pwd_female,
	                'review_report' => $request->review_report,
	                'mou_report' => $input['mou_report'],
	                'group_photo' => $input['group_photo'],
	                'branch_id'	=> $branch_id,
	                'created_at' => date('Y-m-d H:i:s')
                );

                $total_youth = ($request->total_male+$request->total_female);
                $number = count($request->youth_id);
                //echo "<script>console.log('Debug Objects: " . $number . "' );</script>";
                if($total_youth==$number){
                //insert general data 
                $partner_trainings = DB::table('partner_trainings')->insert($data1);
                $partner_trainings_id = DB::getPdo()->lastInsertId();

                //insert youths
                if($number>0){
                    for($i=0; $i<$number; $i++){
                        $youths = DB::table('partner_trainings_youth')->insert(['youth_id'=>$request->youth_id[$i],'approved_amount'=>$request->approved_amount[$i],'partner_trainings_id'=>$partner_trainings_id]);
                    }

                }
                else{
                    return response()->json(['error' => 'Submit youth details.']);
                }
              }
              else{
                    return response()->json(['error' => 'Youth details are mismathced.']);

              }
            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    
    }

    public function view(){
        $meetings = DB::table('partner_trainings')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','partner_trainings.branch_id')
                      ->get();
        //dd($mentorings);

        $participants2018 = DB::table('partner_trainings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2018' )
                        ->first();
                        //->groupBy(function ($val) {
                                // Carbon::parse($val->meeting_date)->format('Y');
                        //});
                        //->groupBy(DB::raw("year(meeting_date)"))
                        
           $participants2019 = DB::table('partner_trainings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2019' )
                        ->first();            
            $participants2020 = DB::table('partner_trainings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2020' )
                        ->first();   
            $participants2021 = DB::table('partner_trainings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2021' )
                        ->first();           
        //dd($participants2018);
        $branches = DB::table('branches')->get();

        $courses = DB::table('partner_trainings')
                   ->join('courses','courses.id','=','partner_trainings.course_id')
                   ->select('courses.name as course_name','courses.*')
                   ->distinct()
                   ->get();
        $institutes = DB::table('partner_trainings')
                   ->join('institutes','institutes.id','=','partner_trainings.institute_id')
                   ->select('institutes.name as institute_name','institutes.*')
                   ->distinct()
                   ->get();
        $today = Carbon::today();
        $ongoing = DB::table('partner_trainings')
                   ->where('end_date', '>', $today->format('Y-m-d'))
                   ->count();

        $contribution = DB::table('partner_trainings')
               ->select(DB::raw("SUM(bec_contribution) as bec"),DB::raw("SUM(partner_contribution) as partner"),DB::raw("SUM(student_contribution) as student"))
               ->first();

        return view('Activities.Reports.Skill-Development.partnership')->with(['meetings'=>$meetings,'branches'=>$branches,'participants2018'=>$participants2018,'participants2019'=>$participants2019,'participants2020'=>$participants2020,'participants2021'=>$participants2021,'courses'=>$courses,'institutes'=>$institutes,'ongoing' => $ongoing,'contribution'=> $contribution]);
    }

     public function fetch(Request $request){
        if($request->ajax())
        {
            if($request->dateStart != '' && $request->dateEnd != '')
            {
                
                switch (true) {
                  case ($request->branch!=''):
                    $data = DB::table('partner_trainings') 
                      ->join('branches','branches.id','=','partner_trainings.branch_id')
                      ->join('institutes','institutes.id','=','partner_trainings.institute_id')
                      ->join('courses','courses.id', '=' ,'partner_trainings.course_id')
                      ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                      ->where('branch_id',$request->branch)
                      ->select('partner_trainings.*','branches.*','partner_trainings.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date')
                      ->orderBy('program_date', 'desc')
                      ->get();    
                    break;

                  case ($request->branch!='' and $request->course!=''):
                  $data = DB::table('partner_trainings') 
                    ->join('branches','branches.id','=','partner_trainings.branch_id')
                    ->join('institutes','institutes.id','=','partner_trainings.institute_id')
                    ->join('courses','courses.id', '=' ,'partner_trainings.course_id')
                    ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                    ->where('branch_id',$request->branch)
                    ->where('course_id',$request->course)
                    ->select('partner_trainings.*','branches.*','partner_trainings.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date')
                    ->orderBy('program_date', 'desc')
                    ->get();    
                  break;

                  case ($request->branch!='' and $request->institute !=''):
                  $data = DB::table('partner_trainings') 
                    ->join('branches','branches.id','=','partner_trainings.branch_id')
                    ->join('institutes','institutes.id','=','partner_trainings.institute_id')
                    ->join('courses','courses.id', '=' ,'partner_trainings.course_id')
                    ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                    ->where('branch_id',$request->branch)
                    ->where('institute_id',$request->institute)
                    ->select('partner_trainings.*','branches.*','partner_trainings.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date')
                    ->orderBy('program_date', 'desc')
                    ->get();    
                  break;

                  case ($request->course!='' and $request->institute !=''):
                  $data = DB::table('partner_trainings') 
                    ->join('branches','branches.id','=','partner_trainings.branch_id')
                    ->join('institutes','institutes.id','=','partner_trainings.institute_id')
                    ->join('courses','courses.id', '=' ,'partner_trainings.course_id')
                    ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                    ->where('course_id',$request->course)
                    ->where('institute_id',$request->institute)
                    ->select('partner_trainings.*','branches.*','partner_trainings.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date')
                    ->orderBy('program_date', 'desc')
                    ->get();    
                  break;

                  case ($request->course!=''):
                  $data = DB::table('partner_trainings') 
                    ->join('branches','branches.id','=','partner_trainings.branch_id')
                    ->join('institutes','institutes.id','=','partner_trainings.institute_id')
                    ->join('courses','courses.id', '=' ,'partner_trainings.course_id')
                    ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                    ->where('course_id',$request->course)
                    ->select('partner_trainings.*','branches.*','partner_trainings.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date')
                    ->orderBy('program_date', 'desc')
                    ->get();    
                  break;

                  case ($request->institute!=''):
                  $data = DB::table('partner_trainings') 
                    ->join('branches','branches.id','=','partner_trainings.branch_id')
                    ->join('institutes','institutes.id','=','partner_trainings.institute_id')
                    ->join('courses','courses.id', '=' ,'partner_trainings.course_id')
                    ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                    ->where('institute_id',$request->institute)
                    ->select('partner_trainings.*','branches.*','partner_trainings.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date')
                    ->orderBy('program_date', 'desc')
                    ->get();    
                  break;

                  case ($request->institute!='' and $request->course !='' and $request->branch !=''):
                  $data = DB::table('partner_trainings') 
                        ->join('branches','branches.id','=','partner_trainings.branch_id')
                        ->join('institutes','institutes.id','=','partner_trainings.institute_id')
                        ->join('courses','courses.id', '=' ,'partner_trainings.course_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('branch_id',$request->branch)
                        ->where('institute_id',$request->institute)
                        ->where('course_id',$request->course)
                        ->select('partner_trainings.*','branches.*','partner_trainings.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date')
                        ->orderBy('program_date', 'desc')
                        ->get();    
                  break;
                  default:
                    $data = DB::table('partner_trainings') 
                        ->join('branches','branches.id','=','partner_trainings.branch_id')
                        ->join('institutes','institutes.id','=','partner_trainings.institute_id')
                        ->join('courses','courses.id', '=' ,'partner_trainings.course_id')
                        ->select('partner_trainings.*','branches.*','partner_trainings.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->select('partner_trainings.*','branches.*','partner_trainings.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date')
                        ->orderBy('program_date', 'desc')
                        ->get();
                    break;
                }
                
            }
        else
            {
                $data = DB::table('partner_trainings') 
                        ->join('branches','branches.id','=','partner_trainings.branch_id')
                        ->join('institutes','institutes.id','=','partner_trainings.institute_id')
                        ->join('courses','courses.id', '=' ,'partner_trainings.course_id')
                        ->select('partner_trainings.*','branches.*','partner_trainings.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date')
                        ->orderBy('program_date', 'desc')
                        ->get();
            }
                return response()->json($data);
        }
    
        

    }

     public function view_meeting($id){
        $meeting = DB::table('partner_trainings')
                   ->join('branches','branches.id','=','partner_trainings.branch_id')
                   ->join('institutes','institutes.id','=','partner_trainings.institute_id')
                   ->join('courses','courses.id', '=' ,'partner_trainings.course_id')
                   ->select('partner_trainings.*','branches.*','partner_trainings.id as m_id','partner_trainings.course_id as c_id','partner_trainings.institute_id as i_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date')
                   ->where('partner_trainings.id',$id)
                   ->first();
        $youths = DB::table('partner_trainings_youth')
                  ->join('youths','youths.id','=','partner_trainings_youth.youth_id')
                  ->where('partner_trainings_youth.partner_trainings_id',$id)
                  ->get();


       // dd($meeting);
        //dd($participants);

        return response()->json(array(
            'youths' => $youths,
            'meeting' => $meeting,

        ));
        

    }

    public function download($file_name){
        //$file_name = $request->attendance;
        $file = storage_path('activities/files/skill/partner-support/mou_report/'.$file_name.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'application/pdf',
                  'Content-Type' => 'application/msword',
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }

    public function group($file_name){
        //$file_name = $request->attendance;
        $file = storage_path('activities/files/skill/partner-support/group-photo/'.$file_name.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'image/jpeg',
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }

}

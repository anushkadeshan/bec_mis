<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\URL;
use App\Audit;
use App\User;
use App\Notifications\CompletionReport;

class FinancialSupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.skill-development.finacial-support')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
    		    'program_date'  => 'required',
    		    'total_male'  => 'required',
    		    'total_female'  => 'required',
                'district' => 'required',
                'dm_name' =>'required',	
                'review_report' => 'required',
                'mou_report' => 'mimes:jpeg,jpg,png,gif,svg,pdf',
                'institute_id' => 'required',
                'course_id' => 'required'
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
            	if($request->hasFile('mou_report')){
	            	$input['mou_report'] = time().'.'.$request->file('mou_report')->getClientOriginalExtension();
	            	$request->mou_report->move(storage_path('activities/files/skill/finacial-support/mou_report'), $input['mou_report']);
            	}
                $data1 = array(
                	'district' => $request->district,
                	'dsd' => $request->dsd,
	                'dm_name' =>$request->dm_name,
	                'title_of_action' =>$request->title_of_action,  
                    'activity_code' =>$request->activity_code,	
	                'program_date'	=>$request->program_date,
	                'start_date'=>$request->start_date,
	                'end_date' =>$request->end_date,
	                'institute_id'	=>$request->institute_id,
	                'institutional_review' =>$request->institutional_review,
	                'course_id' => $request->course_id,
	                'cost' => $request->cost,
	                'total_male' => $request->total_male,
	                'total_female'=>$request->total_female,
	                'pwd_male'=>$request->pwd_male,
	                'pwd_female'=>$request->pwd_female,
	                'review_report' => $request->review_report,
	                'mou_report' => $input['mou_report'],
	                'branch_id'	=> $branch_id,
                    'created_at' => date('Y-m-d H:i:s')
                );

                $total_youth = ($request->total_male+$request->total_female);
                $number = count($request->youth_id);
                //echo "<script>console.log('Debug Objects: " . $number . "' );</script>";
                if($total_youth==$number){

                //insert general data 
                $finacial_supports = DB::table('finacial_supports')->insert($data1);
                $finacial_support_id = DB::getPdo()->lastInsertId();

                //insert youths
                if($number>0){
                    for($i=0; $i<$number; $i++){
                        $participants = DB::table('finacial_supports_youths')->insert(['youth_id'=>$request->youth_id[$i],'approved_amount'=>$request->approved_amount[$i],'installments'=>$request->installments[$i],'finacial_support_id'=>$finacial_support_id]);
                    }

                }
                else{
                    return response()->json(['error' => 'Submit youth details.']);
                }
              }
              else{
                    return response()->json(['error' => 'Youth details are mismatched.']);

              }

              $audit = array(
                    'user_type' => 'App\User',
                    'user_id' => Auth::user()->id,
                    'event' => 'created',
                    'auditable_type' => 'finacial_supports',
                    'auditable_id' => $finacial_support_id,
                    'url' => url()->current(),
                    'ip_address' => request()->ip(),
                    'user_agent' => $request->header('User-Agent'),

                );

                $reports = Audit::create($audit);

                $notifyTo = User::whereHas('roles', function($q){$q->whereIn('slug', ['me', 'admin','management' ]);})->get();
                foreach ($notifyTo as $notifyUser) {
                    $notifyUser->notify(new CompletionReport($reports));
                }
            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    
    }

    public function view(){
        $meetings = DB::table('finacial_supports')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','finacial_supports.branch_id')
                      ->get();
        //dd($mentorings);

        $participants2018 = DB::table('finacial_supports')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2018' )
                        ->first();
                        //->groupBy(function ($val) {
                                // Carbon::parse($val->meeting_date)->format('Y');
                        //});
                        //->groupBy(DB::raw("year(meeting_date)"))
                        
           $participants2019 = DB::table('finacial_supports')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2019' )
                        ->first();            
            $participants2020 = DB::table('finacial_supports')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2020' )
                        ->first();   
            $participants2021 = DB::table('finacial_supports')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2021' )
                        ->first();           
        //dd($participants2018);
        $branches = DB::table('branches')->get();

        $courses = DB::table('finacial_supports')
                   ->join('courses','courses.id','=','finacial_supports.course_id')
                   ->select('courses.name as course_name','courses.*')
                   ->distinct()
                   ->get();
        $institutes = DB::table('finacial_supports')
                   ->join('institutes','institutes.id','=','finacial_supports.institute_id')
                   ->select('institutes.name as institute_name','institutes.*')
                   ->distinct()
                   ->get();
        $today = Carbon::today();
        $ongoing = DB::table('finacial_supports')
                   ->where('end_date', '>', $today->format('Y-m-d'))
                   ->count();
        return view('Activities.Reports.Skill-Development.financial')->with(['meetings'=>$meetings,'branches'=>$branches,'participants2018'=>$participants2018,'participants2019'=>$participants2019,'participants2020'=>$participants2020,'participants2021'=>$participants2021,'courses'=>$courses,'institutes'=>$institutes,'ongoing' => $ongoing]);
    }

     public function fetch(Request $request){
        if($request->ajax())
        {
            $branch_id = Auth::user()->branch;
            
            if($request->dateStart != '' && $request->dateEnd != '')
            {

                  if($request->branch!=''){
                    $data = DB::table('finacial_supports') 
                      ->join('branches','branches.id','=','finacial_supports.branch_id')
                      ->join('institutes','institutes.id','=','finacial_supports.institute_id')
                      ->join('courses','courses.id', '=' ,'finacial_supports.course_id')
                      ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                      ->where('branch_id',$request->branch)
                      ->select('finacial_supports.*','branches.*','finacial_supports.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date')
                      ->orderBy('program_date', 'desc')
                      ->get();    
                   }

                   else{

                   if(is_null($branch_id)){
                    $data = DB::table('finacial_supports') 
                        ->join('branches','branches.id','=','finacial_supports.branch_id')
                        ->join('institutes','institutes.id','=','finacial_supports.institute_id')
                        ->join('courses','courses.id', '=' ,'finacial_supports.course_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->select('finacial_supports.*','branches.*','finacial_supports.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date')
                        ->orderBy('program_date', 'desc')
                        ->get();
                    }
                    else{
                      $data = DB::table('finacial_supports') 
                        ->join('branches','branches.id','=','finacial_supports.branch_id')
                        ->join('institutes','institutes.id','=','finacial_supports.institute_id')
                        ->join('courses','courses.id', '=' ,'finacial_supports.course_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('finacial_supports.branch_id','=',$branch_id)
                        ->select('finacial_supports.*','branches.*','finacial_supports.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date')
                        ->orderBy('program_date', 'desc')
                        ->get();
                    }
                  }
                
                
            }
        else
            {
                if(is_null($branch_id)){
                
                $data = DB::table('finacial_supports') 
                        ->join('branches','branches.id','=','finacial_supports.branch_id')
                        ->join('institutes','institutes.id','=','finacial_supports.institute_id')
                        ->join('courses','courses.id', '=' ,'finacial_supports.course_id')
                        ->select('finacial_supports.*','branches.*','finacial_supports.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date')
                        ->orderBy('program_date', 'desc')
                        ->get();
                }
                else{
                  $data = DB::table('finacial_supports') 
                        ->join('branches','branches.id','=','finacial_supports.branch_id')
                        ->join('institutes','institutes.id','=','finacial_supports.institute_id')
                        ->join('courses','courses.id', '=' ,'finacial_supports.course_id')
                        ->where('finacial_supports.branch_id','=',$branch_id)
                        ->select('finacial_supports.*','branches.*','finacial_supports.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date')                        
                        ->orderBy('program_date', 'desc')
                        ->get();
                }
            }
                return response()->json($data);
        }
    
        

    }

     public function view_meeting($id){
        $meeting = DB::table('finacial_supports')
                   ->join('branches','branches.id','=','finacial_supports.branch_id')
                   ->join('institutes','institutes.id','=','finacial_supports.institute_id')
                   ->join('courses','courses.id', '=' ,'finacial_supports.course_id')
                   ->select('finacial_supports.*','branches.*','finacial_supports.id as m_id','finacial_supports.course_id as c_id','finacial_supports.institute_id as i_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date')
                   ->where('finacial_supports.id',$id)
                   ->first();
        $youths = DB::table('finacial_supports_youths')
                  ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                  ->where('finacial_supports_youths.finacial_support_id',$id)
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
        $file = storage_path('activities/files/skill/finacial-support/mou_report/'.$file_name.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'application/pdf',
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }

    public function edit($id){

       $meeting = DB::table('finacial_supports')
                   ->join('branches','branches.id','=','finacial_supports.branch_id')
                   ->join('institutes','institutes.id','=','finacial_supports.institute_id')
                   ->join('courses','courses.id', '=' ,'finacial_supports.course_id')
                   ->join('dsd_office','dsd_office.ID','=','finacial_supports.dsd')
                   ->select('finacial_supports.*','branches.*','finacial_supports.id as m_id','finacial_supports.course_id as c_id','finacial_supports.institute_id as i_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','courses.*','courses.name as course_name','program_date as meeting_date','dsd_office.*')
                   ->where('finacial_supports.id',$id)
                   ->first();

        $youths = DB::table('finacial_supports_youths')
                  ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                  ->select('finacial_supports_youths.*','finacial_supports_youths.id as f_id','youths.*')
                  ->where('finacial_supports_youths.finacial_support_id',$id)
                  ->get();

        return view ('Activities.skill-development.edit.financial')->with(['meeting'=> $meeting,'youths'=>$youths]);

    }

     public function update(Request $request){

        $validator = Validator::make($request->all(),[
                'program_date'  =>'required',
                
            ]);

        if($validator->passes()){
        // echo "<script>console.log( 'Debug Objects: " . $meeting_date . "' );</script>";

        $data1 = array(   
            'program_date'  =>$request->program_date,
            'start_date'=>$request->start_date,
            'end_date' =>$request->end_date,
            'institute_id'  =>$request->institute_id,
            'institutional_review' =>$request->institutional_review,
            'course_id' => $request->course_id,
            'cost' => $request->cost,
            'total_male' => $request->total_male,
            'total_female'=>$request->total_female,
            'pwd_male'=>$request->pwd_male,
            'pwd_female'=>$request->pwd_female,
        );
        //dd($data1);
        DB::table('finacial_supports')->whereid($request->m_id)->update($data1);

        $audit = array(
            'user_type' => 'App\User',
            'user_id' => Auth::user()->id,
            'event' => 'updated',
            'auditable_type' => 'finacial_supports',
            'auditable_id' => $request->m_id,
            'url' => url()->current(),
            'ip_address' => request()->ip(),
            'user_agent' => $request->header('User-Agent'),

        );

        $reports = Audit::create($audit);
    }


    

    else{
        return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    public function update_youths(Request $request){

        $participants = DB::table('finacial_supports_youths')
                        ->whereid($request->id_p)
                        ->update(['approved_amount'=>$request->approved_amount,'installments'=>$request->installments]);

    }

    public function add_youth(Request $request){

        $participants = DB::table('finacial_supports_youths')
                        ->insert(['youth_id'=>$request->youth_id,'approved_amount'=>$request->approved_amount,'installments'=> $request->installments,'finacial_support_id' => $request->m_id]);

    }
}

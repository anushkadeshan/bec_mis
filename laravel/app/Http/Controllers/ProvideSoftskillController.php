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

class ProvideSoftskillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.skill-development.provide-soft-skills')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
    		    'program_date'  => 'required',
    		    'total_male'  => 'required',
    		    'total_female'  => 'required',
                'district' => 'required',
                'dm_name' =>'required',	
                'training_stage' =>'required',	
                'mou_signed' =>'required',	
                'review_report' => 'required',
                'mou_report' => 'mimes:jpeg,jpg,png,gif,svg,pdf',
                'institute_id' => 'required',
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
                $input['mou_report'] = time().'.'.$request->file('mou_report')->getClientOriginalExtension();
            	
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
	                'mou_signed' => $request->mou_signed,
	                'training_stage' => $request->training_stage,
	                'date_signed' => $request->date_signed,
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
                    if($request->hasFile('mou_report')){
                    $input['mou_report'] = time().'.'.$request->file('mou_report')->getClientOriginalExtension();
                    $request->mou_report->move(storage_path('activities/files/skill/provide-soft-skills/mou_report'), $input['mou_report']);
                    }
                    //insert general data 
                    $provide_soft = DB::table('provide_soft_skills')->insert($data1);
                    $provide_softskill_id = DB::getPdo()->lastInsertId();

                    //insert youths

                    if($number>0){
                        for($i=0; $i<$number; $i++){
                            $participants = DB::table('provide_soft_skills_youths')->insert(['youth_id'=>$request->youth_id[$i],'provide_softskill_id'=>$provide_softskill_id,'created_at' => date('Y-m-d H:i:s')]);
                        }

                    }
                    else{
                        return response()->json(['error' => 'Submit youth details.']);
                    }
                }
                else{
                    return response()->json(['error' => 'Youth Details are Mismatched. Please check and try again']);
                }

                $audit = array(
                    'user_type' => 'App\User',
                    'user_id' => Auth::user()->id,
                    'event' => 'created',
                    'auditable_type' => 'provide_soft_skills',
                    'auditable_id' => $provide_softskill_id,
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
        $branch_id = Auth::user()->branch;
        if(is_null($branch_id)){
        $meetings = DB::table('provide_soft_skills')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                      ->get();                      

        //dd($mentorings);

        $participants2018 = DB::table('provide_soft_skills')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2018' )
                        ->first();
                        //->groupBy(function ($val) {
                                // Carbon::parse($val->meeting_date)->format('Y');
                        //});
                        //->groupBy(DB::raw("year(meeting_date)"))
                        
           $participants2019 = DB::table('provide_soft_skills')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2019' )
                        ->first();            
            $participants2020 = DB::table('provide_soft_skills')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2020' )
                        ->first();   
            $participants2021 = DB::table('provide_soft_skills')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2021' )
                        ->first();           
        //dd($participants2018);
        $branches = DB::table('branches')->get();

        $institutes = DB::table('provide_soft_skills')
                   ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                   ->select('institutes.name as institute_name','institutes.*')
                   ->distinct()
                   ->get();
        $today = Carbon::today();
        $ongoing = DB::table('provide_soft_skills')
                   ->where('end_date', '>', $today->format('Y-m-d'))
                   ->count();
        }
        else{
            $meetings = DB::table('provide_soft_skills')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                      ->where('provide_soft_skills.branch_id','=',$branch_id)
                      ->get();
        //dd($mentorings);

        $participants2018 = DB::table('provide_soft_skills')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2018' )
                        ->where('provide_soft_skills.branch_id','=',$branch_id)
                        ->first();
                        //->groupBy(function ($val) {
                                // Carbon::parse($val->meeting_date)->format('Y');
                        //});
                        //->groupBy(DB::raw("year(meeting_date)"))
                        
           $participants2019 = DB::table('provide_soft_skills')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2019' )
                        ->where('provide_soft_skills.branch_id','=',$branch_id)
                        ->first();            
            $participants2020 = DB::table('provide_soft_skills')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2020' )
                        ->where('provide_soft_skills.branch_id','=',$branch_id)
                        ->first();   
            $participants2021 = DB::table('provide_soft_skills')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2021' )
                        ->where('provide_soft_skills.branch_id','=',$branch_id)
                        ->first();           
        //dd($participants2018);
        $branches = DB::table('branches')->get();

        $institutes = DB::table('provide_soft_skills')
                   ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                   ->select('institutes.name as institute_name','institutes.*')
                   ->where('provide_soft_skills.branch_id','=',$branch_id)
                   ->distinct()
                   ->get();
        $today = Carbon::today();
        $ongoing = DB::table('provide_soft_skills')
                   ->where('end_date', '>', $today->format('Y-m-d'))
                    ->where('provide_soft_skills.branch_id','=',$branch_id)
                   ->count();
        }
        
        return view('Activities.Reports.Skill-Development.soft-skill')->with(['meetings'=>$meetings,'branches'=>$branches,'participants2018'=>$participants2018,'participants2019'=>$participants2019,'participants2020'=>$participants2020,'participants2021'=>$participants2021,'institutes'=>$institutes,'ongoing' => $ongoing]);
    }

    public function fetch(Request $request){
        if($request->ajax())
        {
            $branch_id = Auth::user()->branch;
            if($request->dateStart != '' && $request->dateEnd != '')
            {
                
                  if($request->branch!=''){
                    $data = DB::table('provide_soft_skills') 
                      ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                      ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                      ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                      ->where('provide_soft_skills.branch_id',$request->branch)
                      ->select('provide_soft_skills.*','branches.*','provide_soft_skills.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date')
                      ->orderBy('program_date', 'desc')
                      ->get();    
                  }
                  else{
                    if(is_null($branch_id)){
                    $data = DB::table('provide_soft_skills') 
                        ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                        ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                        ->select('provide_soft_skills.*','branches.*','provide_soft_skills.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->orderBy('program_date', 'desc')
                        ->get();
                    }
                    else{
                        $data = DB::table('provide_soft_skills') 
                        ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                        ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                        ->select('provide_soft_skills.*','branches.*','provide_soft_skills.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('provide_soft_skills.branch_id','=',$branch_id)
                        ->orderBy('program_date', 'desc')
                        ->get();
                    }
                  }
                
            }
        else
            {
                
                $branch_id = Auth::user()->branch;
                if(is_null($branch_id)){
                $data = DB::table('provide_soft_skills') 
                        ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                        ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                        ->select('provide_soft_skills.*','branches.*','provide_soft_skills.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date')
                        ->orderBy('program_date', 'desc')
                        ->get();
                }
                else{
                    $data = DB::table('provide_soft_skills') 
                        ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                        ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                        ->select('provide_soft_skills.*','branches.*','provide_soft_skills.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date')
                        ->where('provide_soft_skills.branch_id','=',$branch_id)
                        ->orderBy('program_date', 'desc')
                        ->get();
                }
            }
                return response()->json($data);
        }
    
        

    }

    public function view_meeting($id){
        $meeting = DB::table('provide_soft_skills')
                   ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                   ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                   ->select('provide_soft_skills.*','branches.*','provide_soft_skills.id as m_id','provide_soft_skills.institute_id as i_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date')
                   ->where('provide_soft_skills.id',$id)
                   ->first();
        $youths = DB::table('provide_soft_skills_youths')
                  ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                  ->where('provide_soft_skills_youths.provide_softskill_id',$id)
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
        $file = storage_path('activities/files/skill/provide-soft-skills/mou_report/'.$file_name.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'application/pdf',
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }

    public function edit($id){

       $meeting = DB::table('provide_soft_skills')
                   ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                   ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                   ->join('dsd_office','dsd_office.ID','=','provide_soft_skills.dsd')
                   ->select('provide_soft_skills.*','branches.*','provide_soft_skills.id as m_id','provide_soft_skills.institute_id as i_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date','dsd_office.*')
                   ->where('provide_soft_skills.id',$id)
                   ->first();

        $youths = DB::table('provide_soft_skills_youths')
                  ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                  ->where('provide_soft_skills_youths.provide_softskill_id',$id)
                  ->get();

        return view ('Activities.skill-development.edit.soft-sklls')->with(['meeting'=> $meeting,'youths'=>$youths]);

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
            'mou_signed' => $request->mou_signed,
            'training_stage' => $request->training_stage,
            'date_signed' => $request->date_signed,
            'cost' => $request->cost,
            'total_male' => $request->total_male,
            'total_female'=>$request->total_female,
            'pwd_male'=>$request->pwd_male,
            'pwd_female'=>$request->pwd_female,
        );
        //dd($data1);
        DB::table('provide_soft_skills')->whereid($request->m_id)->update($data1);

        $audit = array(
            'user_type' => 'App\User',
            'user_id' => Auth::user()->id,
            'event' => 'updated',
            'auditable_type' => 'provide_soft_skills',
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

    public function add_youth(Request $request){

        $participants = DB::table('provide_soft_skills_youths')
                        ->insert(['youth_id'=>$request->youth_id,'provide_softskill_id' => $request->m_id]);

    }

    public function view_youths(){
        $branch_id = Auth::user()->branch;
        if(is_null($branch_id)){
        $cg_youths = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                    ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                    ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                    ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                    ->select('provide_soft_skills.*','branches.*','provide_soft_skills.id as m_id','provide_soft_skills.institute_id as i_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date','youths.name as youth_name','provide_soft_skills_youths.*')
                    ->get();
        }
        else{
            $cg_youths = DB::table('provide_soft_skills_youths')
                    ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                    ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                    ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                    ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                    ->select('provide_soft_skills.*','branches.*','provide_soft_skills.id as m_id','provide_soft_skills.institute_id as i_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date','youths.name as youth_name','provide_soft_skills_youths.*')
                    ->where('provide_soft_skills.branch_id',$branch_id)
                    ->get();
        }

        return view('Activities.Reports.Skill-Development.soft-youth')->with(['youths'=>$cg_youths]);
    }
}

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
                            if($request->end_date > date("Y-m-d")){
                                $last_id = DB::getPdo()->lastInsertId();
                                DB::table('provide_soft_skills_youths')->where('id',$last_id)->update(['current_status'=> 1]);
                                DB::table('finacial_supports_youths')->where('youth_id', $request->youth_id[$i])->update(['current_status' => 7]);
                                DB::table('course_supports_youth')->where('youth_id', $request->youth_id[$i])->update(['current_status' => 7]);
                            }
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

         //Current Status
        $youths = DB::table('provide_soft_skills_youths')
                  ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                  ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                  ->join('families','families.id','=','youths.family_id')
                  ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                  ->select('families.*','provide_soft_skills_youths.*','branches.*','youths.*','youths.name as youth_name','provide_soft_skills.*','provide_soft_skills_youths.current_status as cs')
                  ->get();


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

        //Current Status
        $youths = DB::table('provide_soft_skills_youths')
                  ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                  ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                  ->join('families','families.id','=','youths.family_id')
                  ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                  ->where('provide_soft_skills.branch_id','=',$branch_id)
                  ->select('families.*','provide_soft_skills_youths.*','branches.*','youths.*','youths.name as youth_name','provide_soft_skills.*','provide_soft_skills_youths.current_status as cs')
                  ->get();
        }

        return view('Activities.Reports.Skill-Development.soft-skill')->with(['meetings'=>$meetings,'branches'=>$branches,'participants2018'=>$participants2018,'participants2019'=>$participants2019,'participants2020'=>$participants2020,'participants2021'=>$participants2021,'institutes'=>$institutes,'ongoing' => $ongoing,'youths'=>$youths]);
    }

    public function fetch(Request $request){
        $today = Carbon::today();
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

                    $summary = DB::table('provide_soft_skills_youths')
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                        ->select('branches.name', 'provide_soft_skills.*','gender',DB::raw('COUNT(DISTINCT provide_soft_skills_youths.provide_softskill_id) as progs'),DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN provide_soft_skills_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN provide_soft_skills_youths.youth_id END ) ) AS female"), DB::raw("COUNT( ( CASE WHEN dropout = '1' THEN provide_soft_skills_youths.youth_id END ) ) AS dropout"), DB::raw('sum(DISTINCT provide_soft_skills.cost) as total_cost'), DB::raw('COUNT( ( CASE WHEN provide_soft_skills.end_date > CURDATE() THEN  provide_softskill_id END)) as status'))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('provide_soft_skills.branch_id',$request->branch)
                        ->groupBy('provide_soft_skills.branch_id')
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

                    $summary = DB::table('provide_soft_skills_youths')
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                        ->select('branches.name', 'provide_soft_skills.*','gender',DB::raw('COUNT(DISTINCT provide_soft_skills_youths.provide_softskill_id) as progs'),DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN provide_soft_skills_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN provide_soft_skills_youths.youth_id END ) ) AS female"), DB::raw("COUNT( ( CASE WHEN dropout = '1' THEN provide_soft_skills_youths.youth_id END ) ) AS dropout"), DB::raw('sum(DISTINCT provide_soft_skills.cost) as total_cost'), DB::raw('COUNT( ( CASE WHEN provide_soft_skills.end_date > CURDATE() THEN  provide_softskill_id END)) as status'))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->groupBy('provide_soft_skills.branch_id')
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

                $summary = DB::table('provide_soft_skills_youths')
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                        ->select('branches.name', 'provide_soft_skills.*','gender',DB::raw('COUNT(DISTINCT provide_soft_skills_youths.provide_softskill_id) as progs'),DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN provide_soft_skills_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN provide_soft_skills_youths.youth_id END ) ) AS female"), DB::raw("COUNT( ( CASE WHEN dropout = '1' THEN provide_soft_skills_youths.youth_id END ) ) AS dropout"), DB::raw('sum(DISTINCT provide_soft_skills.cost) as total_cost'), DB::raw('COUNT( ( CASE WHEN provide_soft_skills.end_date > CURDATE() THEN  provide_softskill_id END)) as status'))
                        ->groupBy('provide_soft_skills.branch_id')
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

                    $summary = null;
                }
            }
                return response()->json(array(
                    'data' => $data,
                    'summary' => $summary
                ));
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
                  ->select('provide_soft_skills_youths.*','provide_soft_skills_youths.id as c_id','youths.*')
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

        if($request->edate > date("Y-m-d")){
            $current_status = 1;
        }
        else{
            $current_status = null;
        }
        /*
        $youths = DB::table('provide_soft_skills_youths')
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->where('end_date','>', date("Y-m-d"))
                        ->select('provide_soft_skills_youths.*','provide_soft_skills.end_date as end_date')
                        ->get();
        //dd($youths);
        foreach ($youths as $y ) {
            DB::table('provide_soft_skills_youths')->where('id',$y->id)->update(['current_status'=>1]);
        }
        */
        $participants = DB::table('provide_soft_skills_youths')
                        ->insert(['youth_id'=>$request->youth_id,'provide_softskill_id' => $request->m_id,'current_status'=> $current_status]);
        if ($request->edate > date("Y-m-d")) {
            $q = DB::table('finacial_supports_youths')->where('youth_id', $request->youth_id)->update(['current_status' => 7]);
            $query = DB::table('course_supports_youth')->where('youth_id', $request->youth_id)->update(['current_status' => 7]);
        }

    }

    public function update_youths(Request $request){

        $participants = DB::table('provide_soft_skills_youths')
                        ->whereid($request->id_p)
                        ->update(['dropout'=>$request->dropout,'reoson_to_dropout'=> $request->reoson_to_dropout]);

    }


    public function view_youths(){
        $branch_id = Auth::user()->branch;
        if(is_null($branch_id)){
        $cg_youths = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                    ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                    ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                    ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                    ->select('provide_soft_skills.*','branches.*','provide_soft_skills.id as m_id','provide_soft_skills.institute_id as i_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date','youths.name as youth_name','provide_soft_skills_youths.*','youths.nic as nic')
                    ->get();
        $institutes = DB::table('provide_soft_skills')
                   ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                   ->select('institutes.name as institute_name')
                   ->distinct()
                   ->get();

        }
        else{
            $cg_youths = DB::table('provide_soft_skills_youths')
                    ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                    ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                    ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                    ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                    ->select('provide_soft_skills.*','branches.*','provide_soft_skills.id as m_id','provide_soft_skills.institute_id as i_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date','youths.name as youth_name','provide_soft_skills_youths.*','youths.nic as nic')
                    ->where('provide_soft_skills.branch_id',$branch_id)
                    ->get();

            $institutes = DB::table('provide_soft_skills')
                   ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                   ->select('institutes.name as institute_name')
                   ->where('provide_soft_skills.branch_id',$branch_id)
                   ->distinct()
                   ->get();
        }
        $branches = DB::table('branches')->get();


        return view('Activities.Reports.Skill-Development.soft-youth')->with(['youths'=>$cg_youths,'branches'=> $branches,'institutes' => $institutes]);
    }

    public function youths_course_finished($branch,$date){
        $youths = DB::table('provide_soft_skills_youths')
                    ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                    ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                    ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                    ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                    ->select('provide_soft_skills.*','branches.*','provide_soft_skills.id as m_id','provide_soft_skills.institute_id as i_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date','youths.name as youth_name','provide_soft_skills_youths.*')
                    ->where('provide_soft_skills.end_date',$date)
                    ->where('provide_soft_skills.branch_id',$branch)
                    ->get();
        //dd($youths);
        return view('mail-notifications.soft-finished')->with(['youths'=>$youths]);
    }

    public function not_in_job($branch, $date){
        $placements = DB::table('placements_youths')
                  ->pluck('youth_id')->toArray();

        $individual = DB::table('placement_individual')
                  ->pluck('youth_id')->toArray();

        $youths = array_merge($placements,$individual);

        $not_placed = DB::table('provide_soft_skills_youths')
                    ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                    ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                    ->join('branches','branches.id','=','provide_soft_skills.branch_id')
                    ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                    ->where('end_date', '<', $date)
                    ->select('provide_soft_skills_youths.dropout as dropout','provide_soft_skills.*','branches.*','provide_soft_skills.id as m_id','provide_soft_skills.institute_id as i_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','youths.name as youth_name','youths.id as youth_id','youths.phone as youth_phone')
                    ->where('provide_soft_skills.branch_id',$branch)
                    ->whereNotIn('youth_id', $youths)
                    ->get();
        //dd($not_placed);
        return view('mail-notifications.soft_whereNotInJob')->with(['youths'=>$not_placed]);
    }

    public function change_current_status($value,$id){

        switch ($value) {
            case 1:
                return response()->json(['msg' => 'Sorry. You Can not Select This Status. Youth has already finished the course. ', 'code' => '401']);
                break;
            case 2:
                return response()->json(['msg' => 'Sorry. You Can not Select This Status. System automatically set it when youth in a course that we supported ', 'code' => '401']);
                break;
            case 3:
                return response()->json(['msg' => 'Successfully Updated Status. ', 'code' => '200']);
                break;
            case 4:
                return response()->json(['msg' => 'Sorry. You Can not Select This Status. System will automatically set this when youth are placed in job ', 'code' => '401']);
                break;
            case 5:
                $query = DB::table('provide_soft_skills_youths')->where('youth_id',$id)->update(['current_status'=>$value]);
                if($query){
                    return response()->json(['msg' => 'Successfully Updated Status. ', 'code' => '200']);
                }
                break;
            case 6:
                $query = DB::table('provide_soft_skills_youths')->where('youth_id',$id)->update(['current_status'=>$value]);
                if($query){
                    return response()->json(['msg' => 'Successfully Updated Status. ', 'code' => '200']);
                }
                break;
            case 7:
                $query = DB::table('provide_soft_skills_youths')->where('youth_id',$id)->update(['current_status'=>$value]);
                if($query){
                    return response()->json(['msg' => 'Successfully Updated Status. ', 'code' => '200']);
                }
                break;
            default:
                # code...
                break;
        }
    }

    public function add_status_course(Request $request)
    {
        $query = DB::table('provide_soft_skills_youths')->where('youth_id',$request->youth_id)->update(['current_status'=>3,'following_course_id'=>$request->following_course_id,'following_course_end_date'=> $request->following_course_end_date]);
        dd($query,$request->all());
        if($query){
            return response()->json(['msg' => 'Successfully Updated Status. ', 'code' => '200']);
        }
    }
}

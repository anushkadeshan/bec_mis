<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\URL;
use App\Audit;
use App\User;
use App\Notifications\CompletionReport;

class AssesmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.job-linking.assesment')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function employerList(Request $request){
    	if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('employers')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
          $output = '<ul class="dropdown-menu" id="employers" style="display:block; position:relative">';
          foreach($data as $row)
          {
           $output .= '
           <li id="'.$row->id.'"><a href="#">'.$row->name.'</a></li>
           ';
          }
          $output .= '</ul>';
          echo $output;
         }
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
    		'district' => 'required',
    		'dm_name' => 'required',
    		'program_date' => 'required',
    		'employer_id' => 'required'
    	]);

    	if($validator->passes()){
            $branch_id = auth()->user()->branch;
            $data = array(

    		'district' => $request->district,
    		'dsd' => $request->dsd,
    		'dm_name' => $request->dm_name,
    		'title_of_action' => $request->title_of_action,
    		'activity_code' => $request->activity_code,
    		'program_date' => $request->program_date,
    		'employer_id'=> $request->employer_id,
    		'head_of_org' => $request->head_of_org,
    		'registered' => $request->registered,
    		'type_of_reg' => $request->type_of_reg,
    		'nature_of_business' => $request->nature_of_business,
    		'no_of_employers' => $request->no_of_employers,
    		'worksites' => $request->worksites,
    		'departments' => $request->departments,
    		'time_from' => $request->time_from,
    		'time_to' => $request->time_to,
    		'days_from' => $request->days_from,
    		'days_to' => $request->days_to,
    		'women' => $request->women,
    		'full_time' => $request->full_time,
    		'part_time' => $request->part_time,
    		'shifts' => $request->shifts,
    		'contract' => $request->contract,
    		'permanant' => $request->permanant,
    		'different_locations' => $request->different_locations,
    		'disabled' => $request->disabled,
    		'hrd' => $request->hrd,
    		'app_letter' => $request->app_letter,
    		'probation' => $request->probation,
    		'duration' => $request->duration,
    		'leave_policy' => $request->leave_policy,
    		'gender_policy' => $request->gender_policy,
    		'harassment' => $request->harassment,
    		'elaborate' => $request->elaborate,
    		'equal_opportunity' => $request->equal_opportunity,
    		'prepared_language' => $request->prepared_language,
    		'starting_salary' => $request->starting_salary,
    		'facilities' => json_encode($request->facilities),	
    		'created_at' => date('Y-m-d H:i:s'),
    		'branch_id' => $branch_id,

    		);

    		$review = DB::table('assesments')->insert($data);
            $assesment_id = DB::getPdo()->lastInsertId();


            $audit = array(
                    'user_type' => 'App\User',
                    'user_id' => Auth::user()->id,
                    'event' => 'created',
                    'auditable_type' => 'assesments',
                    'auditable_id' => $assesment_id,
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
    		return response()->json(['error'=>$validator->errors()->all()]);
    	}
    }

     public function view(){
        $branch_id = Auth::user()->branch;
        
        if(is_null($branch_id)){
        $meetings = DB::table('assesments')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','assesments.branch_id')
                      ->get();
        //dd($mentorings);       
        //dd($participants2018);
        $branches = DB::table('branches')->get();

        $employers = DB::table('assesments')
                   ->join('employers','employers.id','=','assesments.employer_id')
                   ->select('employers.name as employer_name','employers.*')
                   ->distinct()
                   ->get();
        }
        else{
            $meetings = DB::table('assesments')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','assesments.branch_id')                        
                      ->where('assesments.branch_id','=',$branch_id)
                      ->get();
        //dd($mentorings);       
        //dd($participants2018);
        $branches = DB::table('branches')->get();

        $employers = DB::table('assesments')
                   ->join('employers','employers.id','=','assesments.employer_id')
                   ->where('assesments.branch_id','=',$branch_id)
                   ->select('employers.name as employer_name','employers.*')
                   ->distinct()
                   ->get();
        }
        return view('Activities.Reports.Job-Linking.assesment')->with(['meetings'=>$meetings,'branches'=>$branches,'employers'=>$employers]);
    }

    public function fetch(Request $request){
        if($request->ajax())
        {  
            $branch_id = Auth::user()->branch;
            if($request->dateStart != '' && $request->dateEnd != '')
            {
                if($request->branch !=''){
                    $data = DB::table('assesments') 
                        ->join('branches','branches.id','=','assesments.branch_id')
                        ->join('employers','employers.id', '=' ,'assesments.employer_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('branch_id',$request->branch)
                        ->select('assesments.*','branches.*','assesments.id as m_id','employers.*','employers.name as e_name','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();
                }
                else{
                    if(is_null($branch_id)){
                    $data = DB::table('assesments') 
                        ->join('branches','branches.id','=','assesments.branch_id')
                        ->join('employers','employers.id', '=' ,'assesments.employer_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->select('assesments.*','branches.*','assesments.id as m_id','employers.*','employers.name as e_name','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();
                    }
                    else{
                        $data = DB::table('assesments') 
                        ->join('branches','branches.id','=','assesments.branch_id')
                        ->join('employers','employers.id', '=' ,'assesments.employer_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('assesments.branch_id','=',$branch_id)
                        ->select('assesments.*','branches.*','assesments.id as m_id','employers.*','employers.name as e_name','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();
                    }
                }
                
            }
        else
            {
                if(is_null($branch_id)){
                
                $data = DB::table('assesments') 
                        ->join('branches','branches.id','=','assesments.branch_id')
                        ->join('employers','employers.id', '=' ,'assesments.employer_id')
                        ->select('assesments.*','branches.*','assesments.id as m_id','employers.*','employers.name as e_name','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();
                }
                else{
                    $data = DB::table('assesments') 
                        ->join('branches','branches.id','=','assesments.branch_id')
                        ->join('employers','employers.id', '=' ,'assesments.employer_id')
                        ->where('assesments.branch_id','=',$branch_id)
                        ->select('assesments.*','branches.*','assesments.id as m_id','employers.*','employers.name as e_name','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();
                }
            }
                return response()->json($data);
        }
    }

    public function view_meeting($id){
        $meeting = DB::table('assesments')
                   ->join('employers','employers.id', '=' ,'assesments.employer_id')
                   ->join('branches','branches.id','=','assesments.branch_id')
                   ->select('assesments.*','branches.*','assesments.id as m_id','employers.*','employers.name as e_name','branches.name as branch_name','employers.id as e_id')
                   ->where('assesments.id',$id)
                   ->first();

       // dd($meeting);
        //dd($participants);

        return response()->json(array( 
            'meeting' => $meeting,
        ));
        

    }

    public function edit($id){

      $meeting = DB::table('assesments')
                   ->join('employers','employers.id', '=' ,'assesments.employer_id')
                   ->join('branches','branches.id','=','assesments.branch_id')
                   ->select('assesments.*','branches.*','assesments.id as m_id','employers.*','employers.name as e_name','branches.name as branch_name','employers.id as e_id')
                   ->where('assesments.id',$id)
                   ->first();

        return view ('Activities.job-linking.edit.assesment')->with(['meeting'=> $meeting]);

    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
                'program_date'  =>'required',
                
            ]);

        if($validator->passes()){
        // echo "<script>console.log( 'Debug Objects: " . $meeting_date . "' );</script>";

        $data1 = array(   
            
            'program_date' => $request->program_date,
            'employer_id'=> $request->employer_id,
            'head_of_org' => $request->head_of_org,
            'registered' => $request->registered,
            'type_of_reg' => $request->type_of_reg,
            'nature_of_business' => $request->nature_of_business,
            'no_of_employers' => $request->no_of_employers,
            'worksites' => $request->worksites,
            'departments' => $request->departments,
            'time_from' => $request->time_from,
            'time_to' => $request->time_to,
            'days_from' => $request->days_from,
            'days_to' => $request->days_to,
            'women' => $request->women,
            'full_time' => $request->full_time,
            'part_time' => $request->part_time,
            'shifts' => $request->shifts,
            'contract' => $request->contract,
            'permanant' => $request->permanant,
            'different_locations' => $request->different_locations,
            'disabled' => $request->disabled,
            'hrd' => $request->hrd,
            'app_letter' => $request->app_letter,
            'probation' => $request->probation,
            'duration' => $request->duration,
            'leave_policy' => $request->leave_policy,
            'gender_policy' => $request->gender_policy,
            'harassment' => $request->harassment,
            'elaborate' => $request->elaborate,
            'equal_opportunity' => $request->equal_opportunity,
            'prepared_language' => $request->prepared_language,
            'starting_salary' => $request->starting_salary,
            'facilities' => json_encode($request->facilities),  
            
        );
        //dd($data1);
        DB::table('assesments')->whereid($request->m_id)->update($data1);

        $audit = array(
            'user_type' => 'App\User',
            'user_id' => Auth::user()->id,
            'event' => 'updated',
            'auditable_type' => 'assesments',
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

}

<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use App\Audit;
use App\User;
use App\Notifications\CompletionReport;


class RegionalMeetingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.education.regional_meeting')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function add(Request $request){
    	$validator = Validator::make($request->all(),[
                'district' => 'required',
                'dm_name' =>'required',	
                'meeting_date'	=>'required',
                'time_start'=>'required',
                'time_end' =>'required',
                'venue'	=>'required',
                'matters' =>'required',
                
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch; 
                $data1 = array(
                	'district' => $request->district,
                	'dsd' => json_encode($request->dsd),
	                'dm_name' =>$request->dm_name,
	                'title_of_action' =>$request->title_of_action,	
	                'activity_code' =>$request->activity_code,	
	                'meeting_date'	=>$request->meeting_date,
	                'time_start'=>$request->time_start,
	                'time_end' =>$request->time_end,
	                'venue'	=>$request->venue,
	                'matters' =>$request->matters,
	                'decisions' => $request->decisions,
	                'decisions_to_followed'=>$request->decisions_to_followed,
	                'branch_id'	=> $branch_id,
                    'created_at' => date('Y-m-d H:i:s')
                );


                $regional_meeting = DB::table('regional_meetings')->insert($data1);

                $regional_meeting_id = DB::getPdo()->lastInsertId();

                $number = count($request->name);
                if($number>0){
                	for($i=0; $i<$number; $i++){
                		$participants = DB::table('regional_meeting_participants')->insert(['name'=>$request->name[$i],'position'=>$request->position[$i],'branch'=> $request->branch[$i],'regional_meeting_id'=>$regional_meeting_id]);
                	}

                }
                else{
                	return response()->json(['error' => 'Submit participants details']);
                } 

                $audit = array(
                    'user_type' => 'App\User',
                    'user_id' => Auth::user()->id,
                    'event' => 'created',
                    'auditable_type' => 'regional_meetings',
                    'auditable_id' => $regional_meeting_id,
                    'url' => url()->current(),
                    'ip_address' => request()->ip(),
                    'user_agent' => $request->header('User-Agent'),

                );

                $reports = Audit::create($audit);

                $notifyTo = User::whereHas('roles', function($q){$q->whereIn('slug', ['me', 'admin' ]);})->get();
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
            $meetings = DB::table('regional_meetings')                    
                    ->join('branches','branches.id','=','regional_meetings.branch_id')
                    //->join('regional_meeting_participants','regional_meetings.id','=','regional_meeting_participants.regional_meeting_id')
                    //->select('regional_meetings.id as r_id','regional_meetings.*')
                    //->whereRaw('extract(month from meeting_date) = ?', [Carbon::now()->month])
                    ->get();
        }

        else{
            $meetings = DB::table('regional_meetings')                    
                    ->join('branches','branches.id','=','regional_meetings.branch_id')
                    ->where('regional_meetings.branch_id','=',$branch_id)
                    //->join('regional_meeting_participants','regional_meetings.id','=','regional_meeting_participants.regional_meeting_id')
                    //->select('regional_meetings.id as r_id','regional_meetings.*')
                    //->whereRaw('extract(month from meeting_date) = ?', [Carbon::now()->month])
                    ->get();
        }

        
        
        

        $dsd = DB::table('dsd_office')->get();
        $branches = DB::table('branches')->get();
        return view('Activities.Reports.Education.regional-meeting')->with(['meetings'=>$meetings,'dsds'=>$dsd,'branches'=>$branches]);


    }

    public function fetch(Request $request){
        if($request->ajax())
        {
            if($request->dateStart != '' && $request->dateEnd != '')
            {
                $branch_id = Auth::user()->branch;
                if($request->branch !=''){
                    $data = DB::table('regional_meetings') 
                        ->join('branches','branches.id','=','regional_meetings.branch_id')
                        ->whereBetween('meeting_date', array($request->dateStart, $request->dateEnd))
                        ->where('branch_id',$request->branch)
                        ->select('regional_meetings.*','branches.*','regional_meetings.id as r_id')
                        ->orderBy('meeting_date', 'desc')
                        ->get();

                    $summary = DB::table('regional_meetings')
                        ->join('branches','branches.id','=','regional_meetings.branch_id')
                        ->whereBetween('meeting_date', array($request->dateStart, $request->dateEnd))
                        ->where('branch_id',$request->branch)
                        ->select('branches.name',DB::raw('count(*) as total'))
                        ->groupBy('branch_id')
                        ->get();
                }
                else{
                if(is_null($branch_id)){

                    $data = DB::table('regional_meetings') 
                        ->join('branches','branches.id','=','regional_meetings.branch_id')
                        ->whereBetween('meeting_date', array($request->dateStart, $request->dateEnd))
                        ->select('regional_meetings.*','branches.*','regional_meetings.id as r_id')
                        ->orderBy('meeting_date', 'desc')
                        ->get();

                    $summary = DB::table('regional_meetings')
                        ->join('branches','branches.id','=','regional_meetings.branch_id')
                        ->whereBetween('meeting_date', array($request->dateStart, $request->dateEnd))
                        ->select('branches.name',DB::raw('count(*) as total'))
                        ->groupBy('branch_id')
                        ->get();
                }
                else{
                    $data = DB::table('regional_meetings') 
                        ->join('branches','branches.id','=','regional_meetings.branch_id')
                        ->whereBetween('meeting_date', array($request->dateStart, $request->dateEnd))
                        ->select('regional_meetings.*','branches.*','regional_meetings.id as r_id')
                        ->where('branch_id',$branch_id)
                        ->orderBy('meeting_date', 'desc')
                        ->get();

                    $summary = null;
                }
                }
               // echo "<script>console.log( 'Debug Objects: " . $request->branch . "' );</script>";
            }

            

        else
            {
                $branch_id = Auth::user()->branch;

                if(is_null($branch_id)){
                   $data = DB::table('regional_meetings') 
                        ->join('branches','branches.id','=','regional_meetings.branch_id')
                        ->select('regional_meetings.*','branches.*','regional_meetings.id as r_id')
                        ->orderBy('meeting_date', 'desc')
                        ->get(); 

                    $summary = DB::table('regional_meetings')
                        ->join('branches','branches.id','=','regional_meetings.branch_id')
                        ->select('branches.name',DB::raw('count(*) as total'))
                        ->groupBy('branch_id')
                        ->get();
                }
                else{
                    $data = DB::table('regional_meetings') 
                        ->join('branches','branches.id','=','regional_meetings.branch_id')
                        ->where('regional_meetings.branch_id',$branch_id)
                        ->select('regional_meetings.*','branches.*','regional_meetings.id as r_id')
                        ->orderBy('meeting_date', 'desc')
                        ->get(); 

                    $summary = null;
                }
                
            }

                return response()->json(array(
                    'data' => $data,
                    'summary' => $summary
                ));

              //  echo json_encode($data);

        }
    
        

    }

    public function view_meeting($id){
        $meeting = DB::table('regional_meetings')
                   ->join('branches','branches.id','=','regional_meetings.branch_id')
                   ->where('regional_meetings.id',$id)
                   ->first();

        $participants = DB::table('regional_meeting_participants')
                        ->where('regional_meeting_id',$id)
                        ->get();
       // dd($meeting);
        //dd($participants);

        return response()->json(array(
            'participants' => $participants,
            'meeting' => $meeting,
        ));
        

    }

    public function edit($id){

       $meeting = DB::table('regional_meetings')
                   ->join('branches','branches.id','=','regional_meetings.branch_id')
                   ->select('regional_meetings.*','branches.*','regional_meetings.id as r_id')
                   ->where('regional_meetings.id',$id)
                   ->first();

        $participants = DB::table('regional_meeting_participants')
                        ->where('regional_meeting_id',$id)
                        ->get();

        $activities = DB::table('activities')->get();

        return view ('Activities.education.edit.regional_meeting')->with(['meeting'=> $meeting,'participants'=>$participants,'activities'=>$activities]);

    }

    public function update(Request $request){

        $meeting_date  =$request->meeting_date;
        $time_start=$request->time_start;
        $time_end =$request->time_end;
        $venue =$request->venue;
        $matters =$request->matters;
        $decisions = $request->decisions;
        $decisions_to_followed=$request->decisions_to_followed;
        $validator = Validator::make($request->all(),[
                'meeting_date'  =>'required',
                'time_start'=>'required',
                'time_end' =>'required',
                'venue' =>'required',
                'matters' =>'required',
                
            ]);

            if($validator->passes()){
        // echo "<script>console.log( 'Debug Objects: " . $meeting_date . "' );</script>";

        $data1 = array(
  
                    'meeting_date'  =>$request->meeting_date,
                    'time_start'=>$request->time_start,
                    'time_end' =>$request->time_end,
                    'venue' =>$request->venue,
                    'matters' =>$request->matters,
                    'decisions' => $request->decisions,
                    'decisions_to_followed'=>$request->decisions_to_followed,
                    'branch_id' => Auth::user()->branch 

                );

        //dd($data1);
        DB::table('regional_meetings')->whereid($request->r_id)->update($data1);

        $audit = array(
                    'user_type' => 'App\User',
                    'user_id' => Auth::user()->id,
                    'event' => 'updated',
                    'auditable_type' => 'regional_meetings',
                    'auditable_id' => $request->r_id,
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

    public function update_participants(Request $request){

        $participants = DB::table('regional_meeting_participants')
                        ->whereid($request->id_p)
                        ->update(['name'=>$request->name,'position'=>$request->position,'branch'=> $request->branch]);

    }

    public function add_participants(Request $request){

        $participants = DB::table('regional_meeting_participants')
                        ->insert(['name'=>$request->name,'position'=>$request->position,'branch'=> $request->branch,'regional_meeting_id'=>$request->r_id]);

    }
}
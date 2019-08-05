<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

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

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

    public function view(){
        
        $meetings = DB::table('regional_meetings')                    
                    ->join('branches','branches.id','=','regional_meetings.branch_id')
                    //->join('regional_meeting_participants','regional_meetings.id','=','regional_meeting_participants.regional_meeting_id')
                    //->select('regional_meetings.id as r_id','regional_meetings.*')
                    //->whereRaw('extract(month from meeting_date) = ?', [Carbon::now()->month])
                    ->get();

        $dsd = DB::table('dsd_office')->get();
        $branches = DB::table('branches')->get();
        return view('Activities.Reports.Education.regional-meeting')->with(['meetings'=>$meetings,'dsds'=>$dsd,'branches'=>$branches]);


    }

    public function fetch(Request $request){
        if($request->ajax())
        {
            if($request->dateStart != '' && $request->dateEnd != '')
            {
                if($request->branch !=''){
                    $data = DB::table('regional_meetings') 
                        ->join('branches','branches.id','=','regional_meetings.branch_id')
                        ->whereBetween('meeting_date', array($request->dateStart, $request->dateEnd))
                        ->where('branch_id',$request->branch)
                        ->select('regional_meetings.*','branches.*','regional_meetings.id as r_id')
                        ->orderBy('meeting_date', 'desc')
                        ->get();
                }
                else{
                    $data = DB::table('regional_meetings') 
                        ->join('branches','branches.id','=','regional_meetings.branch_id')
                        ->whereBetween('meeting_date', array($request->dateStart, $request->dateEnd))
                        ->select('regional_meetings.*','branches.*','regional_meetings.id as r_id')
                        ->orderBy('meeting_date', 'desc')
                        ->get();
                }
                
            }

            

        else
            {
                $data = DB::table('regional_meetings') 
                        ->join('branches','branches.id','=','regional_meetings.branch_id')
                        ->select('regional_meetings.*','branches.*','regional_meetings.id as r_id')
                        ->orderBy('meeting_date', 'desc')
                        ->get();
            }
                echo json_encode($data);
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
}
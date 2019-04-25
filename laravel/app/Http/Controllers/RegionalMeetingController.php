<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;

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
	                'branch_id'	=> $branch_id
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
}
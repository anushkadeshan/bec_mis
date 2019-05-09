<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StakeHolderMeetingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.career-guidance.stake-holder-meeting')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function add(Request $request){
    	$validator = Validator::make($request->all(),[
    		    'program_cost'  => 'required',
    		    'total_male'  => 'required',
    		    'total_female'  => 'required',
                'district' => 'required',
                'gnd' => 'required',
                'dm_name' =>'required',
                'title_of_action' =>'required',	
                'activity_code' =>'required',	
                'meeting_date'	=>'required',
                'time_start'=>'required',
                'time_end' =>'required',
                'venue'	=>'required',
                'image.*' => 'image|mimes:jpeg,jpg,png,gif,svg',
                'attendance' => 'mimes:jpeg,jpg,png,gif,svg,pdf',
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
                if($request->hasFile('attendance')){
                	$input['attendance'] = time().'.'.$request->file('attendance')->getClientOriginalExtension();
                	$request->attendance->move(storage_path('activities/files/stakeholder/attendance'), $input['attendance']);
                }
                $data1 = array(
                	'district' => $request->district,
                	'dsd' => $request->dsd,
                	'gnd' => json_encode($request->gnd),
	                'dm_name' =>$request->dm_name,
	                'title_of_action' =>$request->title_of_action,	
	                'activity_code' =>$request->activity_code,	
	                'meeting_date'	=>$request->meeting_date,
	                'time_start'=>$request->time_start,
	                'time_end' =>$request->time_end,
	                'venue'	=>$request->venue,
	                'program_cost' =>$request->program_cost,
	                'total_male' => $request->total_male,
	                'total_female'=>$request->total_female,
	                'decisions'=>$request->decisions,
	                'attendance' => $input['attendance'],
	                'branch_id'	=> $branch_id,
                    'created_at' => date('Y-m-d H:i:s')
                );

                //insert general data 
                $stakeholder = DB::table('stake_holder_meetings')->insert($data1);
                $stakeholder_id = DB::getPdo()->lastInsertId();

                 //insert images
                $input = $request->all();
                if($request->hasFile('image')){
                    foreach ($request->file('image') as $key => $value) {
                	$imageName = time(). $key . '.' . $value->getClientOriginalExtension();
                	$value->move(storage_path('activities/files/stakeholder/images'), $imageName);
                	$images = DB::table('stake_holder_images')->insert(['images'=>$imageName,'stake_holder_meeting_id'=>$stakeholder_id]);
            		}
                }
                $number = count($request->name);
                if($number>0){
                	for($i=0; $i<$number; $i++){
                		$gvt_participants = DB::table('stake_holder_participants')->insert(['name'=>$request->name[$i],'designation'=>$request->designation[$i],'gender'=> $request->gender[$i],'institute'=> $request->institute[$i],'stake_holder_meeting_id'=>$stakeholder_id]);
                	}

                }
                else{
                	return response()->json(['error' => 'Submit Participants Details.']);
                } 

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    
    }
}

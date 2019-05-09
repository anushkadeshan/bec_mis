<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;


class TvecMeetingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.skill-development.tvec-meeting')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
                'district' => 'required',
                'dm_name' =>'required',	
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
                if($request->hasFile('attendance')){
	            	$input['attendance'] = time().'.'.$request->file('attendance')->getClientOriginalExtension();
	            	$request->attendance->move(storage_path('activities/files/skill/tvec-meeting/attendance'), $input['attendance']);
            	}
            	if($request->hasFile('meeting_minute')){
	            	$input['meeting_minute'] = time().'.'.$request->file('meeting_minute')->getClientOriginalExtension();
	            	$request->meeting_minute->move(storage_path('activities/files/skill/tvec-meeting/meeting_minute'), $input['meeting_minute']);
            	}
                $data1 = array(
                	'district' => $request->district,
                	'dsd' => json_encode($request->dsd),
	                'dm_name' =>$request->dm_name,
	                'title_of_action' =>$request->title_of_action,	
	                'activity_code' =>$request->activity_code,	
	                'program_date'	=>$request->program_date,
	                'time_start'=>$request->time_start,
	                'time_end' =>$request->time_end,
	                'venue'	=>$request->venue,
	                'total_male' => $request->total_male,
	                'total_female'=>$request->total_female,
	                'total_institutes' => $request->total_institutes,
	                'matters_discussed' => $request->matters_discussed,
	                'decisions_agreed' => $request->decisions_agreed,
	                'matters_to_follow' => $request->matters_to_follow,
	                'attendance' => $input['attendance'],
	                'meeting_minute' => $input['meeting_minute'],
	                'branch_id'	=> $branch_id,
	                'created_at' => date('Y-m-d H:i:s')
                );

                //insert general data 
                $tvec = DB::table('tvec_meetings')->insert($data1);
                $tvec_id = DB::getPdo()->lastInsertId();

                

                //insert photos
                
				if($request->hasFile('images')){
                    foreach ($request->file('images') as $key => $value) {
                	$imageName = time(). $key . '.' . $value->getClientOriginalExtension();
                	$value->move(storage_path('activities/files/skill/tvec_meeting/images'), $imageName);
                	$images = DB::table('tvec_meetings_photos')->insert(['images'=>$imageName,'tvec_id'=>$tvec_id]);
            		}
                }

                $number = count($request->name);
                if($number>0){
                	for($i=0; $i<$number; $i++){
                		DB::table('tvec_participants')->insert(['name'=>$request->name[$i],'position'=>$request->position[$i],'institute'=> $request->institute[$i],'tvec_id'=>$tvec_id]);
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

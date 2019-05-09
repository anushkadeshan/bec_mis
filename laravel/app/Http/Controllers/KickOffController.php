<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use DB;
use Illuminate\Support\Facades\Validator;

class KickOffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.career-guidance.kick-off')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function add(Request $request){
    	$validator = Validator::make($request->all(),[
    		    'program_cost'  => 'required',
    		    'total_male'  => 'required',
    		    'total_female'  => 'required',
    		    'mode_of_conduct'  => 'required',
                'district' => 'required',
                'dm_name' =>'required',
                'title_of_action' =>'required',	
                'activity_code' =>'required',	
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
                	$request->attendance->move(storage_path('activities/files/kick-off/attendance'), $input['attendance']);
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
	                'pwd_male'=>$request->pwd_male,
	                'pwd_female'=>$request->pwd_female,
	                'mode_of_conduct'=>$request->mode_of_conduct,
	                'topics'=>$request->topics,
	                'deliverables'=>$request->deliverables,
	                'resourse_person_id'=>$request->resourse_person_id,
	                'attendance' => $input['attendance'],
	                'branch_id'	=> $branch_id,
                    'created_at' => date('Y-m-d H:i:s')
                );

                //insert general data 
                $kick_off = DB::table('kickoffs')->insert($data1);
                $kick_off_id = DB::getPdo()->lastInsertId();

                 //insert images
                $input = $request->all();
                if($request->hasFile('image')){
                    foreach ($request->file('image') as $key => $value) {
                	$imageName = time(). $key . '.' . $value->getClientOriginalExtension();
                	$value->move(storage_path('activities/files/kick-off/images'), $imageName);
                	$images = DB::table('kickoff_photos')->insert(['images'=>$imageName,'kickoff_id'=>$kick_off_id]);
            		}
                }
                $number = count($request->name);
                if($number>0){
                	for($i=0; $i<$number; $i++){
                		$gvt_participants = DB::table('kickoff_gvt_officials')->insert(['name'=>$request->name[$i],'designation'=>$request->designation[$i],'gender'=> $request->gender[$i],'institute'=> $request->institute[$i],'kickoff_id'=>$kick_off_id]);
                	}

                }
                else{
                	return response()->json(['error' => 'Submit Goverment Participants Details.']);
                } 

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;


class CGtrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.career-guidance.cg_training')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
    		    'program_cost'  => 'required',
    		    'total_male'  => 'required',
    		    'total_female'  => 'required',
    		    'mode_of_conduct'  => 'required',
                'district' => 'required',
                'dm_name' =>'required',
                'title_of_action' =>'required',	
                'activity_code' =>'required',	
                'meeting_date'	=>'required',
                'time_start'=>'required',
                'time_end' =>'required',
                'venue'	=>'required',
                'images.*' => 'image|mimes:jpeg,jpg,png,gif,svg|max:200000',
                'attendance' => 'mimes:jpeg,jpg,png,gif,svg,pdf|max:200000',
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
                if($request->hasFile('attendance')){
	            	$input['attendance'] = time().'.'.$request->file('attendance')->getClientOriginalExtension();
	            	$request->attendance->move(storage_path('activities/files/cg_training/attendance'), $input['attendance']);
            	}
            	if($request->hasFile('test')){
	            	$input['test'] = time().'.'.$request->file('test')->getClientOriginalExtension();
	            	$request->test->move(storage_path('activities/files/cg_training/pre-pro-test'), $input['test']);
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
	                'test' => $input['test'],
	                'branch_id'	=> $branch_id,
                    'created_at' => date('Y-m-d H:i:s')
                );

                //insert general data 
                $cg_trainings = DB::table('cg_trainings')->insert($data1);
                $cg_trainings_id = DB::getPdo()->lastInsertId();

                 //insert images
                $input = $request->all();
                if($request->hasFile('images')){
	                foreach ($request->file('images') as $key => $value) {
	            	$imageName = time(). $key . '.' . $value->getClientOriginalExtension();
	            	$value->move(storage_path('activities/files/cg_training/images'), $imageName);
	            	$images = DB::table('cg_trainings_photos')->insert(['images'=>$imageName,'cg_trainings_id'=>$cg_trainings_id]);
	        		} 
	        	}

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    
    }
}

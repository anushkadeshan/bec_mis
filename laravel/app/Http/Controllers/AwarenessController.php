<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class AwarenessController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.job-linking.awareness')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
    		'district' => 'required',
    		'dm_name' => 'required',
    		'program_date' => 'required',
    	]);

    	if($validator->passes()){

            $branch_id = auth()->user()->branch;
            $input = $request->all();


            if($request->hasFile('attendance')){
                $input['attendance'] = time().'.'.$request->file('attendance')->getClientOriginalExtension();
                $request->attendance->move(storage_path('activities/files/job-linking/awareness/attendance'), $input['attendance']);
            }

    		$data = array(
	    		'district' => $request->district,
	        	'dsd' => json_encode($request->dsd),
	            'dm_name' =>$request->dm_name,
	            'title_of_action' =>$request->title_of_action,	
	            'activity_code' =>$request->activity_code,	
	            'program_date'	=>$request->program_date,
	            'time_start'=>$request->time_start,
	            'time_end' =>$request->time_end,
	            'venue'	=>$request->venue,
	            'cost' =>$request->cost,
	            'total_male' => $request->total_male,
	            'total_female'=>$request->total_female,
	            'pwd_male'=>$request->pwd_male,
	            'pwd_female'=>$request->pwd_female,
	            'mode_of_awareness'=>$request->mode_of_awareness,
	            'topics'=>$request->topics,
	            'deliverables'=>$request->deliverables,
	            'exposure_visit'=>$request->exposure_visit,
	            'palce'=>$request->palce,
	            'demonstraion'=>$request->demonstraion,
	            'matters_discussed'=>$request->matters_discussed,
	            'any_concerns'=>$request->any_concerns,
	            'attendance' => $input['attendance'],
	            'branch_id'	=> $branch_id,
	            'created_at' => date('Y-m-d H:i:s')
            );

            $awareness = DB::table('awareness')->insert($data);
            $awareness_id = DB::getPdo()->lastInsertId();



            //insert images
                $input = $request->all();
                if($request->hasFile('images')){
                    foreach ($request->file('images') as $key => $value) {
                	$imageName = time(). $key . '.' . $value->getClientOriginalExtension();
                	$value->move(storage_path('activities/files/job-linking/awareness/images'), $imageName);
                	$images = DB::table('awareness_photos')->insert(['images'=>$imageName,'awareness_id'=>$awareness_id]);
            		}
                }



    	}

    	else{
    		return response()->json(['error'=> $validator->errors()->all()]);
    	}
    }
}

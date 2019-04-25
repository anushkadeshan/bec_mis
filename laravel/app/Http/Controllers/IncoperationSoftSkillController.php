<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class IncoperationSoftSkillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.skill-development.incoperate')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
    		    'review_date'  => 'required',
                'district' => 'required',
                'dm_name' =>'required',	
                'institute_id' => 'required',
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
                if($request->hasFile('review_report')){
	            	$input['review_report'] = time().'.'.$request->file('review_report')->getClientOriginalExtension();
	            	$request->review_report->move(storage_path('activities/files/skill/incoperate/review_report'), $input['review_report']);
            	}
            	if($request->hasFile('gsrn')){
	            	$input['gsrn'] = time().'.'.$request->file('gsrn')->getClientOriginalExtension();
	            	$request->gsrn->move(storage_path('activities/files/skill/incoperate/gsrn'), $input['gsrn']);
            	}
                $data1 = array(
                	'district' => $request->district,
                	'dsd' => $request->dsd,
	                'dm_name' =>$request->dm_name,
	                'title_of_action' =>$request->title_of_action,  
                    'activity_code' =>$request->activity_code,	
	                'review_date'	=>$request->review_date,	               
	                'institute_id'	=>$request->institute_id, 
	                'tvec_ex_date' => $request->tvec_ex_date,
	                'nature_of_assistance' => $request->nature_of_assistance,
	                'review_report' => $input['review_report'],
	                'gsrn' => $input['gsrn'],
	                'branch_id'	=> $branch_id,
	                'created_at' => date('Y-m-d H:i:s')
                );

                //insert general data 
                $incoperation = DB::table('incoperation_soft_skills')->insert($data1);
                $iss_id = DB::getPdo()->lastInsertId();

                //insert photos
				if($request->hasFile('images')){
                    foreach ($request->file('images') as $key => $value) {
                	$imageName = time(). $key . '.' . $value->getClientOriginalExtension();
                	$value->move(storage_path('activities/files/skill/incoperate/images'), $imageName);
                	$images = DB::table('incoperation_soft_skills_photos')->insert(['images'=>$imageName,'iss_id'=>$iss_id]);
            		}
                }
            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    
    }
}

<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class PartnershipTrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.skill-development.partner-training')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
    		    'program_date'  => 'required',
                'district' => 'required',
                'dm_name' =>'required',	
                'institute_id' => 'required',
                'course_id' => 'required'
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
                if($request->hasFile('review_report')){
	            	$input['review_report'] = time().'.'.$request->file('review_report')->getClientOriginalExtension();
	            	$request->review_report->move(storage_path('activities/files/skill/partner-support/review_report'), $input['review_report']);
            	}
            	if($request->hasFile('mou_report')){
	            	$input['mou_report'] = time().'.'.$request->file('mou_report')->getClientOriginalExtension();
	            	$request->mou_report->move(storage_path('activities/files/skill/partner-support/mou_report'), $input['mou_report']);
            	}
            	if($request->hasFile('group_photo')){
	            	$input['group_photo'] = time().'.'.$request->file('group_photo')->getClientOriginalExtension();
	            	$request->group_photo->move(storage_path('activities/files/skill/partner-support/group-photo'), $input['group_photo']);
            	}
                $data1 = array(
                	'district' => $request->district,
                	'dsd' => $request->dsd,
	                'dm_name' =>$request->dm_name,
	                'title_of_action' =>json_encode($request->title_of_action),  
                    'activity_code' =>json_encode($request->activity_code),	
	                'program_date'	=>$request->program_date,
	                'start_date'=>$request->start_date,
	                'end_date' =>$request->end_date,
	                'mou_signed' =>$request->mou_signed,
	                'date_mou_signed' =>$request->date_mou_signed,
	                'institute_id'	=>$request->institute_id,
	                'institutional_review' =>$request->institutional_review,
	                'course_id' => $request->course_id,
	                'bec_contribution' => $request->bec_contribution,
	                'partner_contribution' => $request->partner_contribution,
	                'student_contribution' => $request->student_contribution,
	                'total_cost' => $request->total_cost,
	                'total_male' => $request->total_male,
	                'total_female'=>$request->total_female,
	                'pwd_male'=>$request->pwd_male,
	                'pwd_female'=>$request->pwd_female,
	                'review_report' => $input['review_report'],
	                'mou_report' => $input['mou_report'],
	                'group_photo' => $input['group_photo'],
	                'branch_id'	=> $branch_id,
	                'created_at' => date('Y-m-d H:i:s')
                );

                //insert general data 
                $partner_trainings = DB::table('partner_trainings')->insert($data1);
                $partner_trainings_id = DB::getPdo()->lastInsertId();

                //insert youths
              	$number = count($request->youth_id);
                if($number>0){
                    for($i=0; $i<$number; $i++){
                        $youths = DB::table('partner_trainings_youth')->insert(['youth_id'=>$request->youth_id[$i],'approved_amount'=>$request->approved_amount[$i],'partner_trainings_id'=>$partner_trainings_id]);
                    }

                }
                else{
                    return response()->json(['error' => 'Submit youth details.']);
                }
            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    
    }

}

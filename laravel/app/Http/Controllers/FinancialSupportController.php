<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class FinancialSupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.skill-development.finacial-support')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
    		    'program_date'  => 'required',
    		    'total_male'  => 'required',
    		    'total_female'  => 'required',
                'district' => 'required',
                'dm_name' =>'required',	
                'review_report' => 'required',
                'mou_report' => 'mimes:jpeg,jpg,png,gif,svg,pdf',
                'institute_id' => 'required',
                'course_id' => 'required'
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
            	if($request->hasFile('mou_report')){
	            	$input['mou_report'] = time().'.'.$request->file('mou_report')->getClientOriginalExtension();
	            	$request->mou_report->move(storage_path('activities/files/skill/finacial-support/mou_report'), $input['mou_report']);
            	}
                $data1 = array(
                	'district' => $request->district,
                	'dsd' => $request->dsd,
	                'dm_name' =>$request->dm_name,
	                'title_of_action' =>$request->title_of_action,  
                    'activity_code' =>$request->activity_code,	
	                'program_date'	=>$request->program_date,
	                'start_date'=>$request->start_date,
	                'end_date' =>$request->end_date,
	                'institute_id'	=>$request->institute_id,
	                'institutional_review' =>$request->institutional_review,
	                'course_id' => $request->course_id,
	                'cost' => $request->cost,
	                'total_male' => $request->total_male,
	                'total_female'=>$request->total_female,
	                'pwd_male'=>$request->pwd_male,
	                'pwd_female'=>$request->pwd_female,
	                'review_report' => $request->review_report,
	                'mou_report' => $input['mou_report'],
	                'branch_id'	=> $branch_id,
                    'created_at' => date('Y-m-d H:i:s')
                );

                //insert general data 
                $finacial_supports = DB::table('finacial_supports')->insert($data1);
                $finacial_support_id = DB::getPdo()->lastInsertId();

                //insert youths
              	$number = count($request->youth_id);
                if($number>0){
                    for($i=0; $i<$number; $i++){
                        $participants = DB::table('finacial_supports_youths')->insert(['youth_id'=>$request->youth_id[$i],'approved_amount'=>$request->approved_amount[$i],'installments'=>$request->installments[$i],'finacial_support_id'=>$finacial_support_id]);
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

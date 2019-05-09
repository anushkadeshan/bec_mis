<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CareerGuidance;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;



class CarrerGuidanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $districts = DB::table('districts')->get();
        $activities = DB::table('activities')->get();
        $managers = DB::table('branches')->select('manager')->distinct()->get();

    	return view('Activities.career-guidance.youth-career-guidance')->with(['managers'=> $managers, 'districts' => $districts,'activities'=>$activities]);
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
                'meeting_date'  =>'required',
                'time_start'=>'required',
                'time_end' =>'required',
                'venue' =>'required',
                'image.*' => 'image|mimes:jpeg,jpg,png,gif,svg',
                'attendance' => 'mimes:jpeg,jpg,png,gif,svg,pdf',
            ]);
        if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
                if($request->hasFile('attendance')){
                    $input['attendance'] = time().'.'.$request->file('attendance')->getClientOriginalExtension();
                    $request->attendance->move(storage_path('activities/files/career-guidance/attendance'), $input['attendance']);
                }
        	  $data = array(
        	  	    'district' => $request->district,
                    'dsd' => $request->dsd,
                    'gnd' => json_encode($request->gnd),
                    'dm_name' =>$request->dm_name,
                    'title_of_action' =>json_encode($request->title_of_action),  
                    'activity_code' =>json_encode($request->activity_code),  
                    'meeting_date'  =>$request->meeting_date,
                    'time_start'=>$request->time_start,
                    'time_end' =>$request->time_end,
                    'venue' =>$request->venue,
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
                    'branch_id' => $branch_id,
                    'created_at' => date('Y-m-d H:i:s')

        	  );
              $cg = CareerGuidance::create($data);
              $career_guidances_id = $cg->id;

              //insert participants
              $number = count($request->name);
                if($number>0){
                    for($i=0; $i<$number; $i++){
                        $participants = DB::table('cg_participants')->insert(['name'=>$request->name[$i],'type'=>$request->type[$i],'address'=> $request->address[$i],'career_guidances_id'=>$career_guidances_id]);
                    }

                }
                else{
                    return response()->json(['error' => 'Submit Participants Details.']);
                }

                //insert youth selected
              $number1 = count($request->requirement);
                if($number1>0){
                    for($i=0; $i<$number1; $i++){
                        $youths = DB::table('cg_youth_selected')->insert(['requirement'=>$request->requirement[$i],'male'=>$request->male[$i],'female'=> $request->female[$i],'career_guidances_id'=>$career_guidances_id]);
                    }

                }
                else{
                    return response()->json(['error' => 'Submit Participants Details.']);
                }

                 //insert career test summary
              $number2 = count($request->career_field);
                if($number2>0){
                    for($i=0; $i<$number2; $i++){
                        $youths = DB::table('cg_careertest_summary')->insert(['career_field'=>$request->career_field[$i],'male'=>$request->male1[$i],'female'=> $request->female1[$i],'career_guidances_id'=>$career_guidances_id]);
                    }

                }
                else{
                    return response()->json(['error' => 'Submit Participants Details.']);
                }

                //insert images
                $input = $request->all();
                if($request->hasFile('images')){
                    foreach ($request->file('images') as $key => $value) {
                    $imageName = time(). $key . '.' . $value->getClientOriginalExtension();
                    $value->move(storage_path('activities/files/career-guidance/images'), $imageName);
                    $images = DB::table('cg_images')->insert(['images'=>$imageName,'career_guidances_id'=>$career_guidances_id]);
                    }
                }

        }

        else{
               return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    public function delete(Request $request)
    {
         
        $id = Input::get('id');
        $cg = CareerGuidance::find($id);
        $cg->delete();

    }
    

    public function add_tot(){
        $activities = DB::table('activities')->get();
        return view('Activities.career-guidance.tot-cg')->with(['activities'=>$activities]);
    }

    public function insert_tot(Request $request){
        $validator = Validator::make($request->all(),[
                'program_cost'  => 'required',
                'mode_of_conduct'  => 'required',
                'title_of_action' =>'required', 
                'activity_code' =>'required',   
                'meeting_date'  =>'required',
                'time_start'=>'required',
                'time_end' =>'required',
                'venue' =>'required',
                'image.*' => 'image|mimes:jpeg,jpg,png,gif,svg',
                'attendance' => 'mimes:jpeg,jpg,png,gif,svg,pdf',
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
                $input['attendance'] = time().'.'.$request->file('attendance')->getClientOriginalExtension();
                $request->attendance->move(storage_path('activities/files/tot-cg/attendance'), $input['attendance']);
                $input['training_report'] = time().'.'.$request->file('training_report')->getClientOriginalExtension();
                $request->training_report->move(storage_path('activities/files/tot-cg/training-report'), $input['training_report']);
                $data1 = array(
                    
                    'title_of_action' =>$request->title_of_action,  
                    'activity_code' =>$request->activity_code,  
                    'meeting_date'  =>$request->meeting_date,
                    'time_start'=>$request->time_start,
                    'time_end' =>$request->time_end,
                    'venue' =>$request->venue,
                    'program_cost' =>$request->program_cost,
                    'mode_of_conduct'=>$request->mode_of_conduct,
                    'topics'=>$request->topics,
                    'deliverables'=>$request->deliverables,
                    'resourse_person_id'=>$request->resourse_person_id,
                    'attendance' => $input['attendance'],
                    'training_report' => $input['training_report'],
                    'branch_id' => $branch_id
                );

                //insert general data 
                $tot_cg = DB::table('tot_cg')->insert($data1);
                $tot_cg_id = DB::getPdo()->lastInsertId();

                 //insert images
                $input = $request->all();
                foreach ($request->file('image') as $key => $value) {
                $imageName = time(). $key . '.' . $value->getClientOriginalExtension();
                $value->move(storage_path('activities/files/tot-cg/images'), $imageName);
                $images = DB::table('tot_cg_images')->insert(['images'=>$imageName,'tot_cg_id'=>$tot_cg_id]);
                }

                $number = count($request->organization);
                if($number>0){
                    for($i=0; $i<$number; $i++){
                        $participants = DB::table('tot_cg_participants')->insert(['organization'=>$request->organization[$i],'total_male'=>$request->total_male[$i],'total_female'=> $request->total_female[$i],'pwd_male'=> $request->pwd_male[$i],'pwd_female'=> $request->pwd_female[$i],'tot_cg_id'=>$tot_cg_id]);
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

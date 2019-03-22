<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;


class PesUnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.career-guidance.pes-unit')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
                'district' => 'required',
                'dm_name' =>'required',
                'title_of_action' =>'required',	
                'activity_code' =>'required',	
                'date'	=>'required',
                'records' => 'required',
                'unit_available'=> 'required',
	            'space_available'=> 'required',
	            'stationary_available'=> 'required',
	            'chairs_available'=> 'required',
	            'tables_available'=> 'required',
	            'cupboards_available'=> 'required',
	            'stationary_items_available' => 'required',
	            
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $dsd_id =  $request->dsd;
                $dsd= DB::table('dsd_office')->where('ID',$dsd_id)->first();
                $dsd_name = $dsd->DSD_Name;
                $data1 = array(
                	'district' => $request->district,
                	'dsd' => $dsd_name,
                	'gnd' => json_encode($request->gnd),
	                'dm_name' =>$request->dm_name,
	                'title_of_action' =>$request->title_of_action,	
	                'activity_code' =>$request->activity_code,	
	                'date'	=>$request->date,
	                'pwd_male'=>$request->pwd_male,
	                'pwd_female'=>$request->pwd_female,
	                'responding_officer_name'=> $request->responding_officer_name,
	                'responding_officer_des'=> $request->responding_officer_des,
	                'responding_officer_contacts' => $request->responding_officer_contacts,
	                'type_of_services'=> $request->type_of_services,
	                'records' => $request->records,
	                'male_18_24' => $request->male_18_24,
	                'male_25_30' => $request->male_25_30,
	                'male_30'=> $request->male_30,
	                'female_18_24'=> $request->female_18_24,
	                'female_25_30'=> $request->female_25_30,
	                'female_30'=> $request->female_30,
	                'unit_available'=>$request->unit_available,
	                'space_available'=> $request->space_available,
	                'stationary_available'=> $request->stationary_available,
	                'chairs_available'=> $request->chairs_available,
	                'tables_available'=>$request->tables_available,
	                'cupboards_available'=>$request->cupboards_available,
	                'stationary_items_available' => $request->stationary_items_available,
	                'lack_of_items'=> $request->lack_of_items,
	                'staff'=> $request->staff,
	                'sufficient_staff'=> $request->sufficient_staff,
	                'additional_staff'=> $request->additional_staff,
	                'vt_database' => $request->vt_database,
	                'update_vt'=> $request->update_vt,
	                'last_updated_vt' => $request->last_updated_vt,
	                'job_database'=> $request->job_database,
	                'update_job'=> $request->update_job,
	                'last_updated_job'=>$request->last_updated_job,
	                'reasons_to_not_update'=>$request->reasons_to_not_update,
	                'gaps' => $request->gaps,
	                'branch_id' => $branch_id,
                );

                //insert general data 
                $pes = DB::table('pes_units')->insert($data1);
                $pes_id = DB::getPdo()->lastInsertId();
             

                $number = count($request->service);
                if($number>0){
                	for($i=0; $i<$number; $i++){
                		$services = DB::table('pes_unit_services')->insert(['service'=>$request->service[$i],'male'=>$request->male[$i],'female'=> $request->female[$i],'pes_id'=>$pes_id]);
                	}

                }
                else{
                	return response()->json(['error' => 'Submit most demanding services by youth.']);
                } 

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    
    }
}

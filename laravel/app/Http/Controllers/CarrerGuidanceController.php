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
        $branch_id = auth()->user()->branch;

        if(is_null($branch_id)){
           $career_guidances = CareerGuidance::with('branches')->get();
        }
        else{
            $career_guidances =  DB::table('branches_careerGuidances')
                             ->join('career_guidances','career_guidances.id','=','branches_careerGuidances.career_guidance_id')
                             ->where('branches_careerGuidances.branch_id',$branch_id)
                             ->get();
        }
    	
    	return view('Activities.career-guidance.youth-career-guidance')->with(['career_guidances'=> $career_guidances, 'districts' => $districts,'activities'=>$activities]);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
                'ds_division' => 'required',
                'date' => 'required',
                'time' => 'required',
                'male' => 'required',
                'female' => 'required',
                'activity_id' =>'required'
            ]);
        if($validator->passes()){

        	  $dsd_office = DB::table('dsd_office')->where('ID',$request->ds_division)->first();
        	  $ds_name = $dsd_office->DSD_Name;

        	  $data = array(
        	  	'ds_division' => $ds_name,
        	  	'date' => $request->date,
        	  	'time' => $request->time,
        	  	'male' => $request->male,
        	  	'female' => $request->female,
        	  	'venue' => $request->venue,
        	  	'resourse_person' => $request->resourse_person,
        	  	'district' => $request->district,
                'activity_id' => $request->activity_id,

        	  );
              $branch_id = auth()->user()->branch;
              $cg = CareerGuidance::create($data);
              $cg_id = $cg->id;
              $branch = DB::table('branches_careerGuidances')->insert(
                    array('branch_id' => $branch_id, 'career_guidance_id' => $cg_id));



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
    
    
}

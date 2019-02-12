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

    	$career_guidances = CareerGuidance::with('branches')->get();
    	return view('Activities.career_guidances')->with(['career_guidances'=> $career_guidances, 'districts' => $districts]);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
                'ds_division' => 'required',
                'date' => 'required',
                'time' => 'required',
                'male' => 'required',
                'female' => 'required',
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
        	  	'district' => $request->district

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DB;
use Illuminate\Support\Facades\Validator;
use Auth;

class PesUnitSupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.career-guidance.pes-unit-support')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function pes_List(Request $request){
    	if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('pes_units')
            ->where('dsd', 'LIKE', "%{$query}%")
            ->get();
          $output = '<ul class="dropdown-menu" id="dsds" style="display:block; position:relative">';
          foreach($data as $row)
          {
           $output .= '
           <li class="nav-item" id="'.$row->id.'"><a href="#" >'.$row->dsd.'('.$row->date.')'.'</a></li>
           ';
          }
          $output .= '</ul>';
          echo $output;
         }
    }

     public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
                'district' => 'required',
                'dm_name' =>'required',
                'title_of_action' =>'required',	
                'activity_code' =>'required',	
                'dsd'	=>'required',
                'visit_date'	=>'required',
                'support_date'	=>'required',
                'gaps'	=>'required',
                'pes_identification_id'	=>'required',
                'photos.*' => 'image|mimes:jpeg,jpg,png,gif,svg',
	            
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $dsd_id =  $request->dsd;
                $dsd= DB::table('dsd_office')->where('ID',$dsd_id)->first();
                $dsd_name = $dsd->DSD_Name;
                $data1 = array(
                	'district' => $request->district,
                	'dsd' => $dsd_name,
	                'dm_name' =>$request->dm_name,
	                'title_of_action' =>$request->title_of_action,	
	                'activity_code' =>$request->activity_code,	
	                'visit_date' =>$request->visit_date,
	                'support_date'	=>$request->support_date,                
	                'gaps' => $request->gaps,
	                'pes_identification_id' => $request->pes_identification_id,
	                'created_at' => date('Y-m-d H:i:s'),
	                'branch_id' => $branch_id,
                );

                //insert general data 
                $pes = DB::table('pes_unit_supports')->insert($data1);
                $pes_units_support_id = DB::getPdo()->lastInsertId();
             
                 //insert images
                $input = $request->all();
                if($request->hasFile('photos')){
	                foreach ($request->file('photos') as $key => $value) {
	            	$imageName = time(). $key . '.' . $value->getClientOriginalExtension();
	            	$value->move(storage_path('activities/files/pes-supports/images'), $imageName);
	            	$images = DB::table('pes_units_support_images')->insert(['photos'=>$imageName,'pes_units_support_id'=>$pes_units_support_id]);
	        		}
        		}
        		//insert gsrns
        		if($request->hasFile('gsrns')){
	        		foreach ($request->file('gsrns') as $key => $value) {
	            	$gsrnsName = time(). $key . '.' . $value->getClientOriginalExtension();
	            	$value->move(storage_path('activities/files/pes-supports/gsrns'), $gsrnsName);
	            	$gsrns = DB::table('pes_units_support_gsrns')->insert(['gsrns'=>$imageName,'pes_units_support_id'=>$pes_units_support_id]);
	        		}
        		}
                $number = count($request->gap_num);
                if($number>0){
                	for($i=0; $i<$number; $i++){
                		$services = DB::table('pes_units_gaps')->insert(['gap_num'=>$request->gap_num[$i],'meterials_provided'=>$request->meterials_provided[$i],'units'=> $request->units[$i],'date_provided'=> $request->date_provided[$i],'usage'=> $request->usage[$i],'cost'=> $request->cost[$i],'pes_units_support_id'=>$pes_units_support_id]);
                	}

                }
                else{
                	return response()->json(['errors' => 'Submit materials provided for particular PES unit.']);
                } 

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    
    }
}

<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class PlacementController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.job-linking.placements')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function employerList(Request $request){
    	if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('employers')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
          $output = '<ul class="dropdown-menu" id="employers" style="display:block; position:relative">';
          foreach($data as $row)
          {
           $output .= '
           <li class="nav-item" id="'.$row->id.'"><a href="#" >'.$row->name.'</a></li>
           ';
          }
          $output .= '</ul>';
          echo $output;
         }
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
    		'program_date'  => 'required',
    		'district' => 'required',
            'dm_name' =>'required',	
            'employer_id' => 'required'
    	]);

    	if($validator->passes()){

    		$branch_id = auth()->user()->branch;
            $input = $request->all();
            if($request->hasFile('attendance_youths')){
            	$input['attendance_youths'] = time().'.'.$request->file('attendance_youths')->getClientOriginalExtension();
            	$request->attendance_youths->move(storage_path('activities/files/job-linking/placements/attendance_youths'), $input['attendance_youths']);
        	}
        	if($request->hasFile('attendance_employers')){
            	$input['attendance_employers'] = time().'.'.$request->file('attendance_employers')->getClientOriginalExtension();
            	$request->attendance_employers->move(storage_path('activities/files/job-linking/placements/attendance_employers'), $input['attendance_employers']);
        	}

    		$data = array(
    			'district' => $request->district,
    			'dsd' => json_encode($request->dsd),
    			'dm_name' => $request->dm_name,
    			'title_of_action' => $request->title_of_action,
    			'activity_code' => $request->activity_code,
    			'program_date'	=>$request->program_date,
	            'time_start'=>$request->time_start,
	            'time_end' =>$request->time_end,
    			'venue'	=> $request->venue,
    			'program_cost' => $request->program_date,
    			'attendance_youths' => $input['attendance_youths'],
    			'attendance_employers' => $input['attendance_employers'], 
    			'branch_id' => $branch_id,
    			'created_at' => date('Y-m-d H:i:s')	
    		);

    		$placements = DB::table('placements')->insert($data);
    		$placements_id = DB::getPdo()->lastInsertId();

    		//insert youths
              	$number = count($request->youth_id);
                if($number>0){
                    for($i=0; $i<$number; $i++){
                        $participants = DB::table('placements_youths')->insert(['youth_id'=>$request->youth_id[$i],'type_of_support'=>$request->type_of_support[$i],'employer'=>$request->employer[$i],'vacancies'=>$request->vacancies[$i],'salary'=>$request->salary[$i],'placements_id'=>$placements_id]);
                    }

                }
                else{
                    return response()->json(['error' => 'Submit youth details.']);
                }

            //insert employers
              	$number = count($request->employer_id);
                if($number>0){
                    for($i=0; $i<$number; $i++){
                        $employers = DB::table('placements_employers')->insert(['employer_id'=>$request->employer_id[$i],'vacancies'=>$request->vacancies[$i],'total_male'=>$request->total_male[$i],'total_female'=>$request->total_female[$i],'pwd_male'=>$request->pwd_male[$i],'pwd_female'=>$request->pwd_female[$i],'placements_id'=>$placements_id]);
                    }

                }
                else{
                    return response()->json(['error' => 'Submit Employer details.']);
                }

                //insert images
                $input = $request->all();
                if($request->hasFile('images')){
                    foreach ($request->file('images') as $key => $value) {
                	$imageName = time(). $key . '.' . $value->getClientOriginalExtension();
                	$value->move(storage_path('activities/files/job-linking/placements/images'), $imageName);
                	$images = DB::table('placements_photos')->insert(['images'=>$imageName,'placements_id'=>$placements_id]);
            		}
                }

    	}

    	else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

}

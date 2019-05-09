<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;

class AssesmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.job-linking.assesment')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function employerList(Request $request){
    	if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('employers')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
          $output = '<ul class="dropdown-menu" id="autocomplete" style="display:block; position:relative">';
          foreach($data as $row)
          {
           $output .= '
           <li id="'.$row->id.'"><a href="#">'.$row->name.'</a></li>
           ';
          }
          $output .= '</ul>';
          echo $output;
         }
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
    		'district' => 'required',
    		'dm_name' => 'required',
    		'review_date' => 'required',
    		'employer_id' => 'required'
    	]);

    	if($validator->passes()){
            $branch_id = auth()->user()->branch;
            $data = array(

    		'district' => $request->district,
    		'dsd' => $request->dsd,
    		'dm_name' => $request->dm_name,
    		'title_of_action' => $request->title_of_action,
    		'activity_code' => $request->activity_code,
    		'review_date' => $request->review_date,
    		'employer_id'=> $request->employer_id,
    		'head_of_org' => $request->head_of_org,
    		'registered' => $request->registered,
    		'type_of_reg' => $request->type_of_reg,
    		'nature_of_business' => $request->nature_of_business,
    		'no_of_employers' => $request->no_of_employers,
    		'worksites' => $request->worksites,
    		'departments' => $request->departments,
    		'time_from' => $request->time_from,
    		'time_to' => $request->time_to,
    		'days_from' => $request->days_from,
    		'days_to' => $request->days_to,
    		'women' => $request->women,
    		'full_time' => $request->full_time,
    		'part_time' => $request->part_time,
    		'shifts' => $request->shifts,
    		'contract' => $request->contract,
    		'permanant' => $request->permanant,
    		'regularly' => $request->regularly,
    		'different_locations' => $request->different_locations,
    		'disabled' => $request->disabled,
    		'hrd' => $request->hrd,
    		'app_letter' => $request->app_letter,
    		'probation' => $request->probation,
    		'duration' => $request->duration,
    		'leave_policy' => $request->leave_policy,
    		'gender_policy' => $request->gender_policy,
    		'harassment' => $request->harassment,
    		'elaborate' => $request->elaborate,
    		'equal_opportunity' => $request->equal_opportunity,
    		'prepared_language' => $request->prepared_language,
    		'starting_salary' => $request->starting_salary,
    		'facilities' => json_encode($request->facilities),	
    		'created_at' => date('Y-m-d H:i:s'),
    		'branch_id' => $branch_id,

    		);

    		$review = DB::table('assesments')->insert($data);

    	}

    	else{
    		return response()->json(['error'=>$validator->errors()->all()]);
    	}
    }
}

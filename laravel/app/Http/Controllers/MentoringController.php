<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MentoringController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.education.mentoring')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function resoursePersonList(Request $request){
    	if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('resourse_people')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
          $output = '<ul class="dropdown-menu" id="resourse_person" style="display:block; position:relative">';
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

    public function add(Request $request){
    	$validator = Validator::make($request->all(),[
    		    'program_cost'  => 'required',
    		    'total_male'  => 'required',
    		    'total_female'  => 'required',
    		    'fathers'  => 'required',
    		    'mothers'  => 'required',
    		    'mode_of_conduct'  => 'required',
                'district' => 'required',
                'dm_name' =>'required',
                'title_of_action' =>'required',	
                'activity_code' =>'required',	
                'meeting_date'	=>'required',
                'time_start'=>'required',
                'time_end' =>'required',
                'venue'	=>'required',
                'image.*' => 'image|mimes:jpeg,jpg,png,gif,svg',
                'attendance' => 'mimes:jpeg,jpg,png,gif,svg,pdf',
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
            	$input['attendance'] = time().'.'.$request->file('attendance')->getClientOriginalExtension();
            	$request->attendance->move(storage_path('activities/files/mentoring/attendance'), $input['attendance']);
                $data1 = array(
                	'district' => $request->district,
                	'dsd' => json_encode($request->dsd),
	                'dm_name' =>$request->dm_name,
	                'title_of_action' =>$request->title_of_action,	
	                'activity_code' =>$request->activity_code,	
	                'meeting_date'	=>$request->meeting_date,
	                'time_start'=>$request->time_start,
	                'time_end' =>$request->time_end,
	                'venue'	=>$request->venue,
	                'program_cost' =>$request->program_cost,
	                'total_male' => $request->total_male,
	                'total_female'=>$request->total_female,
	                'pwd_male'=>$request->pwd_male,
	                'pwd_female'=>$request->pwd_female,
	                'fathers'=>$request->fathers,
	                'mothers'=>$request->mothers,
	                'male_gurdians'=>$request->male_gurdians,
	                'female_gurdians'=>$request->female_gurdians,
	                'mode_of_conduct'=>$request->mode_of_conduct,
	                'topics'=>$request->topics,
	                'deliverables'=>$request->deliverables,
	                'resourse_person_id'=>$request->resourse_person_id,
	                'attendance' => $input['attendance'],
	                'branch_id'	=> $branch_id
                );

                //insert general data 
                $mentoring = DB::table('mentoring')->insert($data1);
                $mentoring_id = DB::getPdo()->lastInsertId();

                 //insert images
                $input = $request->all();
                foreach ($request->file('image') as $key => $value) {
            	$imageName = time(). $key . '.' . $value->getClientOriginalExtension();
            	$value->move(storage_path('activities/files/mentoring/images'), $imageName);
            	$images = DB::table('mentoring_images')->insert(['image'=>$imageName,'mentoring_id'=>$mentoring_id]);
        		}

                $number = count($request->name);
                if($number>0){
                	for($i=0; $i<$number; $i++){
                		$gvt_participants = DB::table('mentoring_gvt_officials')->insert(['name'=>$request->name[$i],'designation'=>$request->designation[$i],'gender'=> $request->gender[$i],'institute'=> $request->institute[$i],'mentoring_id'=>$mentoring_id]);
                	}

                }
                else{
                	return response()->json(['error' => 'Submit Goverment Participants Details.']);
                } 

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    
    }
}

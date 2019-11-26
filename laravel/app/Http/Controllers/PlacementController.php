<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Zipper;

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
    			'program_cost' => $request->program_cost,
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


    public function view(){
        $meetings = DB::table('placements')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','placements.branch_id')
                      ->get();
        //dd($mentorings);

        $participants2018 = DB::table('placements_employers')
                            ->join('placements','placements.id','=','placements_employers.placements_id')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2018' )
                        ->first();
                        //->groupBy(function ($val) {
                                // Carbon::parse($val->program_date)->format('Y');
                        //});
                        //->groupBy(DB::raw("year(program_date)"))
                        
           $participants2019 = DB::table('placements_employers') 
                            ->join('placements','placements.id','=','placements_employers.placements_id')                      
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2019' )
                        ->first();            
            $participants2020 = DB::table('placements_employers')
                            ->join('placements','placements.id','=','placements_employers.placements_id')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2020' )
                        ->first();   
            $participants2021 = DB::table('placements_employers')   
                            ->join('placements','placements.id','=','placements_employers.placements_id')        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2021' )
                        ->first();  

            $salary1 = DB::table('placements_youths')   
                       ->whereBetween('salary',[0, 4999])
                       ->count();  

            $salary2 = DB::table('placements_youths')   
                       ->whereBetween('salary',[5000, 9999])
                       ->count(); 

            $salary3 = DB::table('placements_youths')   
                       ->whereBetween('salary',[10000, 14999])
                       ->count(); 

            $salary4 = DB::table('placements_youths')   
                       ->whereBetween('salary',[15000, 19999])
                       ->count();  

            $salary5 = DB::table('placements_youths')   
                       ->whereBetween('salary',[20000, 24999])
                       ->count(); 

            $salary6 = DB::table('placements_youths')   
                       ->where('salary','>=', 25000)
                       ->count();            
                                            
        //dd($participants2018);
        $branches = DB::table('branches')->get();
        return view('Activities.Reports.Job-Linking.placements')->with(['meetings'=>$meetings,'branches'=>$branches,'participants2018'=>$participants2018,'participants2019'=>$participants2019,'participants2020'=>$participants2020,'participants2021'=>$participants2021,'salary1'=>$salary1,'salary2'=>$salary2,'salary3'=>$salary3,'salary4'=>$salary4,'salary5'=>$salary5,'salary6'=>$salary6]);
    }

    public function fetch(Request $request){
        if($request->ajax())
        {
            if($request->dateStart != '' && $request->dateEnd != '')
            {
                if($request->branch !=''){
                    $data1 = DB::table('placements') 
                        ->join('branches','branches.id','=','placements.branch_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('branch_id',$request->branch)
                        ->select('placements.*','branches.*','placements.id as m_id','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();

                    $data2 = DB::table('placements_employers')
                             ->join('placements','placements.id','=','placements_employers.placements_id')
                            ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                            ->where('branch_id',$request->branch)
                            ->get();
                }
                else{
                    $data1 = DB::table('placements') 
                        ->join('branches','branches.id','=','placements.branch_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->select('placements.*','branches.*','placements.id as m_id','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();

                        $data2 = DB::table('placements_employers')
                             ->join('placements','placements.id','=','placements_employers.placements_id')
                            ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                            ->get();
                }
                
            }
        else
            {
                $data1 = DB::table('placements') 
                        ->join('branches','branches.id','=','placements.branch_id')
                        ->select('placements.*','branches.*','placements.id as m_id','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();

                        $data2 = DB::table('placements_employers')
                                ->join('placements','placements.id','=','placements_employers.placements_id')
                                ->get();
            }

                return response()->json(array( 
                    'data1' => $data1,
                    'data2' => $data2,
                ));
        }
    }

    public function view_meeting($id){
        $meeting = DB::table('placements')
                   ->join('branches','branches.id','=','placements.branch_id')
                   ->select('placements.*','branches.*','placements.id as m_id','branches.name as branch_name')
                   ->where('placements.id',$id)
                   ->first();

        $employers = DB::table('placements_employers')
                     ->join('employers','employers.id','=','placements_employers.employer_id')
                     ->where('placements_employers.placements_id',$id)
                     ->get();
        $youths = DB::table('placements_youths')
                  ->join('youths','youths.id','=','placements_youths.youth_id')
                  ->where('placements_youths.placements_id',$id)
                  ->get();

       // dd($meeting);
        //dd($participants);

        return response()->json(array( 
            'meeting' => $meeting,
            'employers' => $employers,
            'youths' => $youths,
        ));
        

    }

    public function download($file_name){
        //$file_name = $request->attendance;
        $file = storage_path('activities/files/job-linking/placements/attendance_youths/'.$file_name.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'application/pdf',
                  'Content-Type' => 'application/msword',
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }

    public function download_e_attendance($id){
        //$file_name = $request->attendance;
        $file = storage_path('activities/files/job-linking/placements/attendance_employers/'.$id.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'application/pdf',
                  'Content-Type' => 'application/msword',
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }

    public function download_photos($id){
        $photos = DB::table('placements_photos')
                  ->where('placements_id',$id)
                  ->select('placements_photos.images')
                  ->get();
        foreach($photos as $photo){
            //echo $photo->images;
            $headers = ["Content-Type"=>"application/zip"];
            //$paths = storage_path('activities/files/mentoring/images/'.$photo->image.'');
            $zipper = Zipper::make(storage_path('activities/files/job-linking/placements/images/'.$id.'.zip'))->add(storage_path('activities/files/job-linking/placements/images/'.$photo->images.''))->close();
        }
            return response()->download(storage_path('activities/files/job-linking/placements/images/'.$id.'.zip','photos',$headers)); 

        //$photos_array = $photos->toArray();
        //dd($photos);
       // Zipper::make('mydir/photos.zip')->add($paths);
       // return response()->download(('mydir/photos.zip')); 
    }
}

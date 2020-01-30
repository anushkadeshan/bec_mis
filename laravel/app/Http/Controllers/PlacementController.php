<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Zipper;
use Auth;
use Illuminate\Support\Facades\URL;
use App\Audit;
use App\User;
use App\Notifications\CompletionReport;

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

                $audit = array(
                    'user_type' => 'App\User',
                    'user_id' => Auth::user()->id,
                    'event' => 'created',
                    'auditable_type' => 'placements',
                    'auditable_id' => $placements_id,
                    'url' => url()->current(),
                    'ip_address' => request()->ip(),
                    'user_agent' => $request->header('User-Agent'),

                );

                $reports = Audit::create($audit);

                $notifyTo = User::whereHas('roles', function($q){$q->whereIn('slug', ['me', 'admin','management' ]);})->get();
                foreach ($notifyTo as $notifyUser) {
                    $notifyUser->notify(new CompletionReport($reports));
                }

    	}

    	else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }


    public function view(){
        $branch_id = Auth::user()->branch;
        if(is_null($branch_id)){
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

  
            $salary1 = (DB::table('placements_youths')   
                       ->whereBetween('salary',[0, 4999])
                       ->count())+(DB::table('placement_individual')   
                       ->whereBetween('salary',[0, 4999])
                       ->count());  

            $salary2 = DB::table('placements_youths')   
                       ->whereBetween('salary',[5000, 9999])
                       ->count()+(DB::table('placement_individual')   
                       ->whereBetween('salary',[5000, 9999])
                       ->count()); 

            $salary3 = DB::table('placements_youths')   
                       ->whereBetween('salary',[10000, 14999])
                       ->count()+(DB::table('placement_individual')   
                       ->whereBetween('salary',[10000, 14999])
                       ->count()); 

            $salary4 = DB::table('placements_youths')   
                       ->whereBetween('salary',[15000, 19999])
                       ->count()+(DB::table('placement_individual')   
                       ->whereBetween('salary',[15000, 19999])
                       ->count());  

            $salary5 = DB::table('placements_youths')   
                       ->whereBetween('salary',[20000, 24999])
                       ->count()+(DB::table('placement_individual')   
                       ->whereBetween('salary',[20000, 24999])
                       ->count()); 

            $salary6 = DB::table('placements_youths')   
                       ->where('salary','>=', 25000)
                       ->count()+(DB::table('placement_individual')   
                       ->where('salary','>=', 25000)
                       ->count());            
        }
        else{
          $meetings = DB::table('placements')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','placements.branch_id')
                      ->where('placements.branch_id','=',$branch_id)
                      ->get();                        

        //dd($mentorings);

        $participants2018 = DB::table('placements_employers')
                            ->join('placements','placements.id','=','placements_employers.placements_id')
                            ->where('placements.branch_id','=',$branch_id)                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2018' )
                        ->first();
                        //->groupBy(function ($val) {
                                // Carbon::parse($val->program_date)->format('Y');
                        //});
                        //->groupBy(DB::raw("year(program_date)"))
                        
           $participants2019 = DB::table('placements_employers') 
                            ->join('placements','placements.id','=','placements_employers.placements_id')   
                            ->where('placements.branch_id','=',$branch_id)                   
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2019' )
                        ->first();            
            $participants2020 = DB::table('placements_employers')
                            ->join('placements','placements.id','=','placements_employers.placements_id') 
                            ->where('placements.branch_id','=',$branch_id)                      
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2020' )
                        ->first();   
            $participants2021 = DB::table('placements_employers')   
                            ->join('placements','placements.id','=','placements_employers.placements_id')     
                            ->where('placements.branch_id','=',$branch_id)   
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2021' )
                        ->first();  

            $salary1 = DB::table('placements_youths')  
                      ->join('placements','placements.id','=','placements_youths.placements_id') 
                      ->where('placements.branch_id','=',$branch_id) 
                       ->whereBetween('salary',[0, 4999])
                       ->count()+(DB::table('placement_individual')   
                       ->whereBetween('salary',[0, 4999])
                       ->count());  

            $salary2 = DB::table('placements_youths')   
                      ->join('placements','placements.id','=','placements_youths.placements_id') 
                      ->where('placements.branch_id','=',$branch_id) 
                       ->whereBetween('salary',[5000, 9999])
                       ->count()+(DB::table('placement_individual')   
                       ->whereBetween('salary',[5000, 9999])
                       ->count()); 

            $salary3 = DB::table('placements_youths')   
                      ->join('placements','placements.id','=','placements_youths.placements_id') 
                      ->where('placements.branch_id','=',$branch_id) 
                       ->whereBetween('salary',[10000, 14999])
                       ->count()+(DB::table('placement_individual')   
                       ->whereBetween('salary',[10000, 14999])
                       ->count()); 

            $salary4 = DB::table('placements_youths')   
                      ->join('placements','placements.id','=','placements_youths.placements_id') 
                      ->where('placements.branch_id','=',$branch_id) 
                       ->whereBetween('salary',[15000, 19999])
                       ->count()+(DB::table('placement_individual')   
                       ->whereBetween('salary',[15000, 19999])
                       ->count());  

            $salary5 = DB::table('placements_youths')   
                      ->join('placements','placements.id','=','placements_youths.placements_id') 
                      ->where('placements.branch_id','=',$branch_id) 
                       ->whereBetween('salary',[20000, 24999])
                       ->count()+(DB::table('placement_individual')   
                       ->whereBetween('salary',[20000, 24999])
                       ->count()); 

            $salary6 = DB::table('placements_youths')   
                      ->join('placements','placements.id','=','placements_youths.placements_id') 
                      ->where('placements.branch_id','=',$branch_id) 
                       ->where('salary','>=', 25000)
                       ->count()+(DB::table('placement_individual')   
                       ->where('salary','>=', 25000)
                       ->count());
        }                                   
        //dd($participants2018);
        $branches = DB::table('branches')->get();
        return view('Activities.Reports.Job-Linking.placements')->with(['meetings'=>$meetings,'branches'=>$branches,'participants2018'=>$participants2018,'participants2019'=>$participants2019,'participants2020'=>$participants2020,'participants2021'=>$participants2021,'salary1'=>$salary1,'salary2'=>$salary2,'salary3'=>$salary3,'salary4'=>$salary4,'salary5'=>$salary5,'salary6'=>$salary6]);
    }

    public function fetch(Request $request){
        if($request->ajax())
        {
            $branch_id = Auth::user()->branch;

            if($request->dateStart != '' && $request->dateEnd != '')
            {
                if($request->branch !=''){
                    $data1 = DB::table('placements') 
                        ->join('branches','branches.id','=','placements.branch_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('placements.branch_id',$request->branch)
                        ->select('placements.*','branches.*','placements.id as m_id','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();

                    $data2 = DB::table('placements_employers')
                             ->join('placements','placements.id','=','placements_employers.placements_id')
                            ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                            ->where('placements.branch_id',$request->branch)
                            ->get();

                  $placements = DB::table('placement_individual')
                        ->join('branches','branches.id','=','placement_individual.branch_id')
                        ->join('employers','employers.id','=','placement_individual.employer_id')
                        ->join('youths','youths.id','=','placement_individual.youth_id')
                        ->select('placement_individual.*','branches.*','youths.*','employers.*','placement_individual.id as m_id','branches.name as branch_name','youths.name as youth_name','employers.name as employer_name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('placement_individual.branch_id',$request->branch)
                        ->orderBy('program_date', 'desc')
                        ->get();
                }
                else{
                    if(is_null($branch_id)){

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

                    $placements = DB::table('placement_individual')
                        ->join('branches','branches.id','=','placement_individual.branch_id')
                        ->join('employers','employers.id','=','placement_individual.employer_id')
                        ->join('youths','youths.id','=','placement_individual.youth_id')
                        ->select('placement_individual.*','branches.*','youths.*','employers.*','placement_individual.id as m_id','branches.name as branch_name','youths.name as youth_name','employers.name as employer_name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->orderBy('program_date', 'desc')
                        ->get();

                    }
                    else{
                      $data1 = DB::table('placements') 
                        ->join('branches','branches.id','=','placements.branch_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('placements.branch_id','=',$branch_id) 
                        ->select('placements.*','branches.*','placements.id as m_id','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();

                        $data2 = DB::table('placements_employers')
                             ->join('placements','placements.id','=','placements_employers.placements_id')
                            ->where('placements.branch_id','=',$branch_id) 
                            ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                            ->get();

                        $placements = DB::table('placement_individual')
                        ->join('branches','branches.id','=','placement_individual.branch_id')
                        ->join('employers','employers.id','=','placement_individual.employer_id')
                        ->join('youths','youths.id','=','placement_individual.youth_id')
                        ->select('placement_individual.*','branches.*','youths.*','employers.*','placement_individual.id as m_id','branches.name as branch_name','youths.name as youth_name','employers.name as employer_name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('placement_individual.branch_id','=',$branch_id)
                        ->orderBy('program_date', 'desc')
                        ->get();
                    }
                }
                
            }
        else
            {
                if(is_null($branch_id)){
                
                $data1 = DB::table('placements') 
                        ->join('branches','branches.id','=','placements.branch_id')
                        ->select('placements.*','branches.*','placements.id as m_id','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();

               $data2 = DB::table('placements_employers')
                        ->join('placements','placements.id','=','placements_employers.placements_id')
                        ->get();

              $placements = DB::table('placement_individual')
                        ->join('branches','branches.id','=','placement_individual.branch_id')
                        ->join('employers','employers.id','=','placement_individual.employer_id')
                        ->join('youths','youths.id','=','placement_individual.youth_id')
                        ->select('placement_individual.*','branches.*','youths.*','employers.*','placement_individual.id as m_id','branches.name as branch_name','youths.name as youth_name','employers.name as employer_name')
                        ->orderBy('program_date', 'desc')
                        ->get();
                }
                else{
                  $data1 = DB::table('placements') 
                        ->join('branches','branches.id','=','placements.branch_id')
                        ->where('placements.branch_id','=',$branch_id) 
                        ->select('placements.*','branches.*','placements.id as m_id','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();

                        $data2 = DB::table('placements_employers')
                                ->join('placements','placements.id','=','placements_employers.placements_id')
                                ->where('placements.branch_id','=',$branch_id) 
                                ->get();

                  $placements = DB::table('placement_individual')
                        ->join('branches','branches.id','=','placement_individual.branch_id')
                        ->join('employers','employers.id','=','placement_individual.employer_id')
                        ->join('youths','youths.id','=','placement_individual.youth_id')
                        ->select('placement_individual.*','branches.*','youths.*','employers.*','placement_individual.id as m_id','branches.name as branch_name','youths.name as youth_name','employers.name as employer_name')
                        ->where('placement_individual.branch_id','=',$branch_id)
                        ->orderBy('program_date', 'desc')
                        ->get();
                }
            }

                return response()->json(array( 
                    'data1' => $data1,
                    'data2' => $data2,
                    'placements' => $placements
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
                  ->join('employers','employers.id','=','placements_youths.employer')
                  ->select('youths.*','placements_youths.*','employers.name as employer_name')
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

    public function individual(){
      $districts = DB::table('districts')->get();
      $managers = DB::table('branches')->select('manager')->distinct()->get();
      $activities = DB::table('activities')->get();
      return view('Activities.job-linking.individual')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

public function insert_individual(Request $request){
      $validator = Validator::make($request->all(),[
        'program_date'  => 'required',
        'district' => 'required',
            'dm_name' =>'required', 
            'employer_id' => 'required',
            'youth_id' => 'required',
            'salary' => 'numeric'
      ]);

      if($validator->passes()){

        $branch_id = auth()->user()->branch;

        $data = array(
          'district' => $request->district,
          'dsd' => json_encode($request->dsd),
          'dm_name' => $request->dm_name,
          'title_of_action' => $request->title_of_action,
          'activity_code' => $request->activity_code,
          'program_date'  =>$request->program_date,
          'employer_id' => $request->employer_id,
          'youth_id' => $request->youth_id,
          'type_of_support' => $request->type_of_support,
          'vacancy' => $request->vacancy,
          'salary' => $request->salary,
          'branch_id' => $branch_id,
          'created_at' => date('Y-m-d H:i:s') 
        );

        $placements = DB::table('placement_individual')->insert($data);
        $individual_id = DB::getPdo()->lastInsertId();


                $audit = array(
                    'user_type' => 'App\User',
                    'user_id' => Auth::user()->id,
                    'event' => 'created',
                    'auditable_type' => 'placement_individual',
                    'auditable_id' => $individual_id,
                    'url' => url()->current(),
                    'ip_address' => request()->ip(),
                    'user_agent' => $request->header('User-Agent'),

                );

                $reports = Audit::create($audit);

                $notifyTo = User::whereHas('roles', function($q){$q->whereIn('slug', ['me', 'admin','management' ]);})->get();
                foreach ($notifyTo as $notifyUser) {
                    $notifyUser->notify(new CompletionReport($reports));
                }

      }

      else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

    public function view_meeting2($id){
        $placements = DB::table('placement_individual')
                        ->join('branches','branches.id','=','placement_individual.branch_id')
                        ->join('employers','employers.id','=','placement_individual.employer_id')
                        ->join('youths','youths.id','=','placement_individual.youth_id')
                        ->select('placement_individual.*','branches.*','youths.*','employers.*','placement_individual.id as m_id','branches.name as branch_name','youths.name as youth_name','employers.name as employer_name')
                        ->where('placement_individual.id','=',$id)
                        ->first();

       // dd($meeting);
        //dd($participants);

        return response()->json($placements);
        

    }

    public function edit($id){

      $meeting = DB::table('placements')
                   ->join('branches','branches.id','=','placements.branch_id')
                   ->select('placements.*','branches.*','placements.id as m_id','branches.name as branch_name')
                   ->where('placements.id',$id)
                   ->first();

        $employers = DB::table('placements_employers')
                     ->join('employers','employers.id','=','placements_employers.employer_id')
                     ->select('placements_employers.*','employers.*','placements_employers.id as e_id')
                     ->where('placements_employers.placements_id',$id)
                     ->get();
        $youths = DB::table('placements_youths')
                  ->join('youths','youths.id','=','placements_youths.youth_id')
                  ->join('employers','employers.id','=','placements_youths.employer')
                  ->select('placements_youths.*','youths.*','placements_youths.id as y_id','employers.name as employer_name')
                  ->where('placements_youths.placements_id',$id)
                  ->get();

        return view ('Activities.job-linking.edit.placement')->with(['meeting'=> $meeting,'youths'=>$youths,'employers' => $employers]);

    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
                'program_date'  =>'required',
                
            ]);

        if($validator->passes()){
        // echo "<script>console.log( 'Debug Objects: " . $meeting_date . "' );</script>";

        $data1 = array(   
          'program_date'  =>$request->program_date,
          'time_start'=>$request->time_start,
          'time_end' =>$request->time_end,
          'venue' => $request->venue,
          'program_cost' => $request->program_cost, 
            
        );
        //dd($data1);
        DB::table('placements')->whereid($request->m_id)->update($data1);

        $audit = array(
            'user_type' => 'App\User',
            'user_id' => Auth::user()->id,
            'event' => 'updated',
            'auditable_type' => 'placements',
            'auditable_id' => $request->m_id,
            'url' => url()->current(),
            'ip_address' => request()->ip(),
            'user_agent' => $request->header('User-Agent'),

        );

        $reports = Audit::create($audit);
    }


    

    else{
        return response()->json(['error' => $validator->errors()->all()]);
        }
    }


    public function update_employers(Request $request){

        $participants = DB::table('placements_employers')
                        ->whereid($request->id_p)
                        ->update(['vacancies'=>$request->vacancies,'total_male'=>$request->total_male,'total_female'=>$request->total_female,'pwd_male'=>$request->pwd_male,'pwd_female'=>$request->pwd_female]);

    }

    public function add_employer(Request $request){

        $participants = DB::table('placements_employers')
                        ->insert(['employer_id'=>$request->employer_id,'vacancies'=>$request->vacancies,'total_male'=>$request->total_male,'total_female'=>$request->total_female,'pwd_male'=>$request->pwd_male,'pwd_female'=>$request->pwd_female,'placements_id'=>$request->m_id]);

    }

    public function update_youths(Request $request){

        $participants = DB::table('placements_youths')
                        ->whereid($request->id_p)
                        ->update(['type_of_support'=>$request->type_of_support,'employer'=>$request->employer,'vacancies'=>$request->vacancies,'salary'=>$request->salary]);

    }

    public function add_youth(Request $request){

        $participants = DB::table('placements_youths')
                        ->insert(['youth_id'=>$request->youth_id,'type_of_support'=>$request->type_of_support,'employer'=>$request->employer,'vacancies'=>$request->vacancies,'salary'=>$request->salary,'placements_id'=>$request->m_id]);

    }

   public function edit_i($id){

      $placements = DB::table('placement_individual')
                        ->join('branches','branches.id','=','placement_individual.branch_id')
                        ->join('employers','employers.id','=','placement_individual.employer_id')
                        ->join('youths','youths.id','=','placement_individual.youth_id')
                        ->select('placement_individual.*','branches.*','youths.*','employers.*','placement_individual.id as m_id','branches.name as branch_name','youths.name as youth_name','employers.name as employer_name')
                        ->where('placement_individual.id','=',$id)
                        ->first();

        return view ('Activities.job-linking.edit.individual')->with(['placements'=> $placements]);

    }

    public function update_i(Request $request){

        $validator = Validator::make($request->all(),[
                'program_date'  =>'required',
                
            ]);

        if($validator->passes()){
        // echo "<script>console.log( 'Debug Objects: " . $meeting_date . "' );</script>";

        $data1 = array(   
          'program_date'  =>$request->program_date,
          'employer_id' => $request->employer_id,
          'youth_id' => $request->youth_id,
          'type_of_support' => $request->type_of_support,
          'vacancy' => $request->vacancy,
          'salary' => $request->salary,            
        );
        //dd($data1);
        DB::table('placement_individual')->whereid($request->m_id)->update($data1);

        $audit = array(
            'user_type' => 'App\User',
            'user_id' => Auth::user()->id,
            'event' => 'updated',
            'auditable_type' => 'placement_individual',
            'auditable_id' => $request->m_id,
            'url' => url()->current(),
            'ip_address' => request()->ip(),
            'user_agent' => $request->header('User-Agent'),

        );

        $reports = Audit::create($audit);
    }


    

    else{
        return response()->json(['error' => $validator->errors()->all()]);
        }
    }

}

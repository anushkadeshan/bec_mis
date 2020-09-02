<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Zipper;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\URL;
use App\Audit;
use App\User;
use App\Notifications\CompletionReport;

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
                'program_date'	=>'required',
                'time_start'=>'required',
                'time_end' =>'required',
                'venue'	=>'required',
                'image.*' => 'image|mimes:jpeg,jpg,png,gif,svg',
                'attendance' => 'mimes:jpeg,jpg,png,gif,svg,pdf',
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
                if($request->hasFile('attendance')){
                	$input['attendance'] = time().'.'.$request->file('attendance')->getClientOriginalExtension();
                	$request->attendance->move(storage_path('activities/files/mentoring/attendance'), $input['attendance']);
                }
                $data1 = array(
                	'district' => $request->district,
                	'dsd' => json_encode($request->dsd),
	                'dm_name' =>$request->dm_name,
	                'title_of_action' =>$request->title_of_action,	
	                'activity_code' =>$request->activity_code,	
	                'program_date'	=>$request->program_date,
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
	                'branch_id'	=> $branch_id,
                    'created_at' => date('Y-m-d H:i:s')
                );

                //insert general data 
                $mentoring = DB::table('mentoring')->insert($data1);
                $mentoring_id = DB::getPdo()->lastInsertId();

                 //insert images
                $input = $request->all();
                if($request->hasFile('image')){
                    foreach ($request->file('image') as $key => $value) {
                	$imageName = time(). $key . '.' . $value->getClientOriginalExtension();
                	$value->move(storage_path('activities/files/mentoring/images'), $imageName);
                	$images = DB::table('mentoring_images')->insert(['image'=>$imageName,'mentoring_id'=>$mentoring_id]);
            		}
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

                $audit = array(
                    'user_type' => 'App\User',
                    'user_id' => Auth::user()->id,
                    'event' => 'created',
                    'auditable_type' => 'mentoring',
                    'auditable_id' => $mentoring_id,
                    'url' => url()->current(),
                    'ip_address' => request()->ip(),
                    'user_agent' => $request->header('User-Agent'),

                );

                $reports = Audit::create($audit);

                $notifyTo = User::whereHas('roles', function($q){$q->whereIn('slug', ['me', 'admin' ]);})->get();
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
            $mentorings = DB::table('mentoring')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','mentoring.branch_id')
                      ->get();

            $participants2018 = DB::table('mentoring')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2018' )
                        ->first();
            $participants2019 = DB::table('mentoring')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2019' )
                        ->first();            
            $participants2020 = DB::table('mentoring')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2020' )
                        ->first();   
            $participants2021 = DB::table('mentoring')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2021' )
                        ->first();

        }
        else{
            $mentorings = DB::table('mentoring')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','mentoring.branch_id')                    
                      ->where('mentoring.branch_id','=',$branch_id)

                      ->get();
        
        //dd($mentorings);

        $participants2018 = DB::table('mentoring')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2018' )
                        ->where('mentoring.branch_id','=',$branch_id)
                        ->first();
                        //->groupBy(function ($val) {
                                // Carbon::parse($val->meeting_date)->format('Y');
                        //});
                        //->groupBy(DB::raw("year(meeting_date)"))
                        
           $participants2019 = DB::table('mentoring')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2019' )
                        ->where('mentoring.branch_id','=',$branch_id)

                        ->first();            
            $participants2020 = DB::table('mentoring')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2020' )
                        ->where('mentoring.branch_id','=',$branch_id)

                        ->first();   
            $participants2021 = DB::table('mentoring')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2021' )
                        ->where('mentoring.branch_id','=',$branch_id)

                        ->first();           
        //dd($participants2018);
        }
        $branches = DB::table('branches')->get();
        return view('Activities.Reports.Education.mentoring')->with(['mentorings'=>$mentorings,'branches'=>$branches,'participants2018'=>$participants2018,'participants2019'=>$participants2019,'participants2020'=>$participants2020,'participants2021'=>$participants2021]);
    }

    public function fetch(Request $request){
        if($request->ajax())
        {
            if($request->dateStart != '' && $request->dateEnd != '')
            {
                $branch_id = Auth::user()->branch;
                
                if($request->branch !=''){
                    $data = DB::table('mentoring') 
                        ->join('branches','branches.id','=','mentoring.branch_id')
                        ->join('resourse_people','resourse_people.id', '=' ,'mentoring.resourse_person_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('branch_id',$request->branch)
                        ->select('mentoring.*','branches.*','mentoring.id as m_id','resourse_people.*','resourse_people.name as r_name')
                        ->orderBy('program_date', 'desc')
                        ->get();

                    $summary  = DB::table('mentoring') 
                        ->join('branches','branches.id','=','mentoring.branch_id')
                        ->where('branch_id',$request->branch)
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->select('branches.name',DB::raw('count(*) as total'), DB::raw('sum(total_male) as total_male'), DB::raw('sum(total_female) as total_female'), DB::raw('sum(pwd_male) as pwd_male'), DB::raw('sum(pwd_female) as pwd_female'), DB::raw('sum(program_cost) as program_cost'))
                        ->groupBy('branch_id')
                        ->get();
                }
                else{
                    
                    if(is_null($branch_id)){

                    $data = DB::table('mentoring') 
                        ->join('branches','branches.id','=','mentoring.branch_id')
                        ->join('resourse_people','resourse_people.id', '=', 'mentoring.resourse_person_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        //->where('mentoring.branch_id','=',$branch_id)
                        ->select('mentoring.*','branches.*','mentoring.id as m_id','resourse_people.*','resourse_people.name as r_name')
                        ->orderBy('program_date', 'desc')
                        ->get();

                        $summary  = DB::table('mentoring') 
                        ->join('branches','branches.id','=','mentoring.branch_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->select('branches.name',DB::raw('count(*) as total'), DB::raw('sum(total_male) as total_male'), DB::raw('sum(total_female) as total_female'), DB::raw('sum(pwd_male) as pwd_male'), DB::raw('sum(pwd_female) as pwd_female'), DB::raw('sum(program_cost) as program_cost'))
                        ->groupBy('branch_id')
                        ->get();
                    }
                    else{
                        $data = DB::table('mentoring') 
                        ->join('branches','branches.id','=','mentoring.branch_id')
                        ->join('resourse_people','resourse_people.id', '=', 'mentoring.resourse_person_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('mentoring.branch_id','=',$branch_id)
                        ->select('mentoring.*','branches.*','mentoring.id as m_id','resourse_people.*','resourse_people.name as r_name')
                        ->orderBy('program_date', 'desc')
                        ->get();

                        $summary = null;
                    }
                }
                
            }
        else
            {
                
                $branch_id = Auth::user()->branch;
                if(is_null($branch_id)){
                    $data = DB::table('mentoring') 
                        ->join('branches','branches.id','=','mentoring.branch_id')
                        ->join('resourse_people','resourse_people.id', '=' ,'mentoring.resourse_person_id')
                        ->select('mentoring.*','branches.*','mentoring.id as m_id','resourse_people.*','resourse_people.name as r_name')
                        ->orderBy('program_date', 'desc')
                        ->get();

                    $summary  = DB::table('mentoring') 
                        ->join('branches','branches.id','=','mentoring.branch_id')
                        ->select('branches.name',DB::raw('count(*) as total'), DB::raw('sum(total_male) as total_male'), DB::raw('sum(total_female) as total_female'), DB::raw('sum(pwd_male) as pwd_male'), DB::raw('sum(pwd_female) as pwd_female'), DB::raw('sum(program_cost) as program_cost'))
                        ->groupBy('branch_id')
                        ->get();
                }
                else{
                    $data = DB::table('mentoring') 
                        ->join('branches','branches.id','=','mentoring.branch_id')
                        ->join('resourse_people','resourse_people.id', '=' ,'mentoring.resourse_person_id')
                        ->select('mentoring.*','branches.*','mentoring.id as m_id','resourse_people.*','resourse_people.name as r_name')
                        ->where('mentoring.branch_id','=',$branch_id)
                        ->orderBy('program_date', 'desc')
                        ->get();

                    $summary = null;
                }
                
            }
                return response()->json(array(
                        'data' => $data,
                        'summary' => $summary
                    ));
        }
    
        

    }

    public function view_meeting($id){
        $meeting = DB::table('mentoring')
                    ->join('resourse_people','resourse_people.id', '=' ,'mentoring.resourse_person_id')
                   ->join('branches','branches.id','=','mentoring.branch_id')
                   ->select('mentoring.*','branches.*','mentoring.id as m_id','resourse_people.*','resourse_people.name as r_name','branches.name as branch_name')
                   ->where('mentoring.id',$id)
                   ->first();
        $participants = DB::table('mentoring_gvt_officials')
                        ->where('mentoring_id',$id)
                        ->get();

        $photos = DB::table('mentoring_images')
                        ->where('mentoring_id',$id)
                        ->get();
       // dd($meeting);
        //dd($participants);

        return response()->json(array(
            'participants' => $participants,
            'meeting' => $meeting,
            'photos' => $photos,
        ));
        

    }

    public function download($file_name){
        //$file_name = $request->attendance;
        $file = storage_path('activities/files/mentoring/attendance/'.$file_name.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'application/pdf',
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }

    public function download_photos($id){
        $photos = DB::table('mentoring_images')
            ->where('mentoring_id',$id)
            ->select('mentoring_images.image')
            ->get();

        foreach($photos as $photo){
            //echo $photo->image;
            $headers = ["Content-Type"=>"application/zip"];
            //$paths = storage_path('activities/files/mentoring/images/'.$photo->image.'');
            $zipper = Zipper::make(storage_path('activities/files/mentoring/images/'.$id.'.zip'))->add(storage_path('activities/files/mentoring/images/'.$photo->image.''))->close();
            return response()->download(storage_path('activities/files/mentoring/images/'.$id.'.zip',$headers)); 

        }

        //$photos_array = $photos->toArray();
        //dd($photos);
       // Zipper::make('mydir/photos.zip')->add($paths);
       // return response()->download(('mydir/photos.zip')); 
    }
}

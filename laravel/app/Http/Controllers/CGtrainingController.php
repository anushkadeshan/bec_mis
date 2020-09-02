<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Zipper;
use Auth;
use Illuminate\Support\Facades\URL;
use App\Audit;
use App\User;
use App\Notifications\CompletionReport;

class CGtrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.career-guidance.cg_training')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
    		    'program_cost'  => 'required',
    		    'total_male'  => 'required',
    		    'total_female'  => 'required',
    		    'mode_of_conduct'  => 'required',
                'district' => 'required',
                'dm_name' =>'required',
                'title_of_action' =>'required',	
                'activity_code' =>'required',	
                'program_date'	=>'required',
                'time_start'=>'required',
                'time_end' =>'required',
                'venue'	=>'required',
                'images.*' => 'image|mimes:jpeg,jpg,png,gif,svg|max:200000',
                'attendance' => 'mimes:jpeg,jpg,png,gif,svg,pdf|max:200000',
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
                if($request->hasFile('attendance')){
	            	$input['attendance'] = time().'.'.$request->file('attendance')->getClientOriginalExtension();
	            	$request->attendance->move(storage_path('activities/files/cg_training/attendance'), $input['attendance']);
            	}
            	if($request->hasFile('test')){
	            	$input['test'] = time().'.'.$request->file('test')->getClientOriginalExtension();
	            	$request->test->move(storage_path('activities/files/cg_training/pre-pro-test'), $input['test']);
                }
                $data1 = array(
                	'district' => $request->district,
                	'dsd' => json_encode($request->dsd),
                	'gnd' => json_encode($request->gnd),
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
	                'mode_of_conduct'=>$request->mode_of_conduct,
	                'topics'=>$request->topics,
	                'deliverables'=>$request->deliverables,
	                'resourse_person_id'=>$request->resourse_person_id,
	                'attendance' => $input['attendance'],
	                'test' => $input['test'],
	                'branch_id'	=> $branch_id,
                    'created_at' => date('Y-m-d H:i:s')
                );

                //insert general data 
                $cg_trainings = DB::table('cg_trainings')->insert($data1);
                $cg_trainings_id = DB::getPdo()->lastInsertId();

                 //insert images
                $input = $request->all();
                if($request->hasFile('images')){
	                foreach ($request->file('images') as $key => $value) {
	            	$imageName = time(). $key . '.' . $value->getClientOriginalExtension();
	            	$value->move(storage_path('activities/files/cg_training/images'), $imageName);
	            	$images = DB::table('cg_trainings_photos')->insert(['images'=>$imageName,'cg_trainings_id'=>$cg_trainings_id]);
	        		} 
	        	}

                $audit = array(
                    'user_type' => 'App\User',
                    'user_id' => Auth::user()->id,
                    'event' => 'created',
                    'auditable_type' => 'cg_trainings',
                    'auditable_id' => $cg_trainings_id,
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
        $meetings = DB::table('cg_trainings')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','cg_trainings.branch_id')
                      ->get();
        //dd($mentorings);

        $participants2018 = DB::table('cg_trainings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2018' )
                        ->first();
                        //->groupBy(function ($val) {
                                // Carbon::parse($val->meeting_date)->format('Y');
                        //});
                        //->groupBy(DB::raw("year(meeting_date)"))
                        
           $participants2019 = DB::table('cg_trainings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2019' )
                        ->first();            
            $participants2020 = DB::table('cg_trainings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2020' )
                        ->first();   
            $participants2021 = DB::table('cg_trainings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2021' )
                        ->first();           
        //dd($participants2018);
        }
        else{
            $meetings = DB::table('cg_trainings')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','cg_trainings.branch_id')
                      ->where('cg_trainings.branch_id','=',$branch_id)
                      ->get();
        //dd($mentorings);

        $participants2018 = DB::table('cg_trainings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2018' )
                      ->where('cg_trainings.branch_id','=',$branch_id)
                        ->first();
                        //->groupBy(function ($val) {
                                // Carbon::parse($val->meeting_date)->format('Y');
                        //});
                        //->groupBy(DB::raw("year(meeting_date)"))
                        
           $participants2019 = DB::table('cg_trainings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2019' )
                      ->where('cg_trainings.branch_id','=',$branch_id)
                        ->first();            
            $participants2020 = DB::table('cg_trainings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2020' )
                      ->where('cg_trainings.branch_id','=',$branch_id)
                        ->first();   
            $participants2021 = DB::table('cg_trainings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2021' )
                        ->where('cg_trainings.branch_id','=',$branch_id)
                        ->first();           
        //dd($participants2018);
        }
        $branches = DB::table('branches')->get();
        return view('Activities.Reports.career-guidance.cg-training')->with(['meetings'=>$meetings,'branches'=>$branches,'participants2018'=>$participants2018,'participants2019'=>$participants2019,'participants2020'=>$participants2020,'participants2021'=>$participants2021]);
    }

    public function fetch(Request $request){
        if($request->ajax())
        {
            if($request->dateStart != '' && $request->dateEnd != '')
            {
                $branch_id = Auth::user()->branch;
                if($request->branch !=''){
                    $data = DB::table('cg_trainings') 
                        ->join('branches','branches.id','=','cg_trainings.branch_id')
                        ->join('resourse_people','resourse_people.id', '=' ,'cg_trainings.resourse_person_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('branch_id',$request->branch)
                        ->select('cg_trainings.*','branches.*','cg_trainings.id as m_id','resourse_people.*','resourse_people.name as r_name','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();

                    $summary = DB::table('cg_trainings') 
                        ->join('branches','branches.id','=','cg_trainings.branch_id')
                        ->select('branches.name','dsd',DB::raw('count(*) as total'), DB::raw('sum(total_male) as male'), DB::raw('sum(total_female) as female'), DB::raw('sum(program_cost) as cost'))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('branch_id',$request->branch)
                        ->groupBy('branch_id')
                        ->get();
                }
                else{
                    
                if(is_null($branch_id)){

                    $data = DB::table('cg_trainings') 
                        ->join('branches','branches.id','=','cg_trainings.branch_id')
                        ->join('resourse_people','resourse_people.id', '=' ,'cg_trainings.resourse_person_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->select('cg_trainings.*','branches.*','cg_trainings.id as m_id','resourse_people.*','resourse_people.name as r_name','branches.name as branch_name')                     
                        //->where('cg_trainings.branch_id','=',$branch_id)
                        ->orderBy('program_date', 'desc')
                        ->get();

                    $summary = DB::table('cg_trainings') 
                        ->join('branches','branches.id','=','cg_trainings.branch_id')
                        ->select('branches.name','dsd',DB::raw('count(*) as total'), DB::raw('sum(total_male) as male'), DB::raw('sum(total_female) as female'), DB::raw('sum(program_cost) as cost'))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->groupBy('branch_id')
                        ->get();
                }
                else{
                    $data = DB::table('cg_trainings') 
                        ->join('branches','branches.id','=','cg_trainings.branch_id')
                        ->join('resourse_people','resourse_people.id', '=' ,'cg_trainings.resourse_person_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('cg_trainings.branch_id','=',$branch_id)
                        ->select('cg_trainings.*','branches.*','cg_trainings.id as m_id','resourse_people.*','resourse_people.name as r_name','branches.name as branch_name')                     
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
                $data = DB::table('cg_trainings') 
                        ->join('branches','branches.id','=','cg_trainings.branch_id')
                        ->join('resourse_people','resourse_people.id', '=' ,'cg_trainings.resourse_person_id')
                        ->select('cg_trainings.*','branches.*','cg_trainings.id as m_id','resourse_people.*','resourse_people.name as r_name','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();

                $summary = DB::table('cg_trainings') 
                        ->join('branches','branches.id','=','cg_trainings.branch_id')
                        ->select('branches.name','dsd',DB::raw('count(*) as total'), DB::raw('sum(total_male) as male'), DB::raw('sum(total_female) as female'), DB::raw('sum(program_cost) as cost'))
                        ->groupBy('branch_id')
                        ->get();

                }
                else{
                    $data = DB::table('cg_trainings') 
                        ->join('branches','branches.id','=','cg_trainings.branch_id')
                        ->join('resourse_people','resourse_people.id', '=' ,'cg_trainings.resourse_person_id')
                        ->select('cg_trainings.*','branches.*','cg_trainings.id as m_id','resourse_people.*','resourse_people.name as r_name','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')                      
                        ->where('cg_trainings.branch_id','=',$branch_id)
                        ->get();

                    $summary = null;
                }
            }
                return response()->json(array(
                    'data' =>  $data,
                    'summary' => $summary

                ));
        }
    }

    public function view_meeting($id){
        $meeting = DB::table('cg_trainings')
                    ->join('resourse_people','resourse_people.id', '=' ,'cg_trainings.resourse_person_id')
                   ->join('branches','branches.id','=','cg_trainings.branch_id')
                    ->join('dsd_office','dsd_office.ID', '=' ,'cg_trainings.dsd')
                   ->select('cg_trainings.*','branches.*','cg_trainings.id as m_id','resourse_people.*','resourse_people.name as r_name','branches.name as branch_name','dsd_office.*')
                   ->where('cg_trainings.id',$id)
                   ->first();

        $photos = DB::table('cg_trainings_photos')
                        ->where('cg_trainings_id',$id)
                        ->get();

       // dd($meeting);
        //dd($participants);

        return response()->json(array( 
            'meeting' => $meeting,
            'photos' => $photos,
        ));
        

    }

    public function download($file_name){
        //$file_name = $request->attendance;
        $file = storage_path('activities/files/cg_training/attendance/'.$file_name.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'application/pdf',
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }

    public function download_test($id){
        //$file_name = $request->attendance;
        $file = storage_path('activities/files/cg_training/pre-pro-test/'.$id.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'application/pdf',
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }
    public function download_photos($id){
        $photos = DB::table('cg_trainings_photos')
                  ->where('cg_trainings_id',$id)
                  ->select('cg_trainings_photos.images')
                  ->get();
        foreach($photos as $photo){
            //echo $photo->images;
            $headers = ["Content-Type"=>"application/zip"];
            //$paths = storage_path('activities/files/mentoring/images/'.$photo->image.'');
            $zipper = Zipper::make(storage_path('activities/files/cg_training/images/'.$id.'.zip'))->add(storage_path('activities/files/cg_training/images/'.$photo->images.''))->close();
        }
            return response()->download(storage_path('activities/files/cg_training/images/'.$id.'.zip','photos',$headers)); 

        //$photos_array = $photos->toArray();
        //dd($photos);
       // Zipper::make('mydir/photos.zip')->add($paths);
       // return response()->download(('mydir/photos.zip')); 
    }

    public function edit($id){

      $meeting = DB::table('cg_trainings')
                    ->join('resourse_people','resourse_people.id', '=' ,'cg_trainings.resourse_person_id')
                   ->join('dsd_office','dsd_office.ID', '=' ,'cg_trainings.dsd')
                   ->join('branches','branches.id','=','cg_trainings.branch_id')
                   ->select('cg_trainings.*','branches.*','cg_trainings.id as m_id','resourse_people.*','resourse_people.name as r_name','branches.name as branch_name','dsd_office.*')
                   ->where('cg_trainings.id',$id)
                   ->first();

        return view ('Activities.career-guidance.edit.cg-training')->with(['meeting'=> $meeting]);

    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
                'program_date'  =>'required',
                'time_start'=>'required',
                'time_end' =>'required',
                'venue' =>'required',
                
            ]);

        if($validator->passes()){
        // echo "<script>console.log( 'Debug Objects: " . $meeting_date . "' );</script>";

        $data1 = array( 
            'program_date'  =>$request->program_date,
            'time_start'=>$request->time_start,
            'time_end' =>$request->time_end,
            'venue' =>$request->venue,
            'program_cost' =>$request->program_cost,
            'total_male' => $request->total_male,
            'total_female'=>$request->total_female,
            'pwd_male'=>$request->pwd_male,
            'pwd_female'=>$request->pwd_female,
            'mode_of_conduct'=>$request->mode_of_conduct,
            'topics'=>$request->topics,
            'deliverables'=>$request->deliverables,
            'resourse_person_id'=>$request->resourse_person_id,
        );
        //dd($data1);
        DB::table('cg_trainings')->whereid($request->m_id)->update($data1);

        $audit = array(
            'user_type' => 'App\User',
            'user_id' => Auth::user()->id,
            'event' => 'updated',
            'auditable_type' => 'cg_trainings',
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

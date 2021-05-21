<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Zipper;
use Auth;
use Illuminate\Support\Facades\URL;
use App\Audit;
use App\User;
use App\Notifications\CompletionReport;

class AwarenessController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.job-linking.awareness')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
    		'district' => 'required',
    		'dm_name' => 'required',
    		'program_date' => 'required',
    	]);

    	if($validator->passes()){

            $branch_id = auth()->user()->branch;
            $input = $request->all();


            if($request->hasFile('attendance')){
                $input['attendance'] = time().'.'.$request->file('attendance')->getClientOriginalExtension();
                $request->attendance->move(storage_path('activities/files/job-linking/awareness/attendance'), $input['attendance']);
            }

    		$data = array(
	    		'district' => $request->district,
	        	'dsd' => json_encode($request->dsd),
	            'dm_name' =>$request->dm_name,
	            'title_of_action' =>$request->title_of_action,	
	            'activity_code' =>$request->activity_code,	
	            'program_date'	=>$request->program_date,
	            'time_start'=>$request->time_start,
	            'time_end' =>$request->time_end,
	            'venue'	=>$request->venue,
	            'cost' =>$request->cost,
	            'total_male' => $request->total_male,
	            'total_female'=>$request->total_female,
	            'pwd_male'=>$request->pwd_male,
	            'pwd_female'=>$request->pwd_female,
	            'mode_of_awareness'=>$request->mode_of_awareness,
	            'topics'=>$request->topics,
	            'deliverables'=>$request->deliverables,
	            'exposure_visit'=>$request->exposure_visit,
	            'palce'=>$request->palce,
	            'demonstraion'=>$request->demonstraion,
	            'matters_discussed'=>$request->matters_discussed,
	            'any_concerns'=>$request->any_concerns,
	            'attendance' => $input['attendance'],
	            'branch_id'	=> $branch_id,
	            'created_at' => date('Y-m-d H:i:s')
            );

            $awareness = DB::table('awareness')->insert($data);
            $awareness_id = DB::getPdo()->lastInsertId();



            //insert images
                $input = $request->all();
                if($request->hasFile('images')){
                    foreach ($request->file('images') as $key => $value) {
                	$imageName = time(). $key . '.' . $value->getClientOriginalExtension();
                	$value->move(storage_path('activities/files/job-linking/awareness/images'), $imageName);
                	$images = DB::table('awareness_photos')->insert(['images'=>$imageName,'awareness_id'=>$awareness_id]);
            		}
                }

                $audit = array(
                    'user_type' => 'App\User',
                    'user_id' => Auth::user()->id,
                    'event' => 'created',
                    'auditable_type' => 'awareness',
                    'auditable_id' => $awareness_id,
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
    		return response()->json(['error'=> $validator->errors()->all()]);
    	}
    }

     public function view(){
        $branch_id = Auth::user()->branch;
        if(is_null($branch_id)){

        $meetings = DB::table('awareness')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','awareness.branch_id')
                      ->get();
        //dd($mentorings);

        $participants2018 = DB::table('awareness')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2018' )
                        ->first();
                        //->groupBy(function ($val) {
                                // Carbon::parse($val->program_date)->format('Y');
                        //});
                        //->groupBy(DB::raw("year(program_date)"))
                        
           $participants2019 = DB::table('awareness')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2019' )
                        ->first();            
            $participants2020 = DB::table('awareness')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2020' )
                        ->first();   
            $participants2021 = DB::table('awareness')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2021' )
                        ->first();  
        }
        else{
            $meetings = DB::table('awareness')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','awareness.branch_id')
                      ->where('awareness.branch_id','=',$branch_id)
                      ->get();                        

        //dd($mentorings);

        $participants2018 = DB::table('awareness')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2018' )
                        ->where('awareness.branch_id','=',$branch_id)
                        ->first();
                        //->groupBy(function ($val) {
                                // Carbon::parse($val->program_date)->format('Y');
                        //});
                        //->groupBy(DB::raw("year(program_date)"))
                        
           $participants2019 = DB::table('awareness')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2019' )
                        ->where('awareness.branch_id','=',$branch_id)
                        ->first();            
            $participants2020 = DB::table('awareness')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2020' )
                        ->where('awareness.branch_id','=',$branch_id)
                        ->first();   
            $participants2021 = DB::table('awareness')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2021' )
                        ->where('awareness.branch_id','=',$branch_id)
                        ->first(); 
        }         
        //dd($participants2018);
        $branches = DB::table('branches')->get();
        return view('Activities.Reports.Job-Linking.awareness')->with(['meetings'=>$meetings,'branches'=>$branches,'participants2018'=>$participants2018,'participants2019'=>$participants2019,'participants2020'=>$participants2020,'participants2021'=>$participants2021]);
    }

    public function fetch(Request $request){
        if($request->ajax())
        {
            $branch_id = Auth::user()->branch;

            if($request->dateStart != '' && $request->dateEnd != '')
            {
                if($request->branch !=''){
                    $data = DB::table('awareness') 
                        ->join('branches','branches.id','=','awareness.branch_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('branch_id',$request->branch)
                        ->select('awareness.*','branches.*','awareness.id as m_id','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();

                    $summary =DB::table('awareness') 
                        ->join('branches','branches.id','=','awareness.branch_id')
                        ->select('branches.name', DB::raw('count(*) as total'), DB::raw('sum(total_male) as male'), DB::raw('sum(total_female) as female'), DB::raw('sum(cost) as cost'))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('branch_id',$request->branch)
                        ->groupBy('branch_id')
                        ->get();
                        
                }
                else{
                    if(is_null($branch_id)){
                    $data = DB::table('awareness') 
                        ->join('branches','branches.id','=','awareness.branch_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->select('awareness.*','branches.*','awareness.id as m_id','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();

                    $summary =DB::table('awareness') 
                        ->join('branches','branches.id','=','awareness.branch_id')
                        ->select('branches.name', DB::raw('count(*) as total'), DB::raw('sum(total_male) as male'), DB::raw('sum(total_female) as female'), DB::raw('sum(cost) as cost'))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->groupBy('branch_id')
                        ->get();

                    }
                    else{
                       $data = DB::table('awareness') 
                        ->join('branches','branches.id','=','awareness.branch_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('awareness.branch_id','=',$branch_id)
                        ->select('awareness.*','branches.*','awareness.id as m_id','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get(); 

                    $summary = null;

                    }
                }
                
            }
        else
            {
                if(is_null($branch_id)){
                $data = DB::table('awareness') 
                        ->join('branches','branches.id','=','awareness.branch_id')
                        ->select('awareness.*','branches.*','awareness.id as m_id','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();

                $summary =DB::table('awareness') 
                        ->join('branches','branches.id','=','awareness.branch_id')
                        ->select('branches.name', DB::raw('count(*) as total'), DB::raw('sum(total_male) as male'), DB::raw('sum(total_female) as female'), DB::raw('sum(cost) as cost'))
                        ->groupBy('branch_id')
                        ->get();

                }
                else{
                    $data = DB::table('awareness') 
                        ->join('branches','branches.id','=','awareness.branch_id')
                        ->where('awareness.branch_id','=',$branch_id)
                        ->select('awareness.*','branches.*','awareness.id as m_id','branches.name as branch_name')
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
        $meeting = DB::table('awareness')
                   ->join('branches','branches.id','=','awareness.branch_id')
                   ->select('awareness.*','branches.*','awareness.id as m_id','branches.name as branch_name')
                   ->where('awareness.id',$id)
                   ->first();

       // dd($meeting);
        //dd($participants);

        return response()->json(array( 
            'meeting' => $meeting,
        ));
        

    }

    public function download($file_name){
        //$file_name = $request->attendance;
        $file = storage_path('activities/files/job-linking/awareness/attendance/'.$file_name.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'application/pdf',
                  'Content-Type' => 'application/msword',
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }

    public function download_photos($id){
        $photos = DB::table('awareness_photos')
                  ->where('awareness_id',$id)
                  ->select('awareness_photos.images')
                  ->get();
        foreach($photos as $photo){
            //echo $photo->images;
            $headers = ["Content-Type"=>"application/zip"];
            //$paths = storage_path('activities/files/mentoring/images/'.$photo->image.'');
            $zipper = Zipper::make(storage_path('activities/files/job-linking/awareness/images/'.$id.'.zip'))->add(storage_path('activities/files/job-linking/awareness/images/'.$photo->images.''))->close();
        }
            return response()->download(storage_path('activities/files/job-linking/awareness/images/'.$id.'.zip','photos',$headers)); 

        //$photos_array = $photos->toArray();
        //dd($photos);
       // Zipper::make('mydir/photos.zip')->add($paths);
       // return response()->download(('mydir/photos.zip')); 
    }

    public function edit($id){

      $meeting = DB::table('awareness')
                   ->join('branches','branches.id','=','awareness.branch_id')
                   ->select('awareness.*','branches.*','awareness.id as m_id','branches.name as branch_name')
                   ->where('awareness.id',$id)
                   ->first();

        return view ('Activities.job-linking.edit.awareness')->with(['meeting'=> $meeting]);

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
                'venue' =>$request->venue,
                'cost' =>$request->cost,
                'total_male' => $request->total_male,
                'total_female'=>$request->total_female,
                'pwd_male'=>$request->pwd_male,
                'pwd_female'=>$request->pwd_female,
                'mode_of_awareness'=>$request->mode_of_awareness,
                'topics'=>$request->topics,
                'deliverables'=>$request->deliverables,
                'exposure_visit'=>$request->exposure_visit,
                'palce'=>$request->palce,
                'demonstraion'=>$request->demonstraion,
                'matters_discussed'=>$request->matters_discussed,
                'any_concerns'=>$request->any_concerns,
            
        );
        //dd($data1);
        DB::table('awareness')->whereid($request->m_id)->update($data1);

        $audit = array(
            'user_type' => 'App\User',
            'user_id' => Auth::user()->id,
            'event' => 'updated',
            'auditable_type' => 'awareness',
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

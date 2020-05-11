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

class IncoperationSoftSkillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.skill-development.incoperate')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
    		    'program_date'  => 'required',
                'district' => 'required',
                'dm_name' =>'required',	
                'institute_id' => 'required',
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
            
            	if($request->hasFile('gsrn')){
	            	$input['gsrn'] = time().'.'.$request->file('gsrn')->getClientOriginalExtension();
	            	$request->gsrn->move(storage_path('activities/files/skill/incoperate/gsrn'), $input['gsrn']);
            	}
                $data1 = array(
                	'district' => $request->district,
                	'dsd' => $request->dsd,
	                'dm_name' =>$request->dm_name,
	                'title_of_action' =>$request->title_of_action,  
                    'activity_code' =>$request->activity_code,	
	                'program_date'	=>$request->program_date,	               
	                'institute_id'	=>$request->institute_id, 
	                'tvec_ex_date' => $request->tvec_ex_date,
	                'nature_of_assistance' => $request->nature_of_assistance,
	                'review_report' => $request->review_report,
	                'gsrn' => $input['gsrn'],
	                'branch_id'	=> $branch_id,
	                'created_at' => date('Y-m-d H:i:s')
                );

                //insert general data 
                $incoperation = DB::table('incoperation_soft_skills')->insert($data1);
                $iss_id = DB::getPdo()->lastInsertId();

                //insert photos
				if($request->hasFile('images')){
                    foreach ($request->file('images') as $key => $value) {
                	$imageName = time(). $key . '.' . $value->getClientOriginalExtension();
                	$value->move(storage_path('activities/files/skill/incoperate/images'), $imageName);
                	$images = DB::table('incoperation_soft_skills_photos')->insert(['images'=>$imageName,'iss_id'=>$iss_id]);
            		}
                }

                $audit = array(
                    'user_type' => 'App\User',
                    'user_id' => Auth::user()->id,
                    'event' => 'created',
                    'auditable_type' => 'incoperation_soft_skills',
                    'auditable_id' => $iss_id,
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
        $meetings = DB::table('incoperation_soft_skills')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','incoperation_soft_skills.branch_id')
                      ->get();
        //dd($mentorings);       
        //dd($participants2018);
        $branches = DB::table('branches')->get();

        $institutes = DB::table('incoperation_soft_skills')
                   ->join('institutes','institutes.id','=','incoperation_soft_skills.institute_id')
                   ->select('institutes.name as institute_name','institutes.*')
                   ->distinct()
                   ->get();
        }
        else{
          $meetings = DB::table('incoperation_soft_skills')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','incoperation_soft_skills.branch_id')                      
                      ->where('incoperation_soft_skills.branch_id','=',$branch_id)
                      ->get();
        //dd($mentorings);       
        //dd($participants2018);
        $branches = DB::table('branches')->get();

        $institutes = DB::table('incoperation_soft_skills')
                   ->join('institutes','institutes.id','=','incoperation_soft_skills.institute_id')
                   ->select('institutes.name as institute_name','institutes.*')
                   ->where('incoperation_soft_skills.branch_id','=',$branch_id)
                   ->distinct()
                   ->get();
        }
        return view('Activities.Reports.Skill-Development.incoperation')->with(['meetings'=>$meetings,'branches'=>$branches,'institutes'=>$institutes]);
    }

    public function fetch(Request $request){
        if($request->ajax())
        {
            $branch_id = Auth::user()->branch;

            if($request->dateStart != '' && $request->dateEnd != '')
            {

                   if($request->branch!=''){
                    $data = DB::table('incoperation_soft_skills') 
                      ->join('branches','branches.id','=','incoperation_soft_skills.branch_id')
                      ->join('institutes','institutes.id','=','incoperation_soft_skills.institute_id')
                      ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                      ->where('branch_id',$request->branch)
                      ->select('incoperation_soft_skills.*','branches.*','incoperation_soft_skills.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date')
                      ->orderBy('program_date', 'desc')
                      ->get();    

                      $summary =DB::table('incoperation_soft_skills') 
                        ->join('branches','branches.id','=','incoperation_soft_skills.branch_id')
                        ->join('institutes','institutes.id','=','incoperation_soft_skills.institute_id')
                        ->select('branches.name', DB::raw('count(*) as total'), DB::raw("COUNT((CASE WHEN is_registerd = 'Yes' THEN is_registerd END)) as tvec"))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('branch_id',$request->branch)
                        ->groupBy('branch_id')
                        ->get();
          
                   }
                   else{

                    if(is_null($branch_id)){
                    $data = DB::table('incoperation_soft_skills') 
                        ->join('branches','branches.id','=','incoperation_soft_skills.branch_id')
                        ->join('institutes','institutes.id','=','incoperation_soft_skills.institute_id')
                        ->select('incoperation_soft_skills.*','branches.*','incoperation_soft_skills.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->select('incoperation_soft_skills.*','branches.*','incoperation_soft_skills.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date')
                        ->orderBy('program_date', 'desc')
                        ->get();

                    $summary =DB::table('incoperation_soft_skills') 
                        ->join('branches','branches.id','=','incoperation_soft_skills.branch_id')
                        ->join('institutes','institutes.id','=','incoperation_soft_skills.institute_id')
                        ->select('branches.name', DB::raw('count(*) as total'), DB::raw("COUNT((CASE WHEN is_registerd = 'Yes' THEN is_registerd END)) as tvec"))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->groupBy('branch_id')
                        ->get();

                    }
                    else{
                      $data = DB::table('incoperation_soft_skills') 
                        ->join('branches','branches.id','=','incoperation_soft_skills.branch_id')
                        ->join('institutes','institutes.id','=','incoperation_soft_skills.institute_id')
                        ->where('incoperation_soft_skills.branch_id','=',$branch_id)
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->select('incoperation_soft_skills.*','branches.*','incoperation_soft_skills.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date')
                        ->orderBy('program_date', 'desc')
                        ->get();

                  $summary = null;

                    }
                    }
     
            }
        else
            {
                if(is_null($branch_id)){
                
                $data = DB::table('incoperation_soft_skills') 
                        ->join('branches','branches.id','=','incoperation_soft_skills.branch_id')
                        ->join('institutes','institutes.id','=','incoperation_soft_skills.institute_id')
                        ->select('incoperation_soft_skills.*','branches.*','incoperation_soft_skills.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date')
                        ->orderBy('program_date', 'desc')
                        ->get();

                $summary =DB::table('incoperation_soft_skills') 
                        ->join('branches','branches.id','=','incoperation_soft_skills.branch_id')
                        ->join('institutes','institutes.id','=','incoperation_soft_skills.institute_id')
                        ->select('branches.name', DB::raw('count(*) as total'), DB::raw("COUNT((CASE WHEN is_registerd = 'Yes' THEN is_registerd END)) as tvec"))
                        ->groupBy('branch_id')
                        ->get();

                }
                else{
                $data = DB::table('incoperation_soft_skills') 
                        ->join('branches','branches.id','=','incoperation_soft_skills.branch_id')
                        ->join('institutes','institutes.id','=','incoperation_soft_skills.institute_id')
                        ->select('incoperation_soft_skills.*','branches.*','incoperation_soft_skills.id as m_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date')
                        ->where('incoperation_soft_skills.branch_id','=',$branch_id)
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
        $meeting = DB::table('incoperation_soft_skills')
                   ->join('branches','branches.id','=','incoperation_soft_skills.branch_id')
                   ->join('institutes','institutes.id','=','incoperation_soft_skills.institute_id')
                   ->select('incoperation_soft_skills.*','branches.*','incoperation_soft_skills.id as m_id','incoperation_soft_skills.institute_id as i_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date')
                   ->where('incoperation_soft_skills.id',$id)
                   ->first();


       // dd($meeting);
        //dd($participants);

        return response()->json(array(
            'meeting' => $meeting,

        ));
        

    }

    public function download($file_name){
        //$file_name = $request->attendance;
        $file = storage_path('activities/files/skill/incoperate/gsrn/'.$file_name.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'application/pdf',
                  'Content-Type' => 'application/msword',
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }

    public function download_photos($id){
        $photos = DB::table('incoperation_soft_skills_photos')
            ->where('iss_id',$id)
            ->select('incoperation_soft_skills_photos.images')
            ->get();

        foreach($photos as $photo){
            //echo $photo->images;
            //$paths = storage_path('activities/files/mentoring/images/'.$photo->image.'');
            $headers = ["Content-Type"=>"application/zip"];
            
            $zipper = Zipper::make(storage_path('activities/files/skill/incoperate/images/'.$id.'.zip'))->add(storage_path('activities/files/skill/incoperate/images/'.$photo->images.''))->close();

        return response()->download(storage_path('activities/files/skill/incoperate/images/'.$id.'.zip','photos',$headers)); 

        }


        //$photos_array = $photos->toArray();
        //dd($photos);
       // Zipper::make('mydir/photos.zip')->add($paths);
       // return response()->download(('mydir/photos.zip')); 
    }

    public function edit($id){

      $meeting = DB::table('incoperation_soft_skills')
                   ->join('branches','branches.id','=','incoperation_soft_skills.branch_id')
                   ->join('institutes','institutes.id','=','incoperation_soft_skills.institute_id')
                   ->select('incoperation_soft_skills.*','branches.*','incoperation_soft_skills.id as m_id','incoperation_soft_skills.institute_id as i_id','institutes.*','institutes.name as institute_name','branches.name as branch_name','program_date as meeting_date')
                   ->where('incoperation_soft_skills.id',$id)
                   ->first();

        return view ('Activities.skill-development.edit.incoperation')->with(['meeting'=> $meeting]);

    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
                'program_date'  =>'required',
                
            ]);

        if($validator->passes()){
        // echo "<script>console.log( 'Debug Objects: " . $meeting_date . "' );</script>";

        $data1 = array(    
            'program_date' =>$request->program_date,                 
            'institute_id'  =>$request->institute_id, 
            'tvec_ex_date' => $request->tvec_ex_date,
            'nature_of_assistance' => $request->nature_of_assistance,
            
        );
        //dd($data1);
        DB::table('incoperation_soft_skills')->whereid($request->m_id)->update($data1);

        $audit = array(
            'user_type' => 'App\User',
            'user_id' => Auth::user()->id,
            'event' => 'updated',
            'auditable_type' => 'incoperation_soft_skills',
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

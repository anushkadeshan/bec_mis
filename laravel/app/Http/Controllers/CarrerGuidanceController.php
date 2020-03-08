<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CareerGuidance;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Zipper;
use Illuminate\Support\Facades\URL;
use App\Audit;
use App\User;
use App\Notifications\CompletionReport;

class CarrerGuidanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $districts = DB::table('districts')->get();
        $activities = DB::table('activities')->get();
        $managers = DB::table('branches')->select('manager')->distinct()->get();

    	return view('Activities.career-guidance.youth-career-guidance')->with(['managers'=> $managers, 'districts' => $districts,'activities'=>$activities]);
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
                'program_date'  =>'required',
                'time_start'=>'required',
                'time_end' =>'required',
                'venue' =>'required',
                'image.*' => 'image|mimes:jpeg,jpg,png,gif,svg',
                'attendance' => 'mimes:jpeg,jpg,png,gif,svg,pdf',
            ]);
        if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
                
                if($request->hasFile('attendance')){
                    $input['attendance'] = time().'.'.$request->file('attendance')->getClientOriginalExtension();
                    $request->attendance->move(storage_path('activities/files/career-guidance/attendance'), $input['attendance']);
                }
        	  $data = array(
        	  	    'district' => $request->district,
                    'dsd' => $request->dsd,
                    'gnd' => json_encode($request->gnd),
                    'dm_name' =>$request->dm_name,
                    'title_of_action' =>json_encode($request->title_of_action),  
                    'activity_code' =>json_encode($request->activity_code),  
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
                    'attendance' => $input['attendance'],
                    'branch_id' => $branch_id,
                    'created_at' => date('Y-m-d H:i:s')

        	  );

              $total_youth = ($request->total_male+$request->total_female);
              $number3 = count($request->youth_id);
                //echo "<script>console.log('Debug Objects: " . $number . "' );</script>";
              if($total_youth==$number3){
                  $cg = CareerGuidance::create($data);
                  $career_guidances_id = $cg->id;

              
                
              //insert participants
              $number = count($request->name);
                if($number>0){
                    for($i=0; $i<$number; $i++){
                        $participants = DB::table('cg_participants')->insert(['name'=>$request->name[$i],'type'=>$request->type[$i],'address'=> $request->address[$i],'career_guidances_id'=>$career_guidances_id]);
                    }

                }
                else{
                    return response()->json(['error' => 'Submit Participants Details.']);
                }


            //insert youths
              
                if($number3>0){
                    for($i=0; $i<$number3; $i++){
                        $youth = DB::table('cg_youths')->insert(['youth_id'=>$request->youth_id[$i],'career_field1'=>$request->career_field1[$i], 'career_field2'=>$request->career_field2[$i],'career_field3'=>$request->career_field3[$i],'career_guidances_id'=>$career_guidances_id, 'created_at' => date('Y-m-d H:i:s'),]);
                    }

                }
                else{
                    return response()->json(['error' => 'Submit youths Details.']);
                }

                //insert youth selected
              $number1 = count($request->requirement);
                if($number1>0){
                    for($i=0; $i<$number1; $i++){
                        $youths = DB::table('cg_youth_selected')->insert(['requirement'=>$request->requirement[$i],'male'=>$request->male[$i],'female'=> $request->female[$i],'career_guidances_id'=>$career_guidances_id]);
                    }

                }
                else{
                    return response()->json(['error' => 'Submit Participants Details.']);
                }

                 //insert career test summary
              $number2 = count($request->career_field);
                if($number2>0){
                    for($i=0; $i<$number2; $i++){
                        $youths = DB::table('cg_careertest_summary')->insert(['career_field'=>$request->career_field[$i],'male'=>$request->male1[$i],'female'=> $request->female1[$i],'career_guidances_id'=>$career_guidances_id]);
                    }

                }
                else{
                    return response()->json(['error' => 'Submit Participants Details.']);
                }

                //insert images
                $input = $request->all();
                if($request->hasFile('images')){
                    foreach ($request->file('images') as $key => $value) {
                    $imageName = time(). $key . '.' . $value->getClientOriginalExtension();
                    $value->move(storage_path('activities/files/career-guidance/images'), $imageName);
                    $images = DB::table('cg_images')->insert(['images'=>$imageName,'career_guidances_id'=>$career_guidances_id]);
                    }
                }
            }
            else{

                return response()->json(['error' => 'Youth Details are Mismathcedh']);
                return false;

            }

            $audit = array(
                    'user_type' => 'App\User',
                    'user_id' => Auth::user()->id,
                    'event' => 'created',
                    'auditable_type' => 'CareerGuidance',
                    'auditable_id' => $career_guidances_id,
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

    public function delete(Request $request)
    {
         
        $id = Input::get('id');
        $cg = CareerGuidance::find($id);
        $cg->delete();

    }
    

    public function add_tot(){
        $activities = DB::table('activities')->get();
        return view('Activities.career-guidance.tot-cg')->with(['activities'=>$activities]);
    }

    public function insert_tot(Request $request){
        $validator = Validator::make($request->all(),[
                'program_cost'  => 'required',
                'mode_of_conduct'  => 'required',
                'title_of_action' =>'required', 
                'activity_code' =>'required',   
                'meeting_date'  =>'required',
                'time_start'=>'required',
                'time_end' =>'required',
                'venue' =>'required',
                'image.*' => 'image|mimes:jpeg,jpg,png,gif,svg',
                'attendance' => 'mimes:jpeg,jpg,png,gif,svg,pdf',
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
                $input['attendance'] = time().'.'.$request->file('attendance')->getClientOriginalExtension();
                $request->attendance->move(storage_path('activities/files/tot-cg/attendance'), $input['attendance']);
                $input['training_report'] = time().'.'.$request->file('training_report')->getClientOriginalExtension();
                $request->training_report->move(storage_path('activities/files/tot-cg/training-report'), $input['training_report']);
                $data1 = array(
                    
                    'title_of_action' =>$request->title_of_action,  
                    'activity_code' =>$request->activity_code,  
                    'meeting_date'  =>$request->meeting_date,
                    'days'  =>$request->days,
                    'time_start'=>$request->time_start,
                    'time_end' =>$request->time_end,
                    'venue' =>$request->venue,
                    'program_cost' =>$request->program_cost,
                    'mode_of_conduct'=>$request->mode_of_conduct,
                    'topics'=>$request->topics,
                    'deliverables'=>$request->deliverables,
                    'resourse_person_id'=>$request->resourse_person_id,
                    'attendance' => $input['attendance'],
                    'training_report' => $input['training_report'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'branch_id' => $branch_id
                );

                //insert general data 
                $tot_cg = DB::table('tot_cg')->insert($data1);
                $tot_cg_id = DB::getPdo()->lastInsertId();

                 //insert images
                $input = $request->all();
                foreach ($request->file('image') as $key => $value) {
                $imageName = time(). $key . '.' . $value->getClientOriginalExtension();
                $value->move(storage_path('activities/files/tot-cg/images'), $imageName);
                $images = DB::table('tot_cg_images')->insert(['images'=>$imageName,'tot_cg_id'=>$tot_cg_id]);
                }

                $number = count($request->organization);
                if($number>0){
                    for($i=0; $i<$number; $i++){
                        $participants = DB::table('tot_cg_participants')->insert(['program_date' => $request->meeting_date,'organization'=>$request->organization[$i],'total_male'=>$request->total_male[$i],'total_female'=> $request->total_female[$i],'pwd_male'=> $request->pwd_male[$i],'pwd_female'=> $request->pwd_female[$i],'tot_cg_id'=>$tot_cg_id]);
                    }

                }
                else{
                    return response()->json(['error' => 'Submit Participants Details.']);
                } 

                $audit = array(
                    'user_type' => 'App\User',
                    'user_id' => Auth::user()->id,
                    'event' => 'created',
                    'auditable_type' => 'tot_cg',
                    'auditable_id' => $tot_cg_id,
                    'url' => url()->current(),
                    'ip_address' => request()->ip(),
                    'user_agent' => $request->header('User-Agent'),

                );

                $insert = Audit::create($audit);

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

    public function view(){
        $branch_id = Auth::user()->branch;
        if(is_null($branch_id)){
        $meetings = DB::table('career_guidances')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','career_guidances.branch_id')
                      ->get();
        //dd($mentorings);

        $participants2018 = DB::table('career_guidances')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2018' )
                        ->first();
                        //->groupBy(function ($val) {
                                // Carbon::parse($val->meeting_date)->format('Y');
                        //});
                        //->groupBy(DB::raw("year(meeting_date)"))
                        
           $participants2019 = DB::table('career_guidances')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2019' )
                        ->first();            
            $participants2020 = DB::table('career_guidances')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2020' )
                        ->first();   
            $participants2021 = DB::table('career_guidances')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2021' )
                        ->first();           
        //dd($participants2018);
        }
        else{
            $meetings = DB::table('career_guidances')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','career_guidances.branch_id')
                      ->where('career_guidances.branch_id','=',$branch_id)
                      ->get();
        //dd($mentorings);

        $participants2018 = DB::table('career_guidances')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2018' )
                      ->where('career_guidances.branch_id','=',$branch_id)
                        ->first();
                        //->groupBy(function ($val) {
                                // Carbon::parse($val->meeting_date)->format('Y');
                        //});
                        //->groupBy(DB::raw("year(meeting_date)"))
                        
           $participants2019 = DB::table('career_guidances')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2019' )
                        ->where('career_guidances.branch_id','=',$branch_id)
                        ->first();            
            $participants2020 = DB::table('career_guidances')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2020' )
                        ->where('career_guidances.branch_id','=',$branch_id)
                        ->first();   
            $participants2021 = DB::table('career_guidances')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2021' )
                        ->where('career_guidances.branch_id','=',$branch_id)
                        ->first();  



        }
        $branches = DB::table('branches')->get();
        return view('Activities.Reports.career-guidance.cg')->with(['meetings'=>$meetings,'branches'=>$branches,'participants2018'=>$participants2018,'participants2019'=>$participants2019,'participants2020'=>$participants2020,'participants2021'=>$participants2021]);
    }

    public function fetch(Request $request){
        if($request->ajax())
        {
            if($request->dateStart != '' && $request->dateEnd != '')
            {
                $branch_id = Auth::user()->branch;
                
                if($request->branch !=''){
                    $data = DB::table('career_guidances') 
                        ->join('branches','branches.id','=','career_guidances.branch_id')
                        ->join('resourse_people','resourse_people.id', '=' ,'career_guidances.resourse_person_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('branch_id','=',$request->branch)
                        ->select('career_guidances.*','branches.*','career_guidances.id as m_id','resourse_people.*','resourse_people.name as r_name','branches.name as branch_name','program_date as meeting_date')
                        ->orderBy('program_date', 'desc')
                        ->get();

                    $data1 = DB::table('cg_youth_selected') 
                        ->join('career_guidances','career_guidances.id', '=' ,'cg_youth_selected.career_guidances_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('career_guidances.branch_id','=',$request->branch)
                        ->select('cg_youth_selected.*',DB::raw("SUM(male) as total_male"),DB::raw("SUM(female) as total_female"))
                        ->orderBy('cg_youth_selected.id','asc')
                        ->groupBy('requirement')
                        ->get();

                    //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

                }
                else{

                if(is_null($branch_id)){

                    $data = DB::table('career_guidances') 
                        ->join('branches','branches.id','=','career_guidances.branch_id')
                        ->join('resourse_people','resourse_people.id', '=' ,'career_guidances.resourse_person_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->select('career_guidances.*','branches.*','career_guidances.id as m_id','resourse_people.*','resourse_people.name as r_name','branches.name as branch_name','program_date as meeting_date')
                        //->where('career_guidances.branch_id','=',$branch_id)
                        ->orderBy('program_date', 'desc')
                        ->get();

                    $data1 = DB::table('cg_youth_selected') 
                        ->join('career_guidances','career_guidances.id', '=' ,'cg_youth_selected.career_guidances_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->select('cg_youth_selected.*',DB::raw("SUM(male) as total_male"),DB::raw("SUM(female) as total_female"))
                        ->groupBy('requirement')
                        //->where('career_guidances.branch_id','=',$branch_id)
                        ->orderBy('cg_youth_selected.id','asc')
                        ->get();
                }
                else{
                    $data = DB::table('career_guidances') 
                        ->join('branches','branches.id','=','career_guidances.branch_id')
                        ->join('resourse_people','resourse_people.id', '=' ,'career_guidances.resourse_person_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->select('career_guidances.*','branches.*','career_guidances.id as m_id','resourse_people.*','resourse_people.name as r_name','branches.name as branch_name','program_date as meeting_date')
                        ->where('career_guidances.branch_id','=',$branch_id)
                        ->orderBy('program_date', 'desc')
                        ->get();

                    $data1 = DB::table('cg_youth_selected') 
                        ->join('career_guidances','career_guidances.id', '=' ,'cg_youth_selected.career_guidances_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->select('cg_youth_selected.*',DB::raw("SUM(male) as total_male"),DB::raw("SUM(female) as total_female"))
                        ->groupBy('requirement')
                        ->where('career_guidances.branch_id','=',$branch_id)
                        ->orderBy('cg_youth_selected.id','asc')
                        ->get();
                }
                }
                
            }
        else
            {
                
                $branch_id = Auth::user()->branch;
                if(is_null($branch_id)){
                $data = DB::table('career_guidances') 
                        ->join('branches','branches.id','=','career_guidances.branch_id')
                        ->join('resourse_people','resourse_people.id', '=' ,'career_guidances.resourse_person_id')
                        ->select('career_guidances.*','branches.*','career_guidances.id as m_id','resourse_people.*','resourse_people.name as r_name','branches.name as branch_name','program_date as meeting_date')
                        ->orderBy('program_date', 'desc')
                        ->get();

                $data1 = DB::table('cg_youth_selected') 
                        ->join('career_guidances','career_guidances.id', '=' ,'cg_youth_selected.career_guidances_id')
                        ->select('cg_youth_selected.*',DB::raw("SUM(male) as total_male"),DB::raw("SUM(female) as total_female"))
                        ->groupBy('requirement')
                        ->orderBy('cg_youth_selected.id','asc')
                        ->get();
                }

                else{
                     $data = DB::table('career_guidances') 
                        ->join('branches','branches.id','=','career_guidances.branch_id')
                        ->join('resourse_people','resourse_people.id', '=' ,'career_guidances.resourse_person_id')
                        ->select('career_guidances.*','branches.*','career_guidances.id as m_id','resourse_people.*','resourse_people.name as r_name','branches.name as branch_name','program_date as meeting_date')
                        ->where('career_guidances.branch_id','=',$branch_id)
                        ->orderBy('program_date', 'desc')                     
                        ->get();

                $data1 = DB::table('cg_youth_selected') 
                        ->join('career_guidances','career_guidances.id', '=' ,'cg_youth_selected.career_guidances_id')
                        ->select('cg_youth_selected.*',DB::raw("SUM(male) as total_male"),DB::raw("SUM(female) as total_female"))
                        ->groupBy('requirement')
                        ->where('career_guidances.branch_id','=',$branch_id)
                        ->orderBy('cg_youth_selected.id','asc')
                        ->get();
                }
            }
                //return response()->json($data);
                return response()->json(array( 
                    'data2' => $data,
                    'data1' => $data1,
                ));

                //echo "<script>console.log('Debug Objects: " . $data1 . "' );</script>";
                //dd($data1);
        }
    
        

    }

    public function view_meeting($id){
        $meeting = DB::table('career_guidances')
                    ->join('resourse_people','resourse_people.id', '=' ,'career_guidances.resourse_person_id')
                   ->join('branches','branches.id','=','career_guidances.branch_id')
                   ->select('career_guidances.*','branches.*','career_guidances.id as m_id','resourse_people.*','resourse_people.name as r_name','branches.name as branch_name')
                   ->where('career_guidances.id',$id)
                   ->first();
        $participants = DB::table('cg_participants')
                        ->where('career_guidances_id',$id)
                        ->get();

        $photos = DB::table('cg_images')
                        ->where('career_guidances_id',$id)
                        ->get();

        $cg_youth_selected = DB::table('cg_youth_selected')
                        ->where('career_guidances_id',$id)
                        ->get();
        $cg_careertest_summary = DB::table('cg_careertest_summary')
                        ->where('career_guidances_id',$id)
                        ->get();
        $cg_youths = DB::table('cg_youths')
                    ->join('youths','youths.id','=','cg_youths.youth_id')
                    ->where('career_guidances_id',$id)
                    ->select('cg_youths.*','youths.*','youths.id as youth_id')
                    ->get();

       // dd($meeting);
        //dd($participants);

        return response()->json(array(
            'participants' => $participants,
            'meeting' => $meeting,
            'photos' => $photos,
            'cg_youth_selected' => $cg_youth_selected,
            'cg_careertest_summary' => $cg_careertest_summary,
            'cg_youths' => $cg_youths,

        ));
        

    }

    public function download($file_name){
        //$file_name = $request->attendance;
        $file = storage_path('activities/files/career-guidance/attendance/'.$file_name.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'application/pdf',
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }

    public function download_photos($id){
        $photos = DB::table('cg_images')
                  ->where('career_guidances_id',$id)
                  ->select('cg_images.images')
                  ->get();
        foreach($photos as $photo){
            //echo $photo->images;
            $headers = ["Content-Type"=>"application/zip"];
            //$paths = storage_path('activities/files/mentoring/images/'.$photo->image.'');
            $zipper = Zipper::make(storage_path('activities/files/career-guidance/images/'.$id.'.zip'))->add(storage_path('activities/files/career-guidance/images/'.$photo->images.''))->close();
        }
            return response()->download(storage_path('activities/files/career-guidance/images/'.$id.'.zip','photos',$headers)); 

        //$photos_array = $photos->toArray();
        //dd($photos);
       // Zipper::make('mydir/photos.zip')->add($paths);
       // return response()->download(('mydir/photos.zip')); 
    }

    public function edit($id){

       $meeting = DB::table('career_guidances')
                    ->join('resourse_people','resourse_people.id', '=' ,'career_guidances.resourse_person_id')
                   ->join('branches','branches.id','=','career_guidances.branch_id')
                   ->select('career_guidances.*','branches.*','career_guidances.id as m_id','resourse_people.*','resourse_people.name as r_name','branches.name as branch_name')
                   ->where('career_guidances.id',$id)
                   ->first();
        $participants = DB::table('cg_participants')
                        ->where('career_guidances_id',$id)
                        ->get();

        $photos = DB::table('cg_images')
                        ->where('career_guidances_id',$id)
                        ->get();

        $cg_youth_selected = DB::table('cg_youth_selected')
                        ->where('career_guidances_id',$id)
                        ->get();
        $cg_careertest_summary = DB::table('cg_careertest_summary')
                        ->where('career_guidances_id',$id)
                        ->get();
        $cg_youths = DB::table('cg_youths')
                    ->join('youths','youths.id','=','cg_youths.youth_id')
                    ->where('career_guidances_id',$id)
                    ->select('cg_youths.*','youths.*','youths.id as youth_id','cg_youths.id as cg_youths_id')
                    ->get();

        $activities = DB::table('activities')->get();

        return view ('Activities.career-guidance.edit.cg-youth')->with(['meeting'=> $meeting,'participants'=>$participants,'activities'=>$activities,'cg_youth_selected'=>$cg_youth_selected,'cg_careertest_summary'=>$cg_careertest_summary,'cg_youths'=>$cg_youths]);

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
        DB::table('career_guidances')->whereid($request->m_id)->update($data1);

        $audit = array(
            'user_type' => 'App\User',
            'user_id' => Auth::user()->id,
            'event' => 'updated',
            'auditable_type' => 'career_guidances',
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

    public function update_participants(Request $request){

        $participants = DB::table('cg_participants')
                        ->whereid($request->id_p)
                        ->update(['name'=>$request->name,'type'=>$request->type,'address'=> $request->address]);

    }

    public function add_participants(Request $request){

        $participants = DB::table('cg_participants')
                        ->insert(['name'=>$request->name,'type'=>$request->type,'address'=> $request->address, 'career_guidances_id'=>$request->m_id]);

    }

    public function update_youths(Request $request){

        $participants = DB::table('cg_youths')
                        ->whereid($request->id_y)
                        ->update(['career_field1'=>$request->career_field1,'career_field2'=>$request->career_field2,'career_field3'=> $request->career_field3]);

    }

    public function add_youths(Request $request){

        $participants = DB::table('cg_youths')
                        ->insert(['youth_id'=>$request->youth_id,'career_field1'=>$request->career_field1,'career_field2'=>$request->career_field2,'career_field3'=> $request->career_field3, 'career_guidances_id'=>$request->m_id]);

    }

    public function update_req(Request $request){

        $participants = DB::table('cg_youth_selected')
                        ->whereid($request->id_r)
                        ->update(['male'=>$request->male,'female'=>$request->female]);

    }

    public function update_cts(Request $request){

        $participants = DB::table('cg_careertest_summary')
                        ->whereid($request->id_c)
                        ->update(['male'=>$request->male,'female'=>$request->female]);

    }

    public function view_youths(){
        $branch_id = Auth::user()->branch;
        if(is_null($branch_id)){
        $cg_youths = DB::table('cg_youths')
                    ->join('youths','youths.id','=','cg_youths.youth_id')
                    ->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
                    ->join('branches','branches.id','=','career_guidances.branch_id')
                    ->select('cg_youths.*','youths.*','youths.id as youth_id','branches.*','career_guidances.*','youths.name as youth_name')
                    ->get();
        }
        else{
            $cg_youths = DB::table('cg_youths')
                    ->join('youths','youths.id','=','cg_youths.youth_id')
                    ->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
                    ->join('branches','branches.id','=','career_guidances.branch_id')
                    ->where('career_guidances.branch_id',$branch_id)
                    ->select('cg_youths.*','youths.*','youths.id as youth_id','branches.*','career_guidances.*','youths.name as youth_name')
                    ->get();
        }

        return view('Activities.Reports.career-guidance.cg-youths')->with(['youths'=>$cg_youths]);
    }

    public function youth_progress(){
        $branch_id = Auth::user()->branch;
        if(is_null($branch_id)){
        $cg_youths = DB::table('cg_youths')
                    ->join('youths','youths.id','=','cg_youths.youth_id')
                    ->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
                    ->join('branches','branches.id','=','career_guidances.branch_id')
                    ->select('cg_youths.*','youths.*','youths.id as youth_id','branches.*','career_guidances.*','youths.name as youth_name')
                    ->get();

        }
        else{
            $cg_youths = DB::table('cg_youths')
                    ->join('youths','youths.id','=','cg_youths.youth_id')
                    ->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
                    ->join('branches','branches.id','=','career_guidances.branch_id')
                    ->where('career_guidances.branch_id',$branch_id)
                    ->select('cg_youths.*','youths.*','youths.id as youth_id','branches.*','career_guidances.*','youths.name as youth_name')
                    ->get();
        }
        $branches = DB::table('branches')->get();

        return view('Youth.youth-prgress')->with(['youths'=>$cg_youths,'branches'=> $branches]);
    }

     public function view_tot(){

        $meetings = DB::table('tot_cg')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->get();
        //dd($mentorings);

        $participants2018 = DB::table('tot_cg_participants')                   
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2018' )
                        ->first();
                        //->groupBy(function ($val) {
                                // Carbon::parse($val->meeting_date)->format('Y');
                        //});
                        //->groupBy(DB::raw("year(meeting_date)"))
                        
           $participants2019 = DB::table('tot_cg_participants')                   
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2019' )
                        ->first();  
            $participants2020 = DB::table('tot_cg_participants')                   
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2020' )
                        ->first();
            $participants2021 =DB::table('tot_cg_participants')                   
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2021' )
                        ->first(); 

            $bec = DB::table('tot_cg_participants')                   
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where('organization','BEC')
                       ->first();
                        
           $gvt = DB::table('tot_cg_participants')                   
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where('organization','GVT. Officials')
                        ->first();  
            $gvt_TI = DB::table('tot_cg_participants')                   
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where('organization','GVT. Training Institutes')
                        ->first();
            $pvt_TI =DB::table('tot_cg_participants')                   
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("SUM(pwd_male) as pwd_male"),DB::raw("SUM(pwd_female) as pwd_female"))
                        ->where('organization','PVT. Training Institutes')
                        ->first();    
        //dd($participants2018);
      
        
        $branches = DB::table('branches')->get();
       // dd($participants2018);
        return view('Activities.Reports.career-guidance.tot')->with(['meetings'=>$meetings,'branches'=>$branches,'participants2018'=>$participants2018,'participants2019'=>$participants2019,'participants2020'=>$participants2020,'participants2021'=>$participants2021,'bec'=> $bec,'gvt' => $gvt,'gvt_TI'=>$gvt_TI,'pvt_TI'=>$pvt_TI]);
    }

    public function fetch_tot(Request $request){
        if($request->ajax())
        {
            if($request->dateStart != '' && $request->dateEnd != '')
            {
        
     
                    $data = DB::table('tot_cg') 
                        ->whereBetween('meeting_date', array($request->dateStart, $request->dateEnd))
                        ->select('tot_cg.*','tot_cg.id as m_id')
                       // ->where('branch_id',$branch_id)
                        ->orderBy('meeting_date', 'desc')
                        ->get();

                    $data1 = DB::table('tot_cg_participants') 
                        ->join('tot_cg','tot_cg.id','=','tot_cg_participants.tot_cg_id')
                        ->whereBetween('meeting_date', array($request->dateStart, $request->dateEnd))
                       // ->where('tot_cg.branch_id',$branch_id)
                        ->orderBy('meeting_date', 'desc')
                        ->get();
                  
            }
        else
            {
                
                $data = DB::table('tot_cg') 
                        ->select('tot_cg.*','tot_cg.id as m_id')
                        ->orderBy('meeting_date', 'desc')                        
                        ->get();

                $data1 = DB::table('tot_cg_participants') 
                        ->join('tot_cg','tot_cg.id','=','tot_cg_participants.tot_cg_id')
                        ->orderBy('meeting_date', 'desc')
                        ->get();
                
           
            }
                return response()->json(array( 
                    'data1' => $data,
                    'data2' => $data1,
                ));

        }
    }

    public function view_meeting_tot($id){
        $meeting = DB::table('tot_cg')
                   ->join('resourse_people','resourse_people.id','=','tot_cg.resourse_person_id')
                   ->select('tot_cg.*','tot_cg.id as m_id','resourse_people.name as r_name')
                   ->where('tot_cg.id',$id)
                   ->first();

        $participants = DB::table('tot_cg_participants') 
                        ->where('tot_cg_participants.tot_cg_id',$id)
                        ->get();

       // dd($meeting);
        //dd($participants);

        return response()->json(array( 
            'meeting' => $meeting,
            'participants' => $participants
        ));
        

    }

     public function download_tot($file_name){
        //$file_name = $request->attendance;
        $file = storage_path('activities/files/tot-cg/attendance/'.$file_name.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'application/pdf',
                  'Content-Type' => 'application/msword',
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }

    public function download_tr($file_name){
        //$file_name = $request->attendance;
        $file = storage_path('activities/files/tot-cg/training-report/'.$file_name.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'application/pdf',
                  'Content-Type' => 'application/msword',
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }

    public function download_photos_tot($id){
        $photos = DB::table('tot_cg_images')
                  ->where('tot_cg_id',$id)
                  ->select('tot_cg_images.images')
                  ->get();
        foreach($photos as $photo){
            //echo $photo->images;
            $headers = ["Content-Type"=>"application/zip"];
            //$paths = storage_path('activities/files/mentoring/images/'.$photo->image.'');
            $zipper = Zipper::make(storage_path('activities/files/tot-cg/images/'.$id.'.zip'))->add(storage_path('activities/files/tot-cg/images/'.$photo->images.''))->close();
        }
            return response()->download(storage_path('activities/files/tot-cg/images/'.$id.'.zip','photos',$headers)); 

        //$photos_array = $photos->toArray();
        //dd($photos);
       // Zipper::make('mydir/photos.zip')->add($paths);
       // return response()->download(('mydir/photos.zip')); 
    }

    
}

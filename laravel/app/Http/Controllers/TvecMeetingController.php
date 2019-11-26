<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Zipper;


class TvecMeetingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.skill-development.tvec-meeting')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function insert(Request $request){
    	$validator = Validator::make($request->all(),[
                'district' => 'required',
                'dm_name' =>'required',	
            ]);

            if($validator->passes()){
                $branch_id = auth()->user()->branch;
                $input = $request->all();
                if($request->hasFile('attendance')){
	            	$input['attendance'] = time().'.'.$request->file('attendance')->getClientOriginalExtension();
	            	$request->attendance->move(storage_path('activities/files/skill/tvec-meeting/attendance'), $input['attendance']);
            	}
            	if($request->hasFile('meeting_minute')){
	            	$input['meeting_minute'] = time().'.'.$request->file('meeting_minute')->getClientOriginalExtension();
	            	$request->meeting_minute->move(storage_path('activities/files/skill/tvec-meeting/meeting_minute'), $input['meeting_minute']);
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
	                'total_male' => $request->total_male,
	                'total_female'=>$request->total_female,
	                'total_institutes' => $request->total_institutes,
	                'matters_discussed' => $request->matters_discussed,
	                'decisions_agreed' => $request->decisions_agreed,
	                'matters_to_follow' => $request->matters_to_follow,
	                'attendance' => $input['attendance'],
	                'meeting_minute' => $input['meeting_minute'],
	                'branch_id'	=> $branch_id,
	                'created_at' => date('Y-m-d H:i:s')
                );

                //insert general data 
                $tvec = DB::table('tvec_meetings')->insert($data1);
                $tvec_id = DB::getPdo()->lastInsertId();

                

                //insert photos
                
				if($request->hasFile('images')){
                    foreach ($request->file('images') as $key => $value) {
                	$imageName = time(). $key . '.' . $value->getClientOriginalExtension();
                	$value->move(storage_path('activities/files/skill/tvec_meeting/images'), $imageName);
                	$images = DB::table('tvec_meetings_photos')->insert(['images'=>$imageName,'tvec_id'=>$tvec_id]);
            		}
                }

                $number = count($request->name);
                if($number>0){
                	for($i=0; $i<$number; $i++){
                		DB::table('tvec_participants')->insert(['name'=>$request->name[$i],'gender'=>$request->gender[$i],'position'=>$request->position[$i],'institute'=> $request->institute[$i],'institute_type'=>$request->institute_type[$i],'tvec_id'=>$tvec_id]);
                	}

                }
                else{
                	return response()->json(['error' => 'Submit Participants Details.']);
                }

                 
            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    
    }

    public function view(){
        $meetings = DB::table('tvec_meetings')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','tvec_meetings.branch_id')
                      ->get();
        //dd($mentorings);

        $participants2018 = DB::table('tvec_meetings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2018' )
                        ->first();
                        //->groupBy(function ($val) {
                                // Carbon::parse($val->program_date)->format('Y');
                        //});
                        //->groupBy(DB::raw("year(program_date)"))
                        
           $participants2019 = DB::table('tvec_meetings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2019' )
                        ->first();            
            $participants2020 = DB::table('tvec_meetings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2020' )
                        ->first();   
            $participants2021 = DB::table('tvec_meetings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"))
                        ->where(DB::raw('YEAR(program_date)'), '=', '2021' )
                        ->first();           
        //dd($participants2018);
        $branches = DB::table('branches')->get();
        return view('Activities.Reports.Skill-Development.tvec')->with(['meetings'=>$meetings,'branches'=>$branches,'participants2018'=>$participants2018,'participants2019'=>$participants2019,'participants2020'=>$participants2020,'participants2021'=>$participants2021]);
    }

    public function fetch(Request $request){
        if($request->ajax())
        {
            if($request->dateStart != '' && $request->dateEnd != '')
            {
                if($request->branch !=''){
                    $data = DB::table('tvec_meetings') 
                        ->join('branches','branches.id','=','tvec_meetings.branch_id')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('branch_id',$request->branch)
                        ->select('tvec_meetings.*','branches.*','tvec_meetings.id as m_id','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();
                }
                else{
                    $data = DB::table('tvec_meetings') 
                        ->join('branches','branches.id','=','tvec_meetings.branch_id')                        
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->select('tvec_meetings.*','branches.*','tvec_meetings.id as m_id','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();
                }
                
            }
        else
            {
                $data = DB::table('tvec_meetings') 
                        ->join('branches','branches.id','=','tvec_meetings.branch_id')
                        ->select('tvec_meetings.*','branches.*','tvec_meetings.id as m_id','branches.name as branch_name')
                        ->orderBy('program_date', 'desc')
                        ->get();
            }
                return response()->json($data);
        }
    }

    public function view_meeting($id){
        $meeting = DB::table('tvec_meetings')
                   ->join('branches','branches.id','=','tvec_meetings.branch_id')
                   ->select('tvec_meetings.*','branches.*','tvec_meetings.id as m_id','branches.name as branch_name')
                   ->where('tvec_meetings.id',$id)
                   ->first();

        $participants = DB::table('tvec_participants')
                        ->where('tvec_id',$id)
                        ->get();

       // dd($meeting);
        //dd($participants);

        return response()->json(array( 
            'meeting' => $meeting,
            'participants' => $participants,
        ));
        

    }

    public function download($file_name){
        //$file_name = $request->attendance;
        $file = storage_path('activities/files/skill/tvec-meeting/attendance/'.$file_name.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'application/pdf',
                  'Content-Type' => 'application/msword',
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }

    public function download_minute($id){
        //$file_name = $request->attendance;
        $file = storage_path('activities/files/skill/tvec-meeting/meeting_minute/'.$id.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'application/pdf',
                  'Content-Type' => 'application/msword',
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }

    public function download_photos($id){
        $photos = DB::table('tvec_meetings_photos')
                  ->where('tvec_id',$id)
                  ->select('tvec_meetings_photos.images')
                  ->get();
        foreach($photos as $photo){
            //echo $photo->images;
            $headers = ["Content-Type"=>"application/zip"];
            //$paths = storage_path('activities/files/mentoring/images/'.$photo->image.'');
            $zipper = Zipper::make(storage_path('activities/files/skill/tvec_meeting/images/'.$id.'.zip'))->add(storage_path('activities/files/skill/tvec_meeting/images/'.$photo->images.''))->close();
        }
            return response()->download(storage_path('activities/files/skill/tvec_meeting/images/'.$id.'.zip','photos',$headers)); 

        //$photos_array = $photos->toArray();
        //dd($photos);
       // Zipper::make('mydir/photos.zip')->add($paths);
       // return response()->download(('mydir/photos.zip')); 
    }
   

}

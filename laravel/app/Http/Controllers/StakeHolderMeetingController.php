<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Zipper;
use Auth;

class StakeHolderMeetingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$districts = DB::table('districts')->get();
    	$managers = DB::table('branches')->select('manager')->distinct()->get();
    	$activities = DB::table('activities')->get();
    	return view('Activities.career-guidance.stake-holder-meeting')->with(['districts'=> $districts,'managers'=>$managers,'activities'=>$activities]);
    }

    public function add(Request $request){
    	$validator = Validator::make($request->all(),[
    		    'program_cost'  => 'required',
    		    'total_male'  => 'required',
    		    'total_female'  => 'required',
                'district' => 'required',
                'gnd' => 'required',
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
                if($request->hasFile('attendance')){
                	$input['attendance'] = time().'.'.$request->file('attendance')->getClientOriginalExtension();
                	$request->attendance->move(storage_path('activities/files/stakeholder/attendance'), $input['attendance']);
                }
                $data1 = array(
                	'district' => $request->district,
                	'dsd' => $request->dsd,
                	'gnd' => json_encode($request->gnd),
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
	                'decisions'=>$request->decisions,
	                'attendance' => $input['attendance'],
	                'branch_id'	=> $branch_id,
                    'created_at' => date('Y-m-d H:i:s')
                );

                //insert general data 
                $stakeholder = DB::table('stake_holder_meetings')->insert($data1);
                $stakeholder_id = DB::getPdo()->lastInsertId();

                 //insert images
                $input = $request->all();
                if($request->hasFile('image')){
                    foreach ($request->file('image') as $key => $value) {
                	$imageName = time(). $key . '.' . $value->getClientOriginalExtension();
                	$value->move(storage_path('activities/files/stakeholder/images'), $imageName);
                	$images = DB::table('stake_holder_images')->insert(['images'=>$imageName,'stake_holder_meeting_id'=>$stakeholder_id]);
            		}
                }
                $number = count($request->name);
                if($number>0){
                	for($i=0; $i<$number; $i++){
                		$gvt_participants = DB::table('stake_holder_participants')->insert(['name'=>$request->name[$i],'designation'=>$request->designation[$i],'gender'=> $request->gender[$i],'institute'=> $request->institute[$i],'stake_holder_meeting_id'=>$stakeholder_id]);
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
        $branch_id = Auth::user()->branch;
        if(is_null($branch_id)){
            $meetings = DB::table('stake_holder_meetings')
                          //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                          ->join('branches','branches.id','=','stake_holder_meetings.branch_id')
                          ->get();
            //dd($mentorings);

            $participants2018 = DB::table('stake_holder_meetings')                        
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"))
                            ->where(DB::raw('YEAR(meeting_date)'), '=', '2018' )
                            ->first();
                            //->groupBy(function ($val) {
                                    // Carbon::parse($val->meeting_date)->format('Y');
                            //});
                            //->groupBy(DB::raw("year(meeting_date)"))
                            
            $participants2019 = DB::table('stake_holder_meetings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"))
                        ->where(DB::raw('YEAR(meeting_date)'), '=', '2019' )
                        ->first();            
            $participants2020 = DB::table('stake_holder_meetings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"))
                        ->where(DB::raw('YEAR(meeting_date)'), '=', '2020' )
                        ->first();   
            $participants2021 = DB::table('stake_holder_meetings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"))
                        ->where(DB::raw('YEAR(meeting_date)'), '=', '2021' )
                        ->first();  
        }
        else{
            $meetings = DB::table('stake_holder_meetings')
                      //->leftjoin('mentoring_gvt_officials','mentoring_gvt_officials.mentoring_id','=','mentoring.id')
                      ->join('branches','branches.id','=','stake_holder_meetings.branch_id')
                      ->where('stake_holder_meetings.branch_id','=',$branch_id)
                      ->get();
            //dd($mentorings);

            $participants2018 = DB::table('stake_holder_meetings')                        
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"))
                            ->where(DB::raw('YEAR(meeting_date)'), '=', '2018' )
                            ->where('stake_holder_meetings.branch_id','=',$branch_id)
                            ->first();
                            //->groupBy(function ($val) {
                                    // Carbon::parse($val->meeting_date)->format('Y');
                            //});
                            //->groupBy(DB::raw("year(meeting_date)"))
                            
            $participants2019 = DB::table('stake_holder_meetings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"))
                        ->where(DB::raw('YEAR(meeting_date)'), '=', '2019' )
                        ->where('stake_holder_meetings.branch_id','=',$branch_id)
                        ->first();     

            $participants2020 = DB::table('stake_holder_meetings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"))
                        ->where(DB::raw('YEAR(meeting_date)'), '=', '2020' )
                        ->where('stake_holder_meetings.branch_id','=',$branch_id)
                        ->first();   

            $participants2021 = DB::table('stake_holder_meetings')                        
                        ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"))
                        ->where(DB::raw('YEAR(meeting_date)'), '=', '2021' )
                        ->where('stake_holder_meetings.branch_id','=',$branch_id)
                        ->first(); 
        }         
        //dd($participants2018);
        $branches = DB::table('branches')->get(); 
        return view('Activities.Reports.career-guidance.stake-holder')->with(['meetings'=>$meetings,'branches'=>$branches,'participants2018'=>$participants2018,'participants2019'=>$participants2019,'participants2020'=>$participants2020,'participants2021'=>$participants2021]);
    }

    public function fetch(Request $request){
        if($request->ajax())
        {
            if($request->dateStart != '' && $request->dateEnd != '')
            {
                $branch_id = Auth::user()->branch;

                if($request->branch !=''){
                    $data = DB::table('stake_holder_meetings') 
                        ->join('branches','branches.id','=','stake_holder_meetings.branch_id')
                        ->whereBetween('meeting_date', array($request->dateStart, $request->dateEnd))
                        ->where('branch_id',$request->branch)
                        ->select('stake_holder_meetings.*','branches.*','stake_holder_meetings.id as m_id')
                        ->orderBy('meeting_date', 'desc')
                        ->get();
                }
                else{
                    
                    if(is_null($branch_id)){

                    $data = DB::table('stake_holder_meetings') 
                        ->join('branches','branches.id','=','stake_holder_meetings.branch_id')
                        ->whereBetween('meeting_date', array($request->dateStart, $request->dateEnd))
                        ->select('stake_holder_meetings.*','branches.*','stake_holder_meetings.id as m_id')
                        //->where('stake_holder_meetings.branch_id','=',$branch_id)
                        ->orderBy('meeting_date', 'desc')
                        ->get();
                    }
                    else{
                        $data = DB::table('stake_holder_meetings') 
                        ->join('branches','branches.id','=','stake_holder_meetings.branch_id')
                        ->whereBetween('meeting_date', array($request->dateStart, $request->dateEnd))
                        ->select('stake_holder_meetings.*','branches.*','stake_holder_meetings.id as m_id')
                        ->where('stake_holder_meetings.branch_id','=',$branch_id)
                        ->orderBy('meeting_date', 'desc')
                        ->get();
                    }
                }
                
            }
        else
            {
                $branch_id = Auth::user()->branch;
                if(is_null($branch_id)){
                    $data = DB::table('stake_holder_meetings') 
                        ->join('branches','branches.id','=','stake_holder_meetings.branch_id')
                        ->select('stake_holder_meetings.*','branches.*','stake_holder_meetings.id as m_id')
                        ->orderBy('meeting_date', 'desc')
                        ->get();
                }
                else{
                    $data = DB::table('stake_holder_meetings') 
                        ->join('branches','branches.id','=','stake_holder_meetings.branch_id')
                        ->select('stake_holder_meetings.*','branches.*','stake_holder_meetings.id as m_id')
                        ->where('stake_holder_meetings.branch_id','=',$branch_id)
                        ->orderBy('meeting_date', 'desc')
                        ->get();
                }
                
            }
                return response()->json($data);
        }
    
        

    }

    public function view_meeting($id){
        $meeting = DB::table('stake_holder_meetings')
                   ->join('branches','branches.id','=','stake_holder_meetings.branch_id')
                   ->join('dsd_office','dsd_office.ID','=','stake_holder_meetings.dsd')
                   ->select('stake_holder_meetings.*','branches.*','stake_holder_meetings.id as m_id')
                   ->where('stake_holder_meetings.id',$id)
                   ->first();
        $participants = DB::table('stake_holder_participants')
                        ->where('stake_holder_meeting_id',$id)
                        ->get();

        $photos = DB::table('stake_holder_images')
                        ->where('stake_holder_meeting_id',$id)
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
        $file = storage_path('activities/files/stakeholder/attendance/'.$file_name.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'application/pdf',
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }

    public function download_photos($id){
        $photos = DB::table('stake_holder_images')
            ->where('stake_holder_meeting_id',$id)
            ->select('stake_holder_images.images')
            ->get();

        foreach($photos as $photo){
            //echo $photo->images;
            //$paths = storage_path('activities/files/mentoring/images/'.$photo->image.'');
            $headers = ["Content-Type"=>"application/zip"];
            
            $zipper = Zipper::make(storage_path('activities/files/stakeholder/images/'.$id.'.zip'))->add(storage_path('activities/files/stakeholder/images/'.$photo->images.''))->close();

        return response()->download(storage_path('activities/files/stakeholder/images/'.$id.'.zip','photos',$headers)); 

        }


        //$photos_array = $photos->toArray();
        //dd($photos);
       // Zipper::make('mydir/photos.zip')->add($paths);
       // return response()->download(('mydir/photos.zip')); 
    }
}

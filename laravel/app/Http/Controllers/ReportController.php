<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Youth;
use DB;
use App\Employer;
use App\Vacancy;
use App\Institute;
use App\Course;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	return view('reports.landing-page');
    }

    public function personal_reports(){
    	$branch = auth()->user()->branch;
    	if(is_null($branch)){
        $branches = DB::table('branches')->get();
    		$youths = Youth::with('family')->get();
    	}
    	else{
    		$youths = Youth::with('family')->where('branch_id',$branch)->get();
        $branches = null;

    	}
    	return view('reports.personal')->with(['youths'=>$youths,'branches'=>$branches]);

    }

    public function location(){
        $districts = DB::table('districts')->get();

        $branch = auth()->user()->branch;
        if(is_null($branch)){
            $youths = DB::table('youths')
                 ->join('families','families.id','=','youths.family_id')   
                 ->join('dsd_office','dsd_office.ID','=','families.ds_division')
                 ->join('gn_office','gn_office.GN_ID','=','families.gn_division')
                 ->get();
        }
        else{

        $youths = DB::table('youths')
                 ->join('families','families.id','=','youths.family_id')   
                 ->join('dsd_office','dsd_office.ID','=','families.ds_division')
                 ->join('gn_office','gn_office.GN_ID','=','families.gn_division')
                 ->where('youths.branch_id',$branch)
                 ->get();
        //dd($youth);
        }
        return view('reports.location')->with(['districts' => $districts,'youths'=>$youths]);
    }

    public function status(){
        $branch = auth()->user()->branch;
        if(is_null($branch)){
            $branches = DB::table('branches')->get();

            $youths = Youth::with('family')->get();
        }
        else{
            $youths = Youth::with('family')->where('branch_id',$branch)->get();
            $branches = null;

        }
         return view('reports.current_status')->with(['youths'=>$youths,'branches'=>$branches]);
    }

    public function courses(){
        $branch = auth()->user()->branch;
        $course_categories = DB::table('course_categories')->get();

        if(is_null($branch)){
            $branches = DB::table('branches')->get();
            $youths = DB::table('youths')
                      ->join('intresting_jobs','intresting_jobs.youth_id','=','youths.id')
                      ->join('families','families.id','=','youths.family_id')
                      ->where('intresting_jobs.intresting_courses','!=','[""]')  
                      ->where('intresting_jobs.intresting_courses','!=','null')  
                      ->get();  
        }
        else{
            $branches = null;
            $youths = DB::table('youths')
                      ->join('intresting_jobs','intresting_jobs.youth_id','=','youths.id')
                      ->join('families','families.id','=','youths.family_id')
                      ->where('intresting_jobs.intresting_courses','!=','[""]')  
                      ->where('intresting_jobs.intresting_courses','!=','null')   
                      ->where('youths.branch_id',$branch)
                      ->get();

        }
         return view('reports.intresting_courses')->with(['youths'=>$youths,'course_categories' => $course_categories,'branches'=>$branches]);
    }

    public function jobs(){
        $branch = auth()->user()->branch;
        if(is_null($branch)){
            $branches = DB::table('branches')->get();

            $youths = DB::table('youths')
                      ->join('intresting_jobs','intresting_jobs.youth_id','=','youths.id')
                      ->join('families','families.id','=','youths.family_id')
                      ->select('youths.*','youths.id as youth_id','intresting_jobs.*','families.*')   
                      ->get();  
        }
        else{
            $youths = DB::table('youths')
                      ->join('intresting_jobs','intresting_jobs.youth_id','=','youths.id')
                      ->join('families','families.id','=','youths.family_id') 
                      ->select('youths.*','youths.id as youth_id','intresting_jobs.*','families.*')   
                      ->where('youths.branch_id',$branch)
                      ->get();

            $branches = null;
        }
         return view('reports.intresting_jobs')->with(['youths'=>$youths,'branches'=>$branches]);
    }

    public function business(){
        $branch = auth()->user()->branch;
        $business = DB::table('intresting_business')
                    ->whereNotNull('intresting_business')
                    ->where('intresting_business','!=','-')
                    ->distinct()
                    ->get(['intresting_business']);
        if(is_null($branch)){
            $branches = DB::table('branches')->get();

            $youths = DB::table('intresting_business')
                      ->join('youths','youths.id','=','intresting_business.youth_id')
                      ->join('families','families.id','=','youths.family_id')
                      ->select('youths.*','youths.id as youth_id','intresting_business.*','families.*')
                      ->whereNotNull('intresting_business')   
                      ->get();  
        }
        else{
            $youths = DB::table('intresting_business')
                      ->join('youths','youths.id','=','intresting_business.youth_id')
                      ->join('families','families.id','=','youths.family_id')
                      ->select('youths.*','youths.id as youth_id','intresting_business.*','families.*')
                      ->whereNotNull('intresting_business')   
                      ->where('youths.branch_id',$branch)
                      ->get();
            $branches = null;
        }
         return view('reports.intresting_business')->with(['youths'=>$youths,'businesses' => $business,'branches'=>$branches]);
    }

    public function common(){
        $branch = auth()->user()->branch;
        if(is_null($branch)){
            $branches = DB::table('branches')->get();

            $youths = DB::table('youths')
                      ->join('youth_common_details','youth_common_details.youth_id','=','youths.id')
                      ->join('families','families.id','=','youths.family_id')
                      ->select('youths.*','youths.id as youth_id','youth_common_details.*','families.*')   
                      ->get();  
        }
        else{
            $youths = DB::table('youths')
                      ->join('youth_common_details','youth_common_details.youth_id','=','youths.id')
                      ->join('families','families.id','=','youths.family_id') 
                      ->select('youths.*','youths.id as youth_id','youth_common_details.*','families.*')   
                      ->where('youths.branch_id',$branch)
                      ->get();
            $branches = null;
        }
         return view('reports.common')->with(['youths'=>$youths,'branches'=>$branches]);
    }

    public function youth_courses(){
        $branch = auth()->user()->branch;

        $courses = DB::table('youths_courses')
                   ->join('courses','courses.id','=','youths_courses.course_id')
                   ->select('courses.*','youths_courses.course_id')
                   ->distinct()
                   ->get();
        if(is_null($branch)){

            $branches = DB::table('branches')->get();

            $youths = DB::table('youths_courses')
                      ->join('youths','youths.id','=','youths_courses.youth_id')
                      ->join('courses','courses.id','=','youths_courses.course_id')
                      ->join('families','families.id','=','youths.family_id')
                      ->select('youths.*','youths.id as youth_id','families.*','youths_courses.*','youths.name as youth_name','courses.name as course_name','courses.*')    
                      ->get();  
        }
        else{
            $youths = DB::table('youths_courses')
                      ->join('youths','youths.id','=','youths_courses.youth_id')
                      ->join('courses','courses.id','=','youths_courses.course_id')
                      ->join('families','families.id','=','youths.family_id')
                      ->select('youths.*','youths.id as youth_id','families.*','youths_courses.*','youths.name as youth_name','courses.name as course_name','courses.*')  
                      ->where('youths.branch_id',$branch)
                      ->get();
            $branches = null;

        }
         return view('reports.youth_courses')->with(['youths'=>$youths,'courses'=> $courses,'branches'=>$branches]);
    }

    public function employers(){
       
            $employers = Employer::get();

         return view('reports.employers')->with(['employers'=>$employers]);
    }

    public function vacancies(){
        $employers  = DB::table('employers')
                      ->select('employers.name')
                      ->get(); 
        $vacancies = Vacancy::with('employer')->get();
         return view('reports.vacancies')->with(['vacancies'=>$vacancies,'employers' => $employers]);
    }

    public function institutes(){
        $courses = DB::table('courses')
                   ->select('courses.name')
                   ->get(); 
        $institutes = Institute::with('courses')->get();
        //dd($institutes->toArray());

        return view('reports.institutes')->with(['institutes'=>$institutes,'courses'=>$courses]);
    }

    public function training_courses(){
        $institutes = DB::table('institutes')
                   ->select('institutes.name')
                   ->get(); 
        $standards = DB::table('courses')->select('courses.standard')
                    ->whereNotNull('standard')
                    ->distinct()->get();             
        $courses = Course::with('institutes')->get();
        //dd($institutes->toArray());

        return view('reports.courses')->with(['institutes'=>$institutes,'courses'=>$courses,'standards'=>$standards]);
    }
}

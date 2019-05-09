<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Vacancy;
use Activity;
use Auth;
use App\Youth;
use App\Employer;
use App\Institute;
use App\Course;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $role = Auth::user()->roles()->first()->slug;

        switch ($role) {
            //admin dashboard
            case 'admin':
                $users_count = User::count();
                $active_users = Activity::users()->count();
                $users_to_active = User::where('isActive', 0)->count();
                $total_youths = Youth::count();

                //Count youth in each branches
                $count_NE_youth = Youth::where('branch_id',1)->count();        
                $count_TRIN_youth = Youth::where('branch_id',2)->count();        
                $count_KEG_youth = Youth::where('branch_id',3)->count();        
                $count_GINI_youth = Youth::where('branch_id',5)->count();        
                $count_BAT_youth = Youth::where('branch_id',6)->count();        
                $count_ANU_youth = Youth::where('branch_id',7)->count();        
                $count_MUL_youth = Youth::where('branch_id',8)->count();


                //count VT branch wise
                $count_NE_vt = Youth::where('vt',1)->where('branch_id',1)->count();
                $count_TRIN_vt = Youth::where('vt',1)->where('branch_id',2)->count();
                $count_KEG_vt = Youth::where('vt',1)->where('branch_id',3)->count();
                $count_GINI_vt = Youth::where('vt',1)->where('branch_id',5)->count();
                $count_BAT_vt = Youth::where('vt',1)->where('branch_id','=',6)->count();
                $count_ANU_vt = Youth::where('vt',1)->where('branch_id',7)->count();
                $count_MUL_vt = Youth::where('vt',1)->where('branch_id',8)->count();

                $actual_vt = ($count_NE_vt+$count_TRIN_vt+$count_KEG_vt+$count_GINI_vt+$count_BAT_vt+$count_ANU_vt+$count_MUL_vt);

                //count CG branch wise
                $count_NE_cg = Youth::where('cg',1)->where('branch_id',1)->count();
                $count_TRIN_cg = Youth::where('cg',1)->where('branch_id',2)->count();
                $count_KEG_cg = Youth::where('cg',1)->where('branch_id',3)->count();
                $count_GINI_cg = Youth::where('cg',1)->where('branch_id',5)->count();
                $count_BAT_cg = Youth::where('cg',1)->where('branch_id','=',6)->count();
                $count_ANU_cg = Youth::where('cg',1)->where('branch_id',7)->count();
                $count_MUL_cg = Youth::where('cg',1)->where('branch_id',8)->count();

                $actual_cg = ($count_NE_cg+$count_TRIN_cg+$count_KEG_cg+$count_GINI_cg+$count_BAT_cg+$count_ANU_cg+$count_MUL_cg);

                //count soft branch wise
                $count_NE_soft_skills = Youth::where('soft_skills',1)->where('branch_id',1)->count();
                $count_TRIN_soft_skills = Youth::where('soft_skills',1)->where('branch_id',2)->count();
                $count_KEG_soft_skills = Youth::where('soft_skills',1)->where('branch_id',3)->count();
                $count_GINI_soft_skills = Youth::where('soft_skills',1)->where('branch_id',5)->count();
                $count_BAT_soft_skills = Youth::where('soft_skills',1)->where('branch_id','=',6)->count();
                $count_ANU_soft_skills = Youth::where('soft_skills',1)->where('branch_id',7)->count();
                $count_MUL_soft_skills = Youth::where('soft_skills',1)->where('branch_id',8)->count();

                $actual_soft_skills = ($count_NE_soft_skills+$count_TRIN_soft_skills+$count_KEG_soft_skills+$count_GINI_soft_skills+$count_BAT_soft_skills+$count_ANU_soft_skills+$count_MUL_soft_skills);

                //count Prof branch wise
                $count_NE_prof = Youth::where('prof',1)->where('branch_id',1)->count();
                $count_TRIN_prof = Youth::where('prof',1)->where('branch_id',2)->count();
                $count_KEG_prof = Youth::where('prof',1)->where('branch_id',3)->count();
                $count_GINI_prof = Youth::where('prof',1)->where('branch_id',5)->count();
                $count_BAT_prof = Youth::where('prof',1)->where('branch_id','=',6)->count();
                $count_ANU_prof = Youth::where('prof',1)->where('branch_id',7)->count();
                $count_MUL_prof = Youth::where('prof',1)->where('branch_id',8)->count();

                $actual_prof = ($count_NE_prof+$count_TRIN_prof+$count_KEG_prof+$count_GINI_prof+$count_BAT_prof+$count_ANU_prof+$count_MUL_prof);

                //count jobs branch wise
                $count_NE_jobs = Youth::where('jobs',1)->where('branch_id',1)->count();
                $count_TRIN_jobs = Youth::where('jobs',1)->where('branch_id',2)->count();
                $count_KEG_jobs = Youth::where('jobs',1)->where('branch_id',3)->count();
                $count_GINI_jobs = Youth::where('jobs',1)->where('branch_id',5)->count();
                $count_BAT_jobs = Youth::where('jobs',1)->where('branch_id','=',6)->count();
                $count_ANU_jobs = Youth::where('jobs',1)->where('branch_id',7)->count();
                $count_MUL_jobs = Youth::where('jobs',1)->where('branch_id',8)->count();

                $actual_jobs = ($count_NE_jobs+$count_TRIN_jobs+$count_KEG_jobs+$count_GINI_jobs+$count_BAT_jobs+$count_ANU_jobs+$count_MUL_jobs);

               //employers 
               $employers_count =  Employer::count(); 

               //vacancies 
               $vacancies_count =  Vacancy::count(); 

               //employers 
               $institutes_count =  Institute::count(); 

               //employers 
               $courses_count =  Course::count();

               //job applications
               $applications = DB::table('youths_vacancies')
                      ->join('youths','youths.id','=','youths_vacancies.youth_id')
                      ->join('vacancies','vacancies.id','=','youths_vacancies.vacancy_id')
                      ->join('employers','employers.id','=','vacancies.employer_id')
                      ->select('youths_vacancies.*','youths.*','youths.name as youth_name','vacancies.*','employers.*','employers.name as employer_name','employers.email as employer_email','employers.phone as employer_phone','youths_vacancies.id as application_id')
                      ->orderBy('application_id', 'DESC')
                      ->get()->take(5);
                $new_application_count = DB::table('youths_vacancies')->where('status', null)->count();
                $last_activities = Activity::users(60)->get()->take(10);  // Last 60 minutes
                $recent_activities = Activity::users()->get()->take(10);  // Last 60 minutes

                //youth followers

                $followers = DB::table('employers_follow_youths')
                     ->join('youths','youths.id','=','employers_follow_youths.youth_id')
                     ->join('employers','employers.id','=','employers_follow_youths.employer_id')
                     ->join('families','families.id','=','youths.family_id')
                     ->select('employers_follow_youths.*','employers_follow_youths.id as employers_follow_youths_id','youths.*','youths.name as youth_name','youths.phone as youth_phone','youths.email as youth_email','employers.*','employers.name as employer_name','employers.address as employer_address','employers.phone as employer_phone','employers.email as employer_email','families.*','families.address as family_address')
                     ->orderBy('employers_follow_youths_id', 'DESC')
                     ->get();   
                $new_follower_count = DB::table('employers_follow_youths')->where('status', null)->count();

                $target_cg = DB::table('table_targets')->select(DB::raw('SUM(cg) as total_cg'))->first();
                $target_soft = DB::table('table_targets')->select(DB::raw('SUM(soft) as total_soft'))->first();
                $target_vt = DB::table('table_targets')->select(DB::raw('SUM(vt) as total_vt'))->first();
                $target_prof = DB::table('table_targets')->select(DB::raw('SUM(prof) as total_prof'))->first();
                $target_jobs = DB::table('table_targets')->select(DB::raw('SUM(jobs) as total_jobs'))->first();
                $total_cg = $target_cg->total_cg;            
                $total_soft = $target_soft->total_soft;            
                $total_vt = $target_vt->total_vt;            
                $total_prof = $target_prof->total_prof;            
                $total_jobs = $target_jobs->total_jobs;  


                //user audit

                $audits = DB::table('activity_audit')
                          ->join('users','users.id','=','activity_audit.user_id')
                          ->orderBy('activity_audit.id','DESC')
                          ->take(150)
                          ->get();

                return view('home')->with(['users_count'=>$users_count,'active_users' =>$active_users,'users_to_active'=>$users_to_active,'total_youths'=>$total_youths,'count_NE_youth'=>$count_NE_youth,'count_TRIN_youth'=>$count_TRIN_youth,'count_KEG_youth'=>$count_KEG_youth,'count_GINI_youth'=>$count_GINI_youth,'count_BAT_youth'=>$count_BAT_youth,'count_ANU_youth'=>$count_ANU_youth,'count_MUL_youth'=>$count_MUL_youth,'count_NE_vt'=> $count_NE_vt,'count_TRIN_vt'=> $count_TRIN_vt,'count_KEG_vt'=> $count_KEG_vt,'count_GINI_vt'=> $count_GINI_vt,'count_BAT_vt'=> $count_BAT_vt,'count_ANU_vt'=> $count_ANU_vt,'count_MUL_vt'=> $count_MUL_vt,'count_NE_cg'=> $count_NE_cg,'count_TRIN_cg'=> $count_TRIN_cg,'count_KEG_cg'=> $count_KEG_cg,'count_GINI_cg'=> $count_GINI_cg,'count_BAT_cg'=> $count_BAT_cg,'count_ANU_cg'=> $count_ANU_cg,'count_MUL_cg'=> $count_MUL_cg,'count_NE_soft_skills'=> $count_NE_soft_skills,'count_TRIN_soft_skills'=> $count_TRIN_soft_skills,'count_KEG_soft_skills'=> $count_KEG_soft_skills,'count_GINI_soft_skills'=> $count_GINI_soft_skills,'count_BAT_soft_skills'=> $count_BAT_soft_skills,'count_ANU_soft_skills'=> $count_ANU_soft_skills,'count_MUL_soft_skills'=> $count_MUL_soft_skills,'count_NE_prof'=> $count_NE_prof,'count_TRIN_prof'=> $count_TRIN_prof,'count_KEG_prof'=> $count_KEG_prof,'count_GINI_prof'=> $count_GINI_prof,'count_BAT_prof'=> $count_BAT_prof,'count_ANU_prof'=> $count_ANU_prof,'count_MUL_prof'=> $count_MUL_prof,'count_NE_jobs'=> $count_NE_jobs,'count_TRIN_jobs'=> $count_TRIN_jobs,'count_KEG_jobs'=> $count_KEG_jobs,'count_GINI_jobs'=> $count_GINI_jobs,'count_BAT_jobs'=> $count_BAT_jobs,'count_ANU_jobs'=> $count_ANU_jobs,'count_MUL_jobs'=> $count_MUL_jobs,'employers_count'=>$employers_count,'vacancies_count'=>$vacancies_count,'institutes_count'=>$institutes_count,'courses_count'=>$courses_count,'applications'=>$applications,'new_application_count'=> $new_application_count,'last_activities'=>$last_activities,'followers'=>$followers,'new_follower_count'=>$new_follower_count,'total_cg'=>$total_cg,'total_soft'=>$total_soft,'total_vt'=>$total_vt,'total_prof'=>$total_prof,'total_jobs'=>$total_jobs,'actual_cg'=>$actual_cg,'actual_jobs'=>$actual_jobs,'actual_vt'=>$actual_vt,'actual_prof'=>$actual_prof,'actual_soft_skills'=>$actual_soft_skills,'audits' =>$audits,'recent_activities'=>$recent_activities]);


                break;

            //youth dashboard    
            case 'youth':
                    //vacancies 
                   $vacancies_count =  Vacancy::count(); 
                   $vacancies = Vacancy::where('dedline', '>', Carbon::now())->get()->take(5);
                   //employers 
                   $institutes_count =  Institute::count(); 
                   //courses 
                   $courses_count =  Course::count();
                   $courses = Course::with('institutes')->get()->take(5);
                return view('home')->with(['vacancies_count'=>$vacancies_count,'institutes_count'=>$institutes_count,'courses_count'=>$courses_count,'vacancies'=>$vacancies,'courses'=>$courses]);
                break;
            case 'branch':
                //employers 

            $branch_id = auth()->user()->branch;
                   $employers_count =  Employer::count();
                   //vacancies 
                   $vacancies_count =  Vacancy::count(); 

                   //employers 
                   $institutes_count =  Institute::count(); 

                   //employers 
                   $courses_count =  Course::count();

                   //youth count 
                   $count_youth = Youth::where('branch_id',$branch_id)->count(); 

                   //CG count 
                   $count_cg = Youth::where('branch_id',$branch_id)->where('cg',1)->count(); 

                   //Soft Skills count 
                   $count_soft_skills = Youth::where('branch_id',$branch_id)->where('soft_skills',1)->count(); 

                   //vt count 
                   $count_vt = Youth::where('branch_id',$branch_id)->where('vt',1)->count(); 

                   //prof count 
                   $count_prof = Youth::where('branch_id',$branch_id)->where('prof',1)->count(); 

                   //jobs count 
                   $count_jobs = Youth::where('branch_id',$branch_id)->where('jobs',1)->count(); 

                   //job applications
                   $applications = DB::table('youths_vacancies')
                      ->join('youths','youths.id','=','youths_vacancies.youth_id')
                      ->join('vacancies','vacancies.id','=','youths_vacancies.vacancy_id')
                      ->join('employers','employers.id','=','vacancies.employer_id')
                      ->select('youths_vacancies.*','youths.*','youths.name as youth_name','vacancies.*','employers.*','employers.name as employer_name','employers.email as employer_email','employers.phone as employer_phone','youths_vacancies.id as application_id')
                      ->where('youths.branch_id',$branch_id)
                      ->orderBy('application_id', 'DESC')
                      ->get();

                  $new_application_count = DB::table('youths_vacancies')
                               ->join('youths','youths.id','=','youths_vacancies.youth_id')
                               ->where('youths.branch_id',$branch_id)
                              ->where('status', null)->count();      
                 //follwers
                  $followers = DB::table('employers_follow_youths')
                     ->join('youths','youths.id','=','employers_follow_youths.youth_id')
                     ->join('employers','employers.id','=','employers_follow_youths.employer_id')
                     ->join('families','families.id','=','youths.family_id')
                     ->select('employers_follow_youths.*','employers_follow_youths.id as employers_follow_youths_id','youths.*','youths.name as youth_name','youths.phone as youth_phone','youths.email as youth_email','employers.*','employers.name as employer_name','employers.address as employer_address','employers.phone as employer_phone','employers.email as employer_email','families.*','families.address as family_address')
                     ->where('youths.branch_id',$branch_id)
                     ->orderBy('employers_follow_youths_id', 'DESC')
                     ->get();   

                    $new_follower_count = DB::table('employers_follow_youths')
                                 ->join('youths','youths.id','=','employers_follow_youths.youth_id')
                                 ->where('youths.branch_id',$branch_id)
                                 ->where('status', null)->count();
                    //bec targets             
                   $targets =  DB::table('table_targets')->where('branch_id',$branch_id)->first();
                    return view('home')->with(['employers_count'=>$employers_count,'vacancies_count'=>$vacancies_count,'institutes_count'=>$institutes_count,'courses_count'=>$courses_count,'count_cg'=>$count_cg,'count_soft_skills'=> $count_soft_skills,'count_vt'=>$count_vt,'count_prof'=>$count_prof,'count_jobs'=>$count_jobs,'count_youth'=>$count_youth,'targets'=>$targets,'applications'=>$applications,'new_application_count'=> $new_application_count,'followers'=>$followers,'new_follower_count'=>$new_follower_count]);
                break;

                case 'employer':
                    $employer_id = Auth::id();
                    $vacancies_count = Vacancy::where('employer_id',$employer_id)->count();
                    $vacancies = Vacancy::where('employer_id',$employer_id)->get()->take(10);

                    $applications = DB::table('youths_vacancies')->join('vacancies','vacancies.id','=','youths_vacancies.vacancy_id')
                                    ->join('youths','youths.id','=','youths_vacancies.youth_id')
                                    ->where('vacancies.employer_id',$employer_id)->get()->take(10);
                    $followers = DB::table('employers_follow_youths')->where('employer_id',$employer_id)->count();

                        return view('home')->with(['vacancies'=>$vacancies,'vacancies_count'=>$vacancies_count,'applications'=>$applications,'followers'=>$followers]);
                    break;
            default:
                # code...
                break;
        }
        
        
        

        
        
        
    }
}

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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

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
        /**
        $url = 'https://www.hpb.health.gov.lk/api/get-current-statistical';
        $options = array('http' => array(
            'method'  => 'GET'
        ));
        $context  = stream_context_create($options);
        $body = file_get_contents($url, false, $context);
        $response =  json_decode($body);
         */
        //$json = json_decode(file_get_contents('http://testingbec.southeastasia.cloudapp.azure.com/api/person/'));


        switch ($role) {
                //admin dashboard
            case 'admin':
                $users_count = User::count();
                $active_users = Activity::users()->count();
                $users_to_active = User::where('isActive', 0)->count();
                $total_youths = Youth::count();


                //dd($soft_status, $arrayName,$d);
                //Count youth in each branches
                $count_NE_youth = Youth::where('branch_id', 1)->count();
                $count_TRIN_youth = Youth::where('branch_id', 2)->count();
                $count_KEG_youth = Youth::where('branch_id', 3)->count();
                $count_GINI_youth = Youth::where('branch_id', 5)->count();
                $count_BAT_youth = Youth::where('branch_id', 6)->count();
                $count_ANU_youth = Youth::where('branch_id', 7)->count();
                $count_MUL_youth = Youth::where('branch_id', 8)->count();


                //count VT branch wise
                $count_NE_vt =  DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 1)->count();
                $count_TRIN_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 2)->count();
                $count_KEG_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 3)->count();
                $count_GINI_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 5)->count();
                $count_BAT_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 6)->count();
                $count_ANU_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 7)->count();
                $count_MUL_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 8)->count();

                $actual_vt = ($count_NE_vt + $count_TRIN_vt + $count_KEG_vt + $count_GINI_vt + $count_BAT_vt + $count_ANU_vt + $count_MUL_vt);

                //count CG branch wise
                $count_NE_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 1)->count();
                $count_TRIN_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 2)->count();
                $count_KEG_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 3)->count();
                $count_GINI_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 5)->count();
                $count_BAT_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 6)->count();
                $count_ANU_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 7)->count();
                $count_MUL_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 8)->count();

                $actual_cg = ($count_NE_cg + $count_TRIN_cg + $count_KEG_cg + $count_GINI_cg + $count_BAT_cg + $count_ANU_cg + $count_MUL_cg);

                //count soft branch wise
                $count_NE_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 1)->count();
                $count_TRIN_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 2)->count();
                $count_KEG_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 3)->count();
                $count_GINI_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 5)->count();
                $count_BAT_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 6)->count();
                $count_ANU_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 7)->count();
                $count_MUL_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 8)->count();

                $actual_soft_skills = ($count_NE_soft_skills + $count_TRIN_soft_skills + $count_KEG_soft_skills + $count_GINI_soft_skills + $count_BAT_soft_skills + $count_ANU_soft_skills + $count_MUL_soft_skills);

                //count Prof branch wise
                $count_NE_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 1)->count();
                $count_TRIN_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 2)->count();
                $count_KEG_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 3)->count();
                $count_GINI_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 5)->count();
                $count_BAT_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 6)->count();
                $count_ANU_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 7)->count();
                $count_MUL_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 8)->count();

                $actual_prof = ($count_NE_prof + $count_TRIN_prof + $count_KEG_prof + $count_GINI_prof + $count_BAT_prof + $count_ANU_prof + $count_MUL_prof);

                //count jobs branch wise
                $jobs_fair_NE = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 1)->count();
                $jobs_fair_TRIN = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 2)->count();
                $jobs_fair_KEG = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 3)->count();
                $jobs_fair_GINI = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 5)->count();
                $jobs_fair_BAT = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 6)->count();
                $jobs_fair_ANU = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 7)->count();
                $jobs_fair_MUL = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 8)->count();
                $count_NE_jobs = DB::table('placement_individual')
                    ->where('branch_id', 1)
                    ->count() + $jobs_fair_NE;
                $count_TRIN_jobs = DB::table('placement_individual')
                    ->where('branch_id', 2)
                    ->count() + $jobs_fair_TRIN;
                $count_KEG_jobs = DB::table('placement_individual')
                    ->where('branch_id', 3)
                    ->count() + $jobs_fair_KEG;
                $count_GINI_jobs = DB::table('placement_individual')
                    ->where('branch_id', 5)
                    ->count() + $jobs_fair_GINI;
                $count_BAT_jobs = DB::table('placement_individual')
                    ->where('branch_id', 6)
                    ->count() + $jobs_fair_BAT;
                $count_ANU_jobs = DB::table('placement_individual')
                    ->where('branch_id', 7)
                    ->count() + $jobs_fair_ANU;
                $count_MUL_jobs = DB::table('placement_individual')
                    ->where('branch_id', 8)
                    ->count() + $jobs_fair_MUL;

                $actual_jobs = ($count_NE_jobs + $count_TRIN_jobs + $count_KEG_jobs + $count_GINI_jobs + $count_BAT_jobs + $count_ANU_jobs + $count_MUL_jobs);

                //count bss branch wise
                $count_NE_bss = Youth::where('bss', 1)->where('branch_id', 1)->count();
                $count_TRIN_bss = Youth::where('bss', 1)->where('branch_id', 2)->count();
                $count_KEG_bss = Youth::where('bss', 1)->where('branch_id', 3)->count();
                $count_GINI_bss = Youth::where('bss', 1)->where('branch_id', 5)->count();
                $count_BAT_bss = Youth::where('bss', 1)->where('branch_id', '=', 6)->count();
                $count_ANU_bss = Youth::where('bss', 1)->where('branch_id', 7)->count();
                $count_MUL_bss = Youth::where('bss', 1)->where('branch_id', 8)->count();

                $count_gvt = DB::table('course_supports_youth')->count();
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
                    ->join('youths', 'youths.id', '=', 'youths_vacancies.youth_id')
                    ->join('vacancies', 'vacancies.id', '=', 'youths_vacancies.vacancy_id')
                    ->join('employers', 'employers.id', '=', 'vacancies.employer_id')
                    ->select('youths_vacancies.*', 'youths.*', 'youths.name as youth_name', 'vacancies.*', 'employers.*', 'employers.name as employer_name', 'employers.email as employer_email', 'employers.phone as employer_phone', 'youths_vacancies.id as application_id')
                    ->orderBy('application_id', 'DESC')
                    ->get()->take(5);
                $new_application_count = DB::table('youths_vacancies')->where('status', null)->count();
                $last_activities = Activity::usersByHours(8)->get()->take(10);  // Last 8 hours
                $recent_activities = Activity::users()->get()->take(10);  // Last 60 minutes

                //youth followers

                $followers = DB::table('employers_follow_youths')
                    ->join('youths', 'youths.id', '=', 'employers_follow_youths.youth_id')
                    ->join('employers', 'employers.id', '=', 'employers_follow_youths.employer_id')
                    ->join('families', 'families.id', '=', 'youths.family_id')
                    ->select('employers_follow_youths.*', 'employers_follow_youths.id as employers_follow_youths_id', 'youths.*', 'youths.name as youth_name', 'youths.phone as youth_phone', 'youths.email as youth_email', 'employers.*', 'employers.name as employer_name', 'employers.address as employer_address', 'employers.phone as employer_phone', 'employers.email as employer_email', 'families.*', 'families.address as family_address')
                    ->orderBy('employers_follow_youths_id', 'DESC')
                    ->get();
                $new_follower_count = DB::table('employers_follow_youths')->where('status', null)->count();

                $target_cg = DB::table('table_targets')->select(DB::raw('SUM(cg) as total_cg'))->first();
                $target_soft = DB::table('table_targets')->select(DB::raw('SUM(soft) as total_soft'))->first();
                $target_vt = DB::table('table_targets')->select(DB::raw('SUM(vt) as total_vt'))->first();
                $target_prof = DB::table('table_targets')->select(DB::raw('SUM(prof) as total_prof'))->first();
                $target_jobs = DB::table('table_targets')->select(DB::raw('SUM(jobs) as total_jobs'))->first();
                $target_gvt = DB::table('table_targets')->select(DB::raw('SUM(gvt) as total_gvt'))->first();
                $total_cg = $target_cg->total_cg;
                $total_soft = $target_soft->total_soft;
                $total_vt = $target_vt->total_vt;
                $total_prof = $target_prof->total_prof;
                $total_jobs = $target_jobs->total_jobs;
                $total_gvt = $target_gvt->total_gvt;


                //user audit

                $audits = DB::table('activity_audit')
                    ->join('users', 'users.id', '=', 'activity_audit.user_id')
                    ->orderBy('activity_audit.id', 'DESC')
                    ->take(150)
                    ->get();

                //m and e reports

                $total_reports =  DB::table('audits')
                    ->join('users', 'users.id', '=', 'audits.user_id')
                    ->join('branches', 'branches.id', '=', 'users.branch')
                    ->select('audits.*', 'users.name as user_name', 'branches.name as branch_name')
                    ->whereIn('auditable_type', ['assesments', 'awareness', 'CareerGuidance', 'course_supports', 'finacial_supports', 'households', 'incoperation_soft_skills', 'institute_reviews', 'kickoffs', 'mentoring', 'partner_trainings', 'pes_unit_supports', 'pes_units', 'placements', 'placement_individual', 'provide_soft_skills', 'regional_meetings', 'stake_holder_meetings', 'tot_cg', 'tvec_meetings', 'cg_trainings'])
                    ->where('event', 'created')
                    ->latest()
                    ->get();

                $total_reports_day =  DB::table('audits')
                    ->whereIn('auditable_type', ['assesments', 'awareness', 'CareerGuidance', 'course_supports', 'finacial_supports', 'households', 'incoperation_soft_skills', 'institute_reviews', 'kickoffs', 'mentoring', 'partner_trainings', 'pes_unit_supports', 'pes_units', 'placements', 'placement_individual', 'provide_soft_skills', 'regional_meetings', 'stake_holder_meetings', 'tot_cg', 'tvec_meetings', 'cg_trainings'])
                    ->where('event', 'created')
                    ->whereDate('created_at', Carbon::today())
                    ->count();



                $leasts = Activity::users()->orderByUsers('email')->get();
                $arrayName = array(
                    '1' => 0,
                    '2' => 0,
                    '3' => 0,
                    '4' => 0,
                    '5' => 0,
                    '6' => 0,
                    '7' => 0,
                );
                //soft skills youths status
                $soft_status = DB::table('provide_soft_skills_youths')
                ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                ->select(DB::raw('COUNT(*) as count'), 'current_status')
                    ->groupBy('current_status')
                    //->where('branch_id', $branch_id)
                    ->get()->pluck('count', 'current_status');
                $soft_statusArray = $soft_status->all();
                $soft_status_array =  $soft_statusArray + $arrayName;
                ksort($soft_status_array);

                //gvt youths status
                $gvt_status = DB::table('course_supports_youth')
                ->join('course_supports', 'course_supports.id', '=', 'course_supports_youth.course_support_id')
                ->select(DB::raw('COUNT(*) as count'), 'current_status')
                    ->groupBy('current_status')
                    //->where('branch_id', $branch_id)
                    ->get()->pluck('count', 'current_status');
                $gvt_statusArray = $gvt_status->all();
                $gvt_status_array =  $gvt_statusArray + $arrayName;
                ksort($gvt_status_array);

                //vt youths status
                $vt_status = DB::table('finacial_supports_youths')
                ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                ->select(DB::raw('COUNT(*) as count'), 'current_status')
                    ->groupBy('current_status')
                    ->where('course_type', 'Vocational Training')
                   // ->where('branch_id', $branch_id)
                    ->get()->pluck('count', 'current_status');
                $vt_statusArray = $vt_status->all();
                $vt_status_array =  $vt_statusArray + $arrayName;
                ksort($vt_status_array);
                //dd($gvt_status_array, $vt_status_array);
                //prof youths status
                $prof_status = DB::table('finacial_supports_youths')
                ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                ->select(DB::raw('COUNT(*) as count'), 'current_status')
                    ->groupBy('current_status')
                    ->where('course_type', 'Proffessional Training')
                    //->where('branch_id', $branch_id)
                    ->get()->pluck('count', 'current_status');
                $prof_statusArray = $prof_status->all();
                $prof_status_array =  $prof_statusArray + $arrayName;
                ksort($prof_status_array);

                $total_status = array_map(function () {
                    return array_sum(func_get_args());
                }, $soft_status_array, $gvt_status_array, $vt_status_array, $prof_status_array);
                return view('home')->with(['users_count' => $users_count, 'active_users' => $active_users, 'users_to_active' => $users_to_active, 'total_youths' => $total_youths, 'count_NE_youth' => $count_NE_youth, 'count_TRIN_youth' => $count_TRIN_youth, 'count_KEG_youth' => $count_KEG_youth, 'count_GINI_youth' => $count_GINI_youth, 'count_BAT_youth' => $count_BAT_youth, 'count_ANU_youth' => $count_ANU_youth, 'count_MUL_youth' => $count_MUL_youth,
                 'count_NE_vt' => $count_NE_vt, 'count_TRIN_vt' => $count_TRIN_vt, 'count_KEG_vt' => $count_KEG_vt, 'count_GINI_vt' => $count_GINI_vt, 'count_BAT_vt' => $count_BAT_vt, 'count_ANU_vt' => $count_ANU_vt, 'count_MUL_vt' => $count_MUL_vt, 'count_NE_cg' => $count_NE_cg, 'count_TRIN_cg' => $count_TRIN_cg, 'count_KEG_cg' => $count_KEG_cg, 'count_GINI_cg' => $count_GINI_cg, 'count_BAT_cg' => $count_BAT_cg, 'count_ANU_cg' => $count_ANU_cg, 'count_MUL_cg' => $count_MUL_cg, 'count_NE_soft_skills' => $count_NE_soft_skills, 'count_TRIN_soft_skills' => $count_TRIN_soft_skills, 'count_KEG_soft_skills' => $count_KEG_soft_skills, 'count_GINI_soft_skills' => $count_GINI_soft_skills, 'count_BAT_soft_skills' => $count_BAT_soft_skills, 'count_ANU_soft_skills' => $count_ANU_soft_skills, 'count_MUL_soft_skills' => $count_MUL_soft_skills, 'count_NE_prof' => $count_NE_prof, 'count_TRIN_prof' => $count_TRIN_prof, 'count_KEG_prof' => $count_KEG_prof, 'count_GINI_prof' => $count_GINI_prof, 'count_BAT_prof' => $count_BAT_prof, 'count_ANU_prof' => $count_ANU_prof, 'count_MUL_prof' => $count_MUL_prof, 'count_NE_jobs' => $count_NE_jobs, 'count_TRIN_jobs' => $count_TRIN_jobs, 'count_KEG_jobs' => $count_KEG_jobs, 'count_GINI_jobs' => $count_GINI_jobs, 'count_BAT_jobs' => $count_BAT_jobs, 'count_ANU_jobs' => $count_ANU_jobs, 'count_MUL_jobs' => $count_MUL_jobs, 'employers_count' => $employers_count, 'vacancies_count' => $vacancies_count, 'institutes_count' => $institutes_count, 'courses_count' => $courses_count, 'applications' => $applications, 'new_application_count' => $new_application_count, 'last_activities' => $last_activities, 'followers' => $followers, 'new_follower_count' => $new_follower_count, 'total_cg' => $total_cg, 'total_soft' => $total_soft, 'total_vt' => $total_vt, 'total_prof' => $total_prof, 'total_jobs' => $total_jobs, 'actual_cg' => $actual_cg, 'actual_jobs' => $actual_jobs, 'actual_vt' => $actual_vt, 'actual_prof' => $actual_prof, 'actual_soft_skills' => $actual_soft_skills, 'audits' => $audits, 'recent_activities' => $recent_activities, 'count_NE_bss' => $count_NE_bss, 'count_MUL_bss' => $count_MUL_bss, 'count_ANU_bss' => $count_ANU_bss, 'count_BAT_bss' => $count_BAT_bss, 'count_GINI_bss' => $count_GINI_bss, 'count_KEG_bss' => $count_KEG_bss, 'count_TRIN_bss' => $count_TRIN_bss, 'total_reports' => $total_reports, 'total_reports_day' => $total_reports_day, 'leasts' => $leasts, 'total_gvt' => $total_gvt, 'count_gvt' => $count_gvt,
                    'soft_status_array' => $soft_status_array,
                    'gvt_status_array' => $gvt_status_array,
                    'vt_status_array' => $vt_status_array,
                    'prof_status_array' => $prof_status_array,
                    'total_status' => $total_status
                 ]);


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
                return view('home')->with(['vacancies_count' => $vacancies_count, 'institutes_count' => $institutes_count, 'courses_count' => $courses_count, 'vacancies' => $vacancies, 'courses' => $courses]);
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
                $count_youth = Youth::where('branch_id', $branch_id)->count();

                //CG count
                $count_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id','=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', $branch_id)->count();

                //Soft Skills count
                $count_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id','=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', $branch_id)->count();

                //vt count
                $count_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', $branch_id)
                    ->count();

                //prof count
                $count_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', $branch_id)
                    ->count();

                //jobs count
                $count_jobs = Youth::where('branch_id', $branch_id)->where('jobs', 1)->count();
                $count_bss = Youth::where('branch_id', $branch_id)->where('bss', 1)->count();

                //job applications
                $applications = DB::table('youths_vacancies')
                    ->join('youths', 'youths.id', '=', 'youths_vacancies.youth_id')
                    ->join('vacancies', 'vacancies.id', '=', 'youths_vacancies.vacancy_id')
                    ->join('employers', 'employers.id', '=', 'vacancies.employer_id')
                    ->select('youths_vacancies.*', 'youths.*', 'youths.name as youth_name', 'vacancies.*', 'employers.*', 'employers.name as employer_name', 'employers.email as employer_email', 'employers.phone as employer_phone', 'youths_vacancies.id as application_id')
                    ->where('youths.branch_id', $branch_id)
                    ->orderBy('application_id', 'DESC')
                    ->get();

                $new_application_count = DB::table('youths_vacancies')
                    ->join('youths', 'youths.id', '=', 'youths_vacancies.youth_id')
                    ->where('youths.branch_id', $branch_id)
                    ->where('status', null)->count();
                //follwers
                $followers = DB::table('employers_follow_youths')
                    ->join('youths', 'youths.id', '=', 'employers_follow_youths.youth_id')
                    ->join('employers', 'employers.id', '=', 'employers_follow_youths.employer_id')
                    ->join('families', 'families.id', '=', 'youths.family_id')
                    ->select('employers_follow_youths.*', 'employers_follow_youths.id as employers_follow_youths_id', 'youths.*', 'youths.name as youth_name', 'youths.phone as youth_phone', 'youths.email as youth_email', 'employers.*', 'employers.name as employer_name', 'employers.address as employer_address', 'employers.phone as employer_phone', 'employers.email as employer_email', 'families.*', 'families.address as family_address')
                    ->where('youths.branch_id', $branch_id)
                    ->orderBy('employers_follow_youths_id', 'DESC')
                    ->get();

                $new_follower_count = DB::table('employers_follow_youths')
                    ->join('youths', 'youths.id', '=', 'employers_follow_youths.youth_id')
                    ->where('youths.branch_id', $branch_id)
                    ->where('status', null)->count();
                //bec targets
                $targets =  DB::table('table_targets')->where('branch_id', $branch_id)->first();

                //tasks

                $tasks = DB::table('todos')->orderBy('todos.id', 'DESC')->where('due_date', '>', date('Y-m-d'))->take(50)->get();

                $cg_youths = DB::table('completion_targets')
                    ->join('branches', 'branches.id', '=', 'completion_targets.branch_id')
                    ->select(DB::raw("SUM(target) as target"))
                    ->where('table_name', 'career_guidances')
                    ->where('branch_id', $branch_id)
                    ->first();

                $reports = DB::table('completion_targets')
                    ->join('branches', 'branches.id', '=', 'completion_targets.branch_id')
                    ->where('year', 'Reports')
                    ->where('branch_id', $branch_id)
                    ->get();

                $youths = DB::table('completion_targets')
                    ->join('branches', 'branches.id', '=', 'completion_targets.branch_id')
                    ->where('year', 'Youths')
                    ->where('branch_id', $branch_id)
                    ->get();


                $vt_ongoing = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->select(DB::raw('COUNT( ( CASE WHEN finacial_supports.end_date > CURDATE() THEN  finacial_support_id END)) as status'), DB::raw('count((CASE WHEN finacial_supports_youths.dropout = 1 THEN dropout END) )as vt_drop'))
                    ->where('branch_id', $branch_id)
                    ->where('course_type', 'Vocational Training')
                    ->first();

                $prof_ongoing = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->select(DB::raw('COUNT( ( CASE WHEN finacial_supports.end_date > CURDATE() THEN  finacial_support_id END)) as status'), DB::raw('count((CASE WHEN finacial_supports_youths.dropout = 1 THEN dropout END) )as prof_drop'))
                    ->where('branch_id', $branch_id)
                    ->where('course_type', 'Proffessional Training')
                    ->first();

                $gvt_ongoing = DB::table('course_supports_youth')
                    ->join('course_supports', 'course_supports.id', '=', 'course_supports_youth.course_support_id')
                    ->select(DB::raw('COUNT( ( CASE WHEN course_supports.end_date > CURDATE() THEN  course_support_id END)) as status'), DB::raw('count((CASE WHEN course_supports_youth.dropout = 1 THEN dropout END) )as gvt_drop'))
                    ->where('branch_id', $branch_id)
                    ->first();

                $soft_ongoing = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->select(DB::raw('COUNT( ( CASE WHEN provide_soft_skills.end_date > CURDATE() THEN  provide_softskill_id END)) as status'), DB::raw('count((CASE WHEN provide_soft_skills_youths.dropout = 1 THEN dropout END) )as soft_drop'))
                    ->where('branch_id', $branch_id)
                    ->first();



                $course_supports = DB::table('course_supports_youth')
                    ->join('course_supports', 'course_supports.id', '=', 'course_supports_youth.course_support_id')
                    ->where('branch_id', $branch_id)
                    ->count();

                $arrayName = array(
                    '1' => 0,
                    '2' => 0,
                    '3' => 0,
                    '4' => 0,
                    '5' => 0,
                    '6' => 0,
                    '7' => 0,
                );
                //soft skills youths status
                $soft_status = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                    ->select(DB::raw('COUNT(*) as count'), 'current_status')
                    ->groupBy('current_status')
                    ->where('branch_id', $branch_id)
                    ->get()->pluck('count', 'current_status');
                $soft_statusArray = $soft_status->all();
                $soft_status_array =  $soft_statusArray + $arrayName;
                ksort($soft_status_array);

                //gvt youths status
                $gvt_status = DB::table('course_supports_youth')
                    ->join('course_supports', 'course_supports.id', '=', 'course_supports_youth.course_support_id')
                    ->select(DB::raw('COUNT(*) as count'), 'current_status')
                    ->groupBy('current_status')
                    ->where('branch_id', $branch_id)
                    ->get()->pluck('count', 'current_status');
                $gvt_statusArray = $gvt_status->all();
                $gvt_status_array =  $gvt_statusArray + $arrayName;
                ksort($gvt_status_array);

                //vt youths status
                $vt_status = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->select(DB::raw('COUNT(*) as count'), 'current_status')
                    ->groupBy('current_status')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', $branch_id)
                    ->get()->pluck('count', 'current_status');
                $vt_statusArray = $vt_status->all();
                $vt_status_array =  $vt_statusArray + $arrayName;
                ksort($vt_status_array);

                //prof youths status
                $prof_status = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->select(DB::raw('COUNT(*) as count'), 'current_status')
                    ->groupBy('current_status')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', $branch_id)
                    ->get()->pluck('count', 'current_status');
                $prof_statusArray = $prof_status->all();
                $prof_status_array =  $prof_statusArray + $arrayName;
                ksort($prof_status_array);

                $total_status = array_map(function () {
                    return array_sum(func_get_args());
                },$soft_status_array, $gvt_status_array, $vt_status_array, $prof_status_array);
                //dd($total_status);
                return view('home')->with(['employers_count' => $employers_count, 'vacancies_count' => $vacancies_count, 'institutes_count' => $institutes_count, 'courses_count' => $courses_count, 'count_cg' => $count_cg, 'count_soft_skills' => $count_soft_skills, 'count_vt' => $count_vt, 'count_prof' => $count_prof, 'count_jobs' => $count_jobs, 'count_youth' => $count_youth, 'targets' => $targets, 'applications' => $applications, 'new_application_count' => $new_application_count,
                 'followers' => $followers, 'new_follower_count' => $new_follower_count, 'tasks' => $tasks, 'count_bss' => $count_bss, 'cg_youths' => $cg_youths, 'reports' => $reports, 'youths' => $youths, 'course_supports' => $course_supports, 'vt_ongoing' => $vt_ongoing, 'gvt_ongoing' => $gvt_ongoing, 'soft_ongoing' => $soft_ongoing, 'prof_ongoing' => $prof_ongoing, 'soft_status_array'=> $soft_status_array,
                 'gvt_status_array' => $gvt_status_array,
                 'vt_status_array' => $vt_status_array,
                 'prof_status_array' => $prof_status_array,
                 'total_status' => $total_status
                 ]);
                break;

            case 'dm':
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
                $count_youth = Youth::where('branch_id', $branch_id)->count();

                //CG count
                $count_cg = Youth::where('branch_id', $branch_id)->where('cg', 1)->count();

                //Soft Skills count
                $count_soft_skills = Youth::where('branch_id', $branch_id)->where('soft_skills', 1)->count();

                //vt count
                $count_vt = Youth::where('branch_id', $branch_id)->where('vt', 1)->count();

                //prof count
                $count_prof = Youth::where('branch_id', $branch_id)->where('prof', 1)->count();

                //jobs count
                $count_jobs = Youth::where('branch_id', $branch_id)->where('jobs', 1)->count();
                $count_bss = Youth::where('branch_id', $branch_id)->where('bss', 1)->count();

                //job applications
                $applications = DB::table('youths_vacancies')
                    ->join('youths', 'youths.id', '=', 'youths_vacancies.youth_id')
                    ->join('vacancies', 'vacancies.id', '=', 'youths_vacancies.vacancy_id')
                    ->join('employers', 'employers.id', '=', 'vacancies.employer_id')
                    ->select('youths_vacancies.*', 'youths.*', 'youths.name as youth_name', 'vacancies.*', 'employers.*', 'employers.name as employer_name', 'employers.email as employer_email', 'employers.phone as employer_phone', 'youths_vacancies.id as application_id')
                    ->where('youths.branch_id', $branch_id)
                    ->orderBy('application_id', 'DESC')
                    ->get();

                $new_application_count = DB::table('youths_vacancies')
                    ->join('youths', 'youths.id', '=', 'youths_vacancies.youth_id')
                    ->where('youths.branch_id', $branch_id)
                    ->where('status', null)->count();
                //follwers
                $followers = DB::table('employers_follow_youths')
                    ->join('youths', 'youths.id', '=', 'employers_follow_youths.youth_id')
                    ->join('employers', 'employers.id', '=', 'employers_follow_youths.employer_id')
                    ->join('families', 'families.id', '=', 'youths.family_id')
                    ->select('employers_follow_youths.*', 'employers_follow_youths.id as employers_follow_youths_id', 'youths.*', 'youths.name as youth_name', 'youths.phone as youth_phone', 'youths.email as youth_email', 'employers.*', 'employers.name as employer_name', 'employers.address as employer_address', 'employers.phone as employer_phone', 'employers.email as employer_email', 'families.*', 'families.address as family_address')
                    ->where('youths.branch_id', $branch_id)
                    ->orderBy('employers_follow_youths_id', 'DESC')
                    ->get();

                $new_follower_count = DB::table('employers_follow_youths')
                    ->join('youths', 'youths.id', '=', 'employers_follow_youths.youth_id')
                    ->where('youths.branch_id', $branch_id)
                    ->where('status', null)->count();
                //bec targets
                $targets =  DB::table('table_targets')->where('branch_id', $branch_id)->first();

                //tasks

                $tasks = DB::table('todos')->orderBy('todos.id', 'DESC')->take(50)->get();
                return view('home')->with(['employers_count' => $employers_count, 'vacancies_count' => $vacancies_count, 'institutes_count' => $institutes_count, 'courses_count' => $courses_count, 'count_cg' => $count_cg, 'count_soft_skills' => $count_soft_skills, 'count_vt' => $count_vt, 'count_prof' => $count_prof, 'count_jobs' => $count_jobs, 'count_youth' => $count_youth, 'targets' => $targets, 'applications' => $applications, 'new_application_count' => $new_application_count, 'followers' => $followers, 'new_follower_count' => $new_follower_count, 'tasks' => $tasks, 'count_bss' => $count_bss, 'corona' => $response]);
                break;

            case 'employer':
                $employer_id = Auth::id();
                $vacancies_count = Vacancy::where('employer_id', $employer_id)->count();
                $vacancies = Vacancy::where('employer_id', $employer_id)->get()->take(10);

                $applications = DB::table('youths_vacancies')->join('vacancies', 'vacancies.id', '=', 'youths_vacancies.vacancy_id')
                    ->join('youths', 'youths.id', '=', 'youths_vacancies.youth_id')
                    ->where('vacancies.employer_id', $employer_id)->get()->take(10);
                $followers = DB::table('employers_follow_youths')->where('employer_id', $employer_id)->count();

                return view('home')->with(['vacancies' => $vacancies, 'vacancies_count' => $vacancies_count, 'applications' => $applications, 'followers' => $followers]);
                break;

            case 'me':

                //Count youth in each branches
                $count_NE_youth = Youth::where('branch_id', 1)->count();
                $count_TRIN_youth = Youth::where('branch_id', 2)->count();
                $count_KEG_youth = Youth::where('branch_id', 3)->count();
                $count_GINI_youth = Youth::where('branch_id', 5)->count();
                $count_BAT_youth = Youth::where('branch_id', 6)->count();
                $count_ANU_youth = Youth::where('branch_id', 7)->count();
                $count_MUL_youth = Youth::where('branch_id', 8)->count();


                //count VT branch wise
                $count_NE_vt =  DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 1)->count();
                $count_TRIN_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 2)->count();
                $count_KEG_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 3)->count();
                $count_GINI_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 5)->count();
                $count_BAT_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 6)->count();
                $count_ANU_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 7)->count();
                $count_MUL_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 8)->count();

                $actual_vt = ($count_NE_vt + $count_TRIN_vt + $count_KEG_vt + $count_GINI_vt + $count_BAT_vt + $count_ANU_vt + $count_MUL_vt);

                //count CG branch wise
                $count_NE_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 1)->count();
                $count_TRIN_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 2)->count();
                $count_KEG_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 3)->count();
                $count_GINI_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 5)->count();
                $count_BAT_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 6)->count();
                $count_ANU_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 7)->count();
                $count_MUL_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 8)->count();

                $actual_cg = ($count_NE_cg + $count_TRIN_cg + $count_KEG_cg + $count_GINI_cg + $count_BAT_cg + $count_ANU_cg + $count_MUL_cg);

                //count soft branch wise
                $count_NE_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 1)->count();
                $count_TRIN_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 2)->count();
                $count_KEG_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 3)->count();
                $count_GINI_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 5)->count();
                $count_BAT_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 6)->count();
                $count_ANU_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 7)->count();
                $count_MUL_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 8)->count();

                $actual_soft_skills = ($count_NE_soft_skills + $count_TRIN_soft_skills + $count_KEG_soft_skills + $count_GINI_soft_skills + $count_BAT_soft_skills + $count_ANU_soft_skills + $count_MUL_soft_skills);

                //count Prof branch wise
                $count_NE_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 1)->count();
                $count_TRIN_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 2)->count();
                $count_KEG_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 3)->count();
                $count_GINI_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 5)->count();
                $count_BAT_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 6)->count();
                $count_ANU_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 7)->count();
                $count_MUL_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 8)->count();

                $actual_prof = ($count_NE_prof + $count_TRIN_prof + $count_KEG_prof + $count_GINI_prof + $count_BAT_prof + $count_ANU_prof + $count_MUL_prof);

                //count jobs branch wise
                $jobs_fair_NE = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 1)->count();
                $jobs_fair_TRIN = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 2)->count();
                $jobs_fair_KEG = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 3)->count();
                $jobs_fair_GINI = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 5)->count();
                $jobs_fair_BAT = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 6)->count();
                $jobs_fair_ANU = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 7)->count();
                $jobs_fair_MUL = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 8)->count();
                $count_NE_jobs = DB::table('placement_individual')
                    ->where('branch_id', 1)
                    ->count() + $jobs_fair_NE;
                $count_TRIN_jobs = DB::table('placement_individual')
                    ->where('branch_id', 2)
                    ->count() + $jobs_fair_TRIN;
                $count_KEG_jobs = DB::table('placement_individual')
                    ->where('branch_id', 3)
                    ->count() + $jobs_fair_KEG;
                $count_GINI_jobs = DB::table('placement_individual')
                    ->where('branch_id', 5)
                    ->count() + $jobs_fair_GINI;
                $count_BAT_jobs = DB::table('placement_individual')
                    ->where('branch_id', 6)
                    ->count() + $jobs_fair_BAT;
                $count_ANU_jobs = DB::table('placement_individual')
                    ->where('branch_id', 7)
                    ->count() + $jobs_fair_ANU;
                $count_MUL_jobs = DB::table('placement_individual')
                    ->where('branch_id', 8)
                    ->count() + $jobs_fair_MUL;

                $actual_jobs = ($count_NE_jobs + $count_TRIN_jobs + $count_KEG_jobs + $count_GINI_jobs + $count_BAT_jobs + $count_ANU_jobs + $count_MUL_jobs);

                //count bss branch wise
                $count_NE_bss = Youth::where('bss', 1)->where('branch_id', 1)->count();
                $count_TRIN_bss = Youth::where('bss', 1)->where('branch_id', 2)->count();
                $count_KEG_bss = Youth::where('bss', 1)->where('branch_id', 3)->count();
                $count_GINI_bss = Youth::where('bss', 1)->where('branch_id', 5)->count();
                $count_BAT_bss = Youth::where('bss', 1)->where('branch_id', '=', 6)->count();
                $count_ANU_bss = Youth::where('bss', 1)->where('branch_id', 7)->count();
                $count_MUL_bss = Youth::where('bss', 1)->where('branch_id', 8)->count();

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

                $total_reports =  DB::table('audits')
                    ->join('users', 'users.id', '=', 'audits.user_id')
                    ->join('branches', 'branches.id', '=', 'users.branch')
                    ->select('audits.*', 'users.name as user_name', 'branches.name as branch_name')
                    ->whereIn('auditable_type', ['assesments', 'awareness', 'career_guidances', 'course_supports', 'finacial_supports', 'households', 'incoperation_soft_skills', 'institute_reviews', 'kickoffs', 'mentoring', 'partner_trainings', 'pes_unit_supports', 'pes_units', 'placements', 'placement_individual', 'provide_soft_skills', 'regional_meetings', 'stake_holder_meetings', 'tot_cg', 'tvec_meetings', 'cg_trainings'])
                    ->where('event', 'created')
                    ->latest()
                    ->get();
                $total_reports_day =  DB::table('audits')
                    ->whereIn('auditable_type', ['assesments', 'awareness', 'career_guidances', 'course_supports', 'finacial_supports', 'households', 'incoperation_soft_skills', 'institute_reviews', 'kickoffs', 'mentoring', 'partner_trainings', 'pes_unit_supports', 'pes_units', 'placements', 'placement_individual', 'provide_soft_skills', 'regional_meetings', 'stake_holder_meetings', 'tot_cg', 'tvec_meetings', 'cg_trainings'])
                    ->where('event', 'created')
                    ->whereDate('created_at', Carbon::today())
                    ->count();


                return view('home')->with(['count_NE_youth' => $count_NE_youth, 'count_TRIN_youth' => $count_TRIN_youth, 'count_KEG_youth' => $count_KEG_youth, 'count_GINI_youth' => $count_GINI_youth, 'count_BAT_youth' => $count_BAT_youth, 'count_ANU_youth' => $count_ANU_youth, 'count_MUL_youth' => $count_MUL_youth, 'count_NE_vt' => $count_NE_vt, 'count_TRIN_vt' => $count_TRIN_vt, 'count_KEG_vt' => $count_KEG_vt, 'count_GINI_vt' => $count_GINI_vt, 'count_BAT_vt' => $count_BAT_vt, 'count_ANU_vt' => $count_ANU_vt, 'count_MUL_vt' => $count_MUL_vt, 'count_NE_cg' => $count_NE_cg, 'count_TRIN_cg' => $count_TRIN_cg, 'count_KEG_cg' => $count_KEG_cg, 'count_GINI_cg' => $count_GINI_cg, 'count_BAT_cg' => $count_BAT_cg, 'count_ANU_cg' => $count_ANU_cg, 'count_MUL_cg' => $count_MUL_cg, 'count_NE_soft_skills' => $count_NE_soft_skills, 'count_TRIN_soft_skills' => $count_TRIN_soft_skills, 'count_KEG_soft_skills' => $count_KEG_soft_skills, 'count_GINI_soft_skills' => $count_GINI_soft_skills, 'count_BAT_soft_skills' => $count_BAT_soft_skills, 'count_ANU_soft_skills' => $count_ANU_soft_skills, 'count_MUL_soft_skills' => $count_MUL_soft_skills, 'count_NE_prof' => $count_NE_prof, 'count_TRIN_prof' => $count_TRIN_prof, 'count_KEG_prof' => $count_KEG_prof, 'count_GINI_prof' => $count_GINI_prof, 'count_BAT_prof' => $count_BAT_prof, 'count_ANU_prof' => $count_ANU_prof, 'count_MUL_prof' => $count_MUL_prof, 'count_NE_jobs' => $count_NE_jobs, 'count_TRIN_jobs' => $count_TRIN_jobs, 'count_KEG_jobs' => $count_KEG_jobs, 'count_GINI_jobs' => $count_GINI_jobs, 'count_BAT_jobs' => $count_BAT_jobs, 'count_ANU_jobs' => $count_ANU_jobs, 'count_MUL_jobs' => $count_MUL_jobs, 'total_cg' => $total_cg, 'total_soft' => $total_soft, 'total_vt' => $total_vt, 'total_prof' => $total_prof, 'total_jobs' => $total_jobs, 'actual_cg' => $actual_cg, 'actual_jobs' => $actual_jobs, 'actual_vt' => $actual_vt, 'actual_prof' => $actual_prof, 'actual_soft_skills' => $actual_soft_skills, 'count_NE_bss' => $count_NE_bss, 'count_MUL_bss' => $count_MUL_bss, 'count_ANU_bss' => $count_ANU_bss, 'count_BAT_bss' => $count_BAT_bss, 'count_GINI_bss' => $count_GINI_bss, 'count_KEG_bss' => $count_KEG_bss, 'count_TRIN_bss' => $count_TRIN_bss, 'total_reports' => $total_reports, 'total_reports_day' => $total_reports_day]);

                break;

            case 'management':
                //Count youth in each branches
                $count_NE_youth = Youth::where('branch_id', 1)->count();
                $count_TRIN_youth = Youth::where('branch_id', 2)->count();
                $count_KEG_youth = Youth::where('branch_id', 3)->count();
                $count_GINI_youth = Youth::where('branch_id', 5)->count();
                $count_BAT_youth = Youth::where('branch_id', 6)->count();
                $count_ANU_youth = Youth::where('branch_id', 7)->count();
                $count_MUL_youth = Youth::where('branch_id', 8)->count();

                $total_youths = $count_NE_youth + $count_TRIN_youth + $count_KEG_youth + $count_GINI_youth + $count_BAT_youth + $count_ANU_youth + $count_MUL_youth;


                //count VT branch wise
                $count_NE_vt =  DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 1)->count();
                $count_TRIN_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 2)->count();
                $count_KEG_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 3)->count();
                $count_GINI_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 5)->count();
                $count_BAT_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 6)->count();
                $count_ANU_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 7)->count();
                $count_MUL_vt = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Vocational Training')
                    ->where('branch_id', 8)->count();

                $actual_vt = ($count_NE_vt + $count_TRIN_vt + $count_KEG_vt + $count_GINI_vt + $count_BAT_vt + $count_ANU_vt + $count_MUL_vt);

                //count CG branch wise
                $count_NE_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 1)->count();
                $count_TRIN_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 2)->count();
                $count_KEG_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 3)->count();
                $count_GINI_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 5)->count();
                $count_BAT_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 6)->count();
                $count_ANU_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 7)->count();
                $count_MUL_cg = DB::table('cg_youths')
                    ->join('career_guidances', 'career_guidances.id', '=', 'cg_youths.career_guidances_id')
                    ->where('branch_id', 8)->count();

                $actual_cg = ($count_NE_cg + $count_TRIN_cg + $count_KEG_cg + $count_GINI_cg + $count_BAT_cg + $count_ANU_cg + $count_MUL_cg);

                //count soft branch wise
                $count_NE_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 1)->count();
                $count_TRIN_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 2)->count();
                $count_KEG_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 3)->count();
                $count_GINI_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 5)->count();
                $count_BAT_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 6)->count();
                $count_ANU_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 7)->count();
                $count_MUL_soft_skills = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->where('branch_id', 8)->count();

                $actual_soft_skills = ($count_NE_soft_skills + $count_TRIN_soft_skills + $count_KEG_soft_skills + $count_GINI_soft_skills + $count_BAT_soft_skills + $count_ANU_soft_skills + $count_MUL_soft_skills);

                //count Prof branch wise
                $count_NE_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 1)->count();
                $count_TRIN_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 2)->count();
                $count_KEG_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 3)->count();
                $count_GINI_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 5)->count();
                $count_BAT_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 6)->count();
                $count_ANU_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 7)->count();
                $count_MUL_prof = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->where('course_type', 'Proffessional Training')
                    ->where('branch_id', 8)->count();

                $actual_prof = ($count_NE_prof + $count_TRIN_prof + $count_KEG_prof + $count_GINI_prof + $count_BAT_prof + $count_ANU_prof + $count_MUL_prof);

                //count jobs branch wise
                $jobs_fair_NE = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 1)->count();
                $jobs_fair_TRIN = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 2)->count();
                $jobs_fair_KEG = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 3)->count();
                $jobs_fair_GINI = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 5)->count();
                $jobs_fair_BAT = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 6)->count();
                $jobs_fair_ANU = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 7)->count();
                $jobs_fair_MUL = DB::table('placements_youths')
                    ->join('placements', 'placements.id', '=', 'placements_youths.placements_id')
                    ->where('branch_id', 8)->count();
                $count_NE_jobs = DB::table('placement_individual')
                    ->where('branch_id', 1)
                    ->count() + $jobs_fair_NE;
                $count_TRIN_jobs = DB::table('placement_individual')
                    ->where('branch_id', 2)
                    ->count() + $jobs_fair_TRIN;
                $count_KEG_jobs = DB::table('placement_individual')
                    ->where('branch_id', 3)
                    ->count() + $jobs_fair_KEG;
                $count_GINI_jobs = DB::table('placement_individual')
                    ->where('branch_id', 5)
                    ->count() + $jobs_fair_GINI;
                $count_BAT_jobs = DB::table('placement_individual')
                    ->where('branch_id', 6)
                    ->count() + $jobs_fair_BAT;
                $count_ANU_jobs = DB::table('placement_individual')
                    ->where('branch_id', 7)
                    ->count() + $jobs_fair_ANU;
                $count_MUL_jobs = DB::table('placement_individual')
                    ->where('branch_id', 8)
                    ->count() + $jobs_fair_MUL;

                $actual_jobs = ($count_NE_jobs + $count_TRIN_jobs + $count_KEG_jobs + $count_GINI_jobs + $count_BAT_jobs + $count_ANU_jobs + $count_MUL_jobs);

                //count bss branch wise
                $count_NE_bss = Youth::where('bss', 1)->where('branch_id', 1)->count();
                $count_TRIN_bss = Youth::where('bss', 1)->where('branch_id', 2)->count();
                $count_KEG_bss = Youth::where('bss', 1)->where('branch_id', 3)->count();
                $count_GINI_bss = Youth::where('bss', 1)->where('branch_id', 5)->count();
                $count_BAT_bss = Youth::where('bss', 1)->where('branch_id', '=', 6)->count();
                $count_ANU_bss = Youth::where('bss', 1)->where('branch_id', 7)->count();
                $count_MUL_bss = Youth::where('bss', 1)->where('branch_id', 8)->count();

                $target_cg = DB::table('table_targets')->select(DB::raw('SUM(cg) as total_cg'))->first();
                $target_soft = DB::table('table_targets')->select(DB::raw('SUM(soft) as total_soft'))->first();
                $target_vt = DB::table('table_targets')->select(DB::raw('SUM(vt) as total_vt'))->first();
                $target_prof = DB::table('table_targets')->select(DB::raw('SUM(prof) as total_prof'))->first();
                $target_jobs = DB::table('table_targets')->select(DB::raw('SUM(jobs) as total_jobs'))->first();
                $target_gvt = DB::table('table_targets')->select(DB::raw('SUM(gvt) as total_gvt'))->first();
                $total_cg = $target_cg->total_cg;
                $total_soft = $target_soft->total_soft;
                $total_vt = $target_vt->total_vt;
                $total_prof = $target_prof->total_prof;
                $total_jobs = $target_jobs->total_jobs;
                $total_gvt = $target_gvt->total_gvt;

                $course_supports = DB::table('course_supports_youth')
                    ->join('course_supports', 'course_supports.id', '=', 'course_supports_youth.course_support_id')
                    ->count();

                $total_reports =  DB::table('audits')
                    ->join('users', 'users.id', '=', 'audits.user_id')
                    ->join('branches', 'branches.id', '=', 'users.branch')
                    ->select('audits.*', 'users.name as user_name', 'branches.name as branch_name')
                    ->whereIn('auditable_type', ['assesments', 'awareness', 'career_guidances', 'course_supports', 'finacial_supports', 'households', 'incoperation_soft_skills', 'institute_reviews', 'kickoffs', 'mentoring', 'partner_trainings', 'pes_unit_supports', 'pes_units', 'placements', 'placement_individual', 'provide_soft_skills', 'regional_meetings', 'stake_holder_meetings', 'tot_cg', 'tvec_meetings', 'cg_trainings'])
                    ->where('event', 'created')
                    ->latest()
                    ->get();
                $total_reports_day =  DB::table('audits')
                    ->whereIn('auditable_type', ['assesments', 'awareness', 'career_guidances', 'course_supports', 'finacial_supports', 'households', 'incoperation_soft_skills', 'institute_reviews', 'kickoffs', 'mentoring', 'partner_trainings', 'pes_unit_supports', 'pes_units', 'placements', 'placement_individual', 'provide_soft_skills', 'regional_meetings', 'stake_holder_meetings', 'tot_cg', 'tvec_meetings', 'cg_trainings'])
                    ->where('event', 'created')
                    ->whereDate('created_at', Carbon::today())
                    ->count();

                $vt_ongoing = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->select(DB::raw('COUNT( ( CASE WHEN finacial_supports.end_date > CURDATE() THEN  finacial_support_id END)) as status'), DB::raw('count((CASE WHEN finacial_supports_youths.dropout = 1 THEN dropout END) )as vt_drop'))
                    ->where('course_type', 'Vocational Training')
                    ->first();

                $prof_ongoing = DB::table('finacial_supports_youths')
                    ->join('finacial_supports', 'finacial_supports.id', '=', 'finacial_supports_youths.finacial_support_id')
                    ->join('courses', 'courses.id', '=', 'finacial_supports.course_id')
                    ->select(DB::raw('COUNT( ( CASE WHEN finacial_supports.end_date > CURDATE() THEN  finacial_support_id END)) as status'), DB::raw('count((CASE WHEN finacial_supports_youths.dropout = 1 THEN dropout END) )as prof_drop'))
                    ->where('course_type', 'Proffessional Training')
                    ->first();

                $gvt_ongoing = DB::table('course_supports_youth')
                    ->join('course_supports', 'course_supports.id', '=', 'course_supports_youth.course_support_id')
                    ->select(DB::raw('COUNT( ( CASE WHEN course_supports.end_date > CURDATE() THEN  course_support_id END)) as status'), DB::raw('count((CASE WHEN course_supports_youth.dropout = 1 THEN dropout END) )as gvt_drop'))
                    ->first();

                $soft_ongoing = DB::table('provide_soft_skills_youths')
                    ->join('provide_soft_skills', 'provide_soft_skills.id', '=', 'provide_soft_skills_youths.provide_softskill_id')
                    ->select(DB::raw('COUNT( ( CASE WHEN provide_soft_skills.end_date > CURDATE() THEN  provide_softskill_id END)) as status'), DB::raw('count((CASE WHEN provide_soft_skills_youths.dropout = 1 THEN dropout END) )as soft_drop'))
                    ->first();


                return view('home')->with(['count_NE_youth' => $count_NE_youth, 'count_TRIN_youth' => $count_TRIN_youth, 'count_KEG_youth' => $count_KEG_youth, 'count_GINI_youth' => $count_GINI_youth, 'count_BAT_youth' => $count_BAT_youth, 'count_ANU_youth' => $count_ANU_youth, 'count_MUL_youth' => $count_MUL_youth, 'count_NE_vt' => $count_NE_vt, 'count_TRIN_vt' => $count_TRIN_vt, 'count_KEG_vt' => $count_KEG_vt, 'count_GINI_vt' => $count_GINI_vt, 'count_BAT_vt' => $count_BAT_vt, 'count_ANU_vt' => $count_ANU_vt, 'count_MUL_vt' => $count_MUL_vt, 'count_NE_cg' => $count_NE_cg, 'count_TRIN_cg' => $count_TRIN_cg, 'count_KEG_cg' => $count_KEG_cg, 'count_GINI_cg' => $count_GINI_cg, 'count_BAT_cg' => $count_BAT_cg, 'count_ANU_cg' => $count_ANU_cg, 'count_MUL_cg' => $count_MUL_cg, 'count_NE_soft_skills' => $count_NE_soft_skills, 'count_TRIN_soft_skills' => $count_TRIN_soft_skills, 'count_KEG_soft_skills' => $count_KEG_soft_skills, 'count_GINI_soft_skills' => $count_GINI_soft_skills, 'count_BAT_soft_skills' => $count_BAT_soft_skills, 'count_ANU_soft_skills' => $count_ANU_soft_skills, 'count_MUL_soft_skills' => $count_MUL_soft_skills, 'count_NE_prof' => $count_NE_prof, 'count_TRIN_prof' => $count_TRIN_prof, 'count_KEG_prof' => $count_KEG_prof, 'count_GINI_prof' => $count_GINI_prof, 'count_BAT_prof' => $count_BAT_prof, 'count_ANU_prof' => $count_ANU_prof, 'count_MUL_prof' => $count_MUL_prof, 'count_NE_jobs' => $count_NE_jobs, 'count_TRIN_jobs' => $count_TRIN_jobs, 'count_KEG_jobs' => $count_KEG_jobs, 'count_GINI_jobs' => $count_GINI_jobs, 'count_BAT_jobs' => $count_BAT_jobs, 'count_ANU_jobs' => $count_ANU_jobs, 'count_MUL_jobs' => $count_MUL_jobs, 'total_cg' => $total_cg, 'total_soft' => $total_soft, 'total_vt' => $total_vt, 'total_prof' => $total_prof, 'total_jobs' => $total_jobs, 'actual_cg' => $actual_cg, 'actual_jobs' => $actual_jobs, 'actual_vt' => $actual_vt, 'actual_prof' => $actual_prof, 'actual_soft_skills' => $actual_soft_skills, 'count_NE_bss' => $count_NE_bss, 'count_MUL_bss' => $count_MUL_bss, 'count_ANU_bss' => $count_ANU_bss, 'count_BAT_bss' => $count_BAT_bss, 'count_GINI_bss' => $count_GINI_bss, 'count_KEG_bss' => $count_KEG_bss, 'count_TRIN_bss' => $count_TRIN_bss, 'total_reports' => $total_reports, 'total_reports_day' => $total_reports_day, 'course_supports' => $course_supports, 'vt_ongoing' => $vt_ongoing, 'gvt_ongoing' => $gvt_ongoing, 'soft_ongoing' => $soft_ongoing, 'prof_ongoing' => $prof_ongoing, 'total_youths' => $total_youths, 'total_gvt' => $total_gvt]);
                break;
            default:
                # code...
                break;
        }
    }

    public function backups()
    {
        $directory = storage_path() . "/app/BEC-MIS";
        $backups = File::allFiles($directory);

        // dd($backups);
        return view('dashboards.backups', compact('backups'));
    }
    public function backup($filename)
    {
        //Suppose profile.docx file is stored under project/public/download/profile.docx
        $file = storage_path() . "/app/BEC-MIS/" . $filename;
        $headers = array(
            'Content-Type: application/zip',
        );
        return Response::download($file, $filename, $headers);
    }
}

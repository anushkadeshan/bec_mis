<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use App\User;
use App\Mail\WeeklyReport;
use Mail;
class CommandWeeklyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Report:Week';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Weekly report to managament';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $cg = DB::table('cg_youths')
              ->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
              ->join('branches','branches.id','=','career_guidances.branch_id')
              ->select(DB::raw('count(cg_youths.youth_id) as count'), 'branches.name as branch_name','program_date')
              ->whereBetween('career_guidances.program_date',[Carbon::now()->startOfWeek()->toDateTimeString(), Carbon::now()->endOfWeek()->toDateTimeString()])
              ->groupBy('branch_id')
              ->get();
        $data['cg'] = $cg;

        $soft = DB::table('provide_soft_skills_youths')
              ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
              ->join('branches','branches.id','=','provide_soft_skills.branch_id')
              ->select(DB::raw('count(provide_soft_skills_youths.youth_id) as count'), 'branches.name as branch_name','program_date')
              ->whereBetween('provide_soft_skills.program_date',[Carbon::now()->startOfWeek()->toDateTimeString(), Carbon::now()->endOfWeek()->toDateTimeString()])
              ->groupBy('branch_id')
              ->get();
        $data['soft'] = $soft;

        $vt = DB::table('finacial_supports_youths')
              ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
              ->join('branches','branches.id','=','finacial_supports.branch_id')
              ->select(DB::raw('count(finacial_supports_youths.youth_id) as count'), 'branches.name as branch_name','program_date')
              ->whereBetween('finacial_supports.program_date',[Carbon::now()->startOfWeek()->toDateTimeString(), Carbon::now()->endOfWeek()->toDateTimeString()])
              ->groupBy('branch_id')
              ->get();
        $data['vt'] = $vt;

        $gvt = DB::table('course_supports_youth')
              ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
              ->join('branches','branches.id','=','course_supports.branch_id')
              ->select(DB::raw('count(course_supports_youth.youth_id) as count'), 'branches.name as branch_name','program_date')
              ->whereBetween('course_supports.program_date',[Carbon::now()->startOfWeek()->toDateTimeString(), Carbon::now()->endOfWeek()->toDateTimeString()])
              ->groupBy('branch_id')
              ->get();
        $data['gvt'] = $gvt;

        $placement = DB::table('placement_individual')
              ->join('branches','branches.id','=','placement_individual.branch_id')
              ->select(DB::raw('count(placement_individual.youth_id) as count'), 'branches.name as branch_name','program_date')
              ->whereBetween('placement_individual.created_at',[Carbon::now()->startOfWeek()->toDateTimeString(), Carbon::now()->endOfWeek()->toDateTimeString()])
              ->groupBy('branch_id')
              ->get();
        $data['placement'] = $placement;
        $data['date1'] = Carbon::now()->startOfWeek()->toDateString();
        $data['date2'] = Carbon::now()->endOfWeek()->toDateString();

              $notifyTo = User::whereHas('roles', function($q){$q->whereIn('slug', ['admin','management','branch']);})->get();
              foreach ($notifyTo as $notifyUser) {
                    Mail::to($notifyUser->email)->send(new WeeklyReport($data));
              }
              
    }
}

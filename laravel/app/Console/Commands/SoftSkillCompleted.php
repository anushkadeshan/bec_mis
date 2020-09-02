<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\FinishedSoftSkills;
use App\User;
use DB;
use Auth;

class SoftSkillCompleted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:soft_skills_finished';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notifications to DM about Soft Skills course finished youths';

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
        $notifyTo = User::whereHas('roles', function($q){$q->whereIn('slug', ['branch']);})->get();
                foreach ($notifyTo as $notifyUser) {
                    $youths = DB::table('provide_soft_skills_youths')
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->whereDate('provide_soft_skills.end_date', '=',  date('Y-m-d'))
                        ->where('provide_soft_skills.branch_id','=', $notifyUser->branch)
                        ->get(); 

                   if($youths->count()==0){
                     echo nl2br ("No data to send an email");  
                    }
                    else{
                        $branch_id = $notifyUser->branch;
                        $notifyUser->notify(new FinishedSoftSkills($youths,$branch_id));
                    }
                    //echo "<script>console.log('Debug Objects: " . $youths . "' );</script>";
                } 
    }
}

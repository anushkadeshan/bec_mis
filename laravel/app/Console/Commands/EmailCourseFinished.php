<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use App\Notifications\CourseFinished;
use App\User;
use Auth;

class EmailCourseFinished extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:course_finished';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notifications to DM about course finished youths but no jobs after 30 days';

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
                    $youths = DB::table('finacial_supports_youths')
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->whereDate('finacial_supports.end_date', '=',  date('Y-m-d'))
                        ->where('finacial_supports.branch_id','=', $notifyUser->branch)
                        ->get(); 

                    
                   if($youths->count()==0){
                     echo nl2br ("No data to send an email");  
                    }
                    else{
                        $branch_id = $notifyUser->branch;
                        $notifyUser->notify(new CourseFinished($youths,$branch_id));
                    }
                    //echo "<script>console.log('Debug Objects: " . $youths . "' );</script>";
                }      
    }
}

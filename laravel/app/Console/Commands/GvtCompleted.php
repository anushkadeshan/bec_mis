<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\FinishedGvtCourse;
use App\User;
use DB;
use Auth;

class GvtCompleted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:gvt_finished';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notifications to DM about Government course finished youths';

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
                    $youths = DB::table('course_supports_youth')
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->whereDate('course_supports.end_date', '=',  date('Y-m-d'))
                        ->where('course_supports.branch_id','=', $notifyUser->branch)
                        ->get(); 

                    
                  if($youths->count()==0){
                     echo nl2br ("No data to send an email");  
                    }
                    else{ 
                        $branch_id = $notifyUser->branch;
                        $notifyUser->notify(new FinishedGvtCourse($youths,$branch_id));
                    }
                    //echo "<script>console.log('Debug Objects: " . $youths . "' );</script>";
                } 
    }
}

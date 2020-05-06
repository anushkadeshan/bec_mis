<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\NotifyFinancial_notInJob;
use App\User;
use DB;
use Auth;
class financial_notInJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:financial_notInJobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notifications to DM about not in job youths but given finacial supports';

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

                $placements = DB::table('placements_youths')
                                ->pluck('placements_youths.youth_id')->toArray();

                    $individual = DB::table('placement_individual')
                                ->pluck('youth_id')->toArray();

                    $youths = array_merge($placements,$individual);

                foreach ($notifyTo as $notifyUser) {
                
                    $not_placed = DB::table('finacial_supports_youths')
                                ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                                ->where('end_date', '<', date("Y-m-d"))
                                ->where('finacial_supports.branch_id',$notifyUser->branch)
                                ->whereNotIn('youth_id', $youths)
                                ->get(); 

                    //dd($individual);
                    
                  if($not_placed->count()==0){
                     echo nl2br ("No data to send an email");  
                    }
                    else{ 
                        $branch_id = $notifyUser->branch;
                        $notifyUser->notify(new NotifyFinancial_notInJob($not_placed,$branch_id));
                    }
                    //echo "<script>console.log('Debug Objects: " . $youths . "' );</script>";
                } 
    }

}

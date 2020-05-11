<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Pusher\Pusher;
use DB;

class sendPushNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:push';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Push Notifications';

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
        $tasks = DB::table('todos')
                  ->where('due_date','>', date('Y-m-d'))
                  ->get(); 
        $options = array(
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'encrypted' => true
                );
        $pusher = new Pusher(
                    env('PUSHER_APP_KEY'),
                    env('PUSHER_APP_SECRET'),
                    env('PUSHER_APP_ID'), 
                    $options
        );

        //$data['message'] = 'hellO welcome';
                foreach($tasks as $task){
                    $data = array(
                        'message' => 'Task Reminder !',
                        'name' => $task->task.' on or before ' .$task->due_date 
                    );
                    $pusher->trigger('user-channel', 'App\Events\userLogin', $data);
                }
                

                
    }
}

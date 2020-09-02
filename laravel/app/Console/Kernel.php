<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\EmailCourseFinished',
        'App\Console\Commands\SoftSkillCompleted',
        'App\Console\Commands\GvtCompleted',
        'App\Console\Commands\financial_notInJob',
        'App\Console\Commands\softSkills_notInJob',
        'App\Console\Commands\courseSupport_notInJob',
        'App\Console\Commands\sendPushNotifications',
        'App\Console\Commands\CommandWeeklyReport',
        'App\Console\Commands\SendMonthlyReport',
        'App\Console\Commands\SendYearToDateReport',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
                 // ->hourly();
        $schedule->command('backup:clean')->dailyAt('22:55')->timezone('Asia/Colombo')
                 ->withoutOverlapping();

       $schedule->command('backup:run')->twiceDaily(13, 23)->timezone('Asia/Colombo')
                 ->withoutOverlapping();
                 
        $schedule->command('notify:course_finished')
                 ->dailyAt('9:07')
                 ->timezone('Asia/Colombo')
                 ->withoutOverlapping();

       $schedule->command('notify:soft_skills_finished')
                 ->dailyAt('9:40')
                 ->timezone('Asia/Colombo')
                 ->withoutOverlapping();    

        $schedule->command('notify:gvt_finished')
                 ->dailyAt('16:22')
                 ->timezone('Asia/Colombo')
                 ->withoutOverlapping();   

        $schedule->command('notify:financial_notInJobs')
                  ->weekly()->mondays()->at('9:00')
                 ->timezone('Asia/Colombo')
                 ->withoutOverlapping(); 

        $schedule->command('notify:softskills_notInJobs')
                  ->weekly()->mondays()->at('12:43')
                 ->timezone('Asia/Colombo')
                 ->withoutOverlapping();

        $schedule->command('notify:course_supports_notInJobs')
                  ->weekly()->mondays()->at('12:56')
                 ->timezone('Asia/Colombo')
                 ->withoutOverlapping();


        $schedule->command('notify:push')
                  ->twiceDaily(10, 16)
                 ->timezone('Asia/Colombo')
                 ->withoutOverlapping();

        $schedule->command('Report:Week')
                  ->weekly()->sundays()->at('23:54')
                 ->timezone('Asia/Colombo')
                 ->withoutOverlapping();
        
        $schedule->command('Report:Month')
                  ->weekly()->sundays()->at('23:54')
                 ->timezone('Asia/Colombo')
                 ->withoutOverlapping();
        
        $schedule->command('Report:Month')->dailyAt('23:51')->timezone('Asia/Colombo')
                 ->withoutOverlapping()->when(function () {
                    return \Carbon\Carbon::now()->endOfMonth()->isToday();
        });    
        
        $schedule->command('Report:Cumalative')->dailyAt('23:45')->timezone('Asia/Colombo')
                 ->withoutOverlapping()->when(function () {
                    return \Carbon\Carbon::now()->endOfMonth()->isToday();
        });

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

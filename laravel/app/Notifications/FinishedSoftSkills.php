<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage; 

class FinishedSoftSkills extends Notification
{
    use Queueable;
    public $youths;
    public $branch_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(object $youths, $branch_id)
    {
        $this->youths = $youths;
        $this->branch_id = $branch_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $count = $this->youths->count();

        //$url =$this->branch_id;
        $url = url('/soft-skills-youth/days/'.$this->branch_id.'/'. date('Y-m-d'));
        return (new MailMessage)
                    ->subject(''.$count.' Soft Skills youths have finshed their course today')
                    ->greeting('Hello!')
                    ->line('BEC MIS detected that ' .$count.'  Soft Skills youths have completed their course. Please keep your close follow up on them untill they are employed. Click below botton to see the list of youth')
                    ->action('View youths', $url);

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

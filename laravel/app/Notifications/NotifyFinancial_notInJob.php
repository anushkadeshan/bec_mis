<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyFinancial_notInJob extends Notification
{
    use Queueable;
    public $not_placed;
    public $branch_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(object $not_placed, $branch_id)
    {
        $this->not_placed = $not_placed;
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
        $count = $this->not_placed->count();

        //$url =$this->branch_id;
        $url = url('/finacial-not-in-job/'.$this->branch_id.'/'. date('Y-m-d'));
        return (new MailMessage)
                    ->subject(''.$count.' financially assisted youths not in job but they have finished their course')
                    ->greeting('Hello!')
                    ->line('BEC MIS detected that ' .$count.' financially assisted youths not in job but they have completed their course. Please keep your close follow up on them untill they are employed. Click below botton to see the list of youth')
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

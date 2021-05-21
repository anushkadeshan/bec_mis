<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FamilyAdd extends Notification
{
    use Queueable;
    public $added_by;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($added_by)
    {
        $this->added_by = $added_by;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public function broadcastType(){
         return 'broadcast.FamilyAdd';
     }

    public function toBroadcast($notifiable)
    {
        return [
            'added_by' => $this->added_by
        ];
    }
}

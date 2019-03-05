<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FollowYouth extends Notification
{
    use Queueable;
    public $employer;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(object $employer)
    {
         $this->employer = $employer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $title = $this->employer->name;
        $url = url('youth/applications');
        return (new MailMessage)
                ->subject(''.$title.' select some youth to hire. ')
                ->greeting('Hello!')
                ->line('This is to inform you that '.$title. ' has been selected a youth to hire. ')
                ->action('View details', $url)
                ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return ['employer' => $this->employer];
    }
}

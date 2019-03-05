<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Vacancy;

class applyVacancy extends Notification
{
    use Queueable;
    public $vacancy;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(object $vacancy)
    {
        $this->vacancy = $vacancy;
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
    public function toDatabase($notifiable)
    {
        return ['vacancy' => $this->vacancy];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toMail($notifiable)
    {
        $title = $this->vacancy->title;
        $url = url('youth/applications');
        return (new MailMessage)
                ->subject('Application recived for '.$title.'')
                ->greeting('Hello!')
                ->line('This is to inform you that one application has been recived for the '.$title. ' vacancy. ')
                ->action('View aplication', $url)
                ->line('Thank you for using our application!');
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Audit;

class CompletionReport extends Notification
{
    use Queueable;
    public $reports;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reports)
    {
        $this->reports = $reports;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $title = $this->reports->auditable_type;
        $url = url('/m&e-reports');
        return (new MailMessage)
                ->subject('A Completion Report is added.')
                ->greeting('Hello !')
                ->line('This is to inform you that a completion report is added .')
                ->line('Please see the report as soon as possible.')
                ->line('Report :'.$title.'')
                ->action('See Report', $url)
                ->line('Thank you for your valuble time!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'report' => $this->reports
        ];
    }
}

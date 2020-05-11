<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use App\Todo;
class TaskCreated extends Notification
{
    use Queueable;
    public $tasks;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($tasks)
    {
        $this->tasks = $tasks; 
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $title = $this->tasks->task;
        $due_date = $this->tasks->due_date;
        $url = url('/home');
        return (new MailMessage)
                ->subject('New Task : '.$title.'.')
                ->greeting('Hello Dear Team!')
                ->line('This is to inform you that you were assigned to new task.')
                ->line('Please pay your attention to complete that task before the due date.')
                ->line('Task :'.$title.'')
                ->line('Due Date :'.$due_date.'')
                ->action('Sign in', $url)
                ->line('Thank you for your valuble time!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function broadcastType()
    {
        return 'broadcast.TaskCreated';
    }

    public function toBroadcast($notifiable)
    {
        return [
            'title' => $this->tasks->task, 
            'due' => $this->tasks->due_date,
 
        ];
    }
}

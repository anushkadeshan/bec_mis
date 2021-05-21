<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WeeklyReport extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
         $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() 
    {
        return $this->subject('Weekly Report from '. $this->data['date1']. ' to ' .$this->data['date2'].'')->markdown('mail-notifications.weekly-report')->withData($this->data);
    }
}

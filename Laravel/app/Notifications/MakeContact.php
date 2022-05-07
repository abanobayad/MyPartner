<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MakeContact extends Notification
{
    use Queueable;
    private $details;
    public function __construct($data)
    {
        $this->details =  $data;
    }

    public function via($notifiable)
    {
        return ['database'];
    }



    public function toDatabase($notifiable)
    {
        return [
           'data' => $this->details
        ];
    }
}

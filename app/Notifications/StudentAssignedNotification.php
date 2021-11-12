<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentAssignedNotification extends Notification
{
    use Queueable;
    public $studid;
    public $studname;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($studid,$studname)
    {
        $this->studid = $studid;
        $this->studname= $studname;
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
        return (new MailMessage)
                    ->line('Student with id: '.$this->studid.' name: '.$this->studname.' has been assigned to you');
                   
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
            'data' => 'Student with id: '.$this->studid.'name: '.$this->studname.'has been assigned to you'
        ];
    }
}

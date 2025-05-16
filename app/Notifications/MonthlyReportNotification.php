<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MonthlyReportNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $pdfPath;

    public function __construct($pdfPath)
    {
        $this->pdfPath = $pdfPath;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; 
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Monthly Report')
            ->line('Your monthly expense report is attached.')
            ->attach($this->pdfPath);
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Monthly report email sent.',
            'path' => $this->pdfPath,
        ];
    }
}

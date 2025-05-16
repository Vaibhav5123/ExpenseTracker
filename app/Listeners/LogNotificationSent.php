<?php

namespace App\Listeners;

use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Support\Facades\Log;

class LogNotificationSent
{
    public function handle(NotificationSent $event)
    {
        
        $user = $event->notifiable;
        $notification = $event->notification;

        Log::info("Notification sent to user {$user->email} with notification: " . get_class($notification));
    }
}

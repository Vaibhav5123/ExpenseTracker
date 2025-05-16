<?php

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Log;

class LogSentEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageSent $event)
    {
        $to = implode(', ', array_keys($event->message->getTo() ?? []));
        $subject = $event->message->getSubject();

        Log::info("Email sent to {$to} with subject: {$subject}");
    }
}

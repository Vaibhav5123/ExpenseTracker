<?php
namespace App\Providers;

use Illuminate\Mail\Events\MessageSent;
use App\Listeners\LogSentEmail;
use Illuminate\Support\ServiceProvider;
use App\Listeners\LogNotificationSent;
use Illuminate\Notifications\Events\NotificationSent;

class EventServiceProvider extends ServiceProvider{

    protected $listen = [
        MessageSent::class => [
            LogSentEmail::class,
        ],
        NotificationSent::class => [
            LogNotificationSent::class,
        ],
    ];
}
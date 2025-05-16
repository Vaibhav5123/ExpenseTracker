<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BudgetExceededNotification extends Notification
{
    use Queueable;

    protected $category;
    protected $amount;
    protected $budget;

    public function __construct($category, $amount, $budget)
    {
        $this->category = $category;
        $this->amount = $amount;
        $this->budget = $budget;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Budget Exceeded for ' . $this->category)
            ->line("You've exceeded the budget limit for category: {$this->category}.")
            ->line("Total spent: ₹{$this->amount}")
            ->line("Budget limit: ₹{$this->budget}")
            ->line('Consider adjusting your expenses.');
    }
}

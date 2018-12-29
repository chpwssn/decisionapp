<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DecisionReminder extends Mailable
{
    use Queueable, SerializesModels;
    public $reminder;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\DecisionReminder $reminder)
    {
        $this->reminder = $reminder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('reminders@decisionapp.io')
                    ->subject("Decision Reminder: " . $this->reminder->decision_title)
                    ->text('email.reminder_plain')
                    ->markdown('email.reminder');
    }
}

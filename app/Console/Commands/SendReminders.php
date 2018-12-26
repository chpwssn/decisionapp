<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\DecisionReminder;
use App\Mail\DecisionReminder as DecisionReminderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class SendReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send';

    /**
     * Send all pending reminders.
     *
     * @var string
     */
    protected $description = 'Send all pending reminders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $reminders = DecisionReminder::pending()->get();
        foreach ($reminders as $reminder) {
            Mail::to($reminder->author)->send(new DecisionReminderMail($reminder));
            dd($reminder);
        }
    }
}

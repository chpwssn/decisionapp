<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DecisionReminderController extends Controller
{
    public function skip(\App\DecisionReminder $reminder)
    {
        if(!\Auth::check())
        {
            return back();
        }
        if($reminder->author->sub != \Auth::id())
        {
            return back();
        }
        $reminder->skipped = 1;
        $reminder->save();
        return back();
    }
}

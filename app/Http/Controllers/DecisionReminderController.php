<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DecisionReminder;
use App\User;
use Auth;

class DecisionReminderController extends Controller
{
    public function skip(DecisionReminder $reminder)
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

    public function create(Request $request)
    {
        $author = User::where('sub', Auth::id())->get()[0];
        if ($author == null) return back();
        $newReminder = new DecisionReminder();
        $newReminder->decision_title = $request->get('decisionTitle');
        $newReminder->decision_link = $request->get('decisionLink');
        $newReminder->reminder_date = $request->get('reminderDate');
        $newReminder->author_id = $author->id;
        $newReminder->save();
        return redirect('home');
    }

    public function delete(Request $request)
    {
        $reminder = DecisionReminder::find($request->get('reminderId'));
        $author = User::where('sub', Auth::id())->get()[0];
        if ($author == null) return back();
        if ($reminder == null) return back();
        if ($reminder->author_id != $author->id) return back();
        $reminder->skipped = 1;
        $reminder->save();
        $reminder->delete();
        return redirect('home');
    }

    public function snooze(Request $request, DecisionReminder $reminder)
    {
        $author = User::where('sub', Auth::id())->get()[0];
        if ($author == null) return redirect('home');
        if ($reminder == null) return redirect('home');
        if ($reminder->author_id != $author->id) return redirect('home')->with('error', 'You don\'t own that reminder!');
        $reminder->sent = 0;
        $reminder->reminder_date = \Carbon\Carbon::now()->addDay();
        $reminder->save();
        return redirect('home')->with('status', "Reminder for Decision $reminder->decision_title postponed until " . $reminder->reminder_date->format('d M Y') . "!");
    }
}

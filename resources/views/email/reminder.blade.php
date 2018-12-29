@component('mail::message')
Hello!

I'm writing you to remind you of your decision **{{$reminder->decision_title}}**! Please remember to review the decision in your notebook!

@if($reminder->decision_link)
Your decision document is available at: <a href="{{$reminder->decision_link}}">{{$reminder->decision_link}}</a>
@endif

This reminder has been marked as complete and you will not be notified again, to postpone for one day click the snooze button below.

@component('mail::button', ['url' => "https://decisionapp.io/reminder/{$reminder->id}/snooze"])
Snooze Reminder
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
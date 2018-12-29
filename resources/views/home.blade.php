@extends('layouts.app')

@section('content')
<?php
$user = App\User::where('sub', Auth::user()->sub)->get()[0];
?>
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Create Reminder</div>

                <div class="card-body">
                    <form action="/reminder" method="POST">
                        @csrf
                        @method("POST")
                        <div class="form-group">
                            <label for="decisionTitle">Decision Title</label>
                            <input required type="text" class="form-control" id="decisionTitle" name="decisionTitle" aria-describedby="decisionHelp" placeholder="Deciding the nursery color">
                            <small id="decisionHelp" class="form-text text-muted">This is just a way for you to remember what decision to review when we remind you.</small>
                        </div>
                        <div class="form-group">
                            <label for="decisionLink">Link To Decision Document</label>
                            <input type="text" class="form-control" id="decisionLink" name="decisionLink" placeholder="http://mynodes.example.com/note/50">
                        </div>
                        <div class="form-group">
                            <label for="reminderDate">Reminder Date</label>
                            <input required type="date" class="form-control" id="reminderDate" name="reminderDate" aria-describedby="dateHelp" >
                            <small id="dateHelp" class="form-text text-muted">We will send you a reminder on the specified date to review your decision.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Upcoming Reminders</div>
                <div class="card-body">
                    @if (count($user->upcomingReminders) > 0)
                        <table class="table">
                            <tr>
                                <th>Decision</th>
                                <th>Reminder Date</th>
                                <th></th>
                            </tr>
                            @foreach($user->upcomingReminders()->orderBy('reminder_date')->get() as $reminder)
                                <tr class="reminder">
                                    <td>
                                        @if($reminder->decision_link)
                                            <a href="{{$reminder->decision_link}}"><b>{{$reminder->decision_title}}</b></a>
                                        @else
                                            <b>{{$reminder->decision_title}}</b>
                                        @endif
                                    </td>
                                    <td>
                                        {{$reminder->reminder_date}}
                                    </td>
                                    <td>
                                        <form action="/reminder" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <input type="hidden" name="reminderId" value="{{$reminder->id}}"/>
                                            <button type="submit" class="btn btn-primary">Skip</button>
                                        </form>
                                    </td>
                                </div>
                            @endforeach
                        </table>
                    @else
                        <div style="text-align: center; padding: 16px">
                            <p><i>You haven't created a reminder yet, create one using the "Create Reminder" form.</i></p>
                            <p>Send yourself an example reminder: create a reminder with its date in the past and it will be sent in the next batch. Reminders are checked every five minutes!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @if (count($user->pendingReminders) > 0)
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Pending Reminders</div>
                <div class="card-body">
                    <p>These reminders should have been sent out to you already. If you intentionally set a reminder for the past, the reminder should be sent in the next few minutes.</p>
                    <table class="table">
                        <tr>
                            <th>Decision</th>
                            <th>Reminder Date</th>
                            <th></th>
                        </tr>
                        @foreach($user->pendingReminders()->orderBy('reminder_date', 'DESC')->get() as $reminder)
                            <tr class="reminder">
                                <td>
                                    @if($reminder->decision_link)
                                        <a href="{{$reminder->decision_link}}"><b>{{$reminder->decision_title}}</b></a>
                                    @else
                                        <b>{{$reminder->decision_title}}</b>
                                    @endif
                                </td>
                                <td>
                                    {{$reminder->reminder_date}}
                                </td>
                                <td>
                                    <form action="/reminder" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <input type="hidden" name="reminderId" value="{{$reminder->id}}"/>
                                        <button type="submit" class="btn btn-primary">Skip</button>
                                    </form>
                                </td>
                            </div>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

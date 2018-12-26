@extends('layouts.app')

@section('content')
<?php
$user = App\User::where('sub', Auth::user()->sub)->get()[0];
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    @if ($user->pendingReminders)
                        <h3>Pending Reminders</h3>
                        @foreach($user->pendingReminders as $reminder)
                            <div class="reminder">
                                <b>{{$reminder->decision_title}}</b><br/>{{$reminder->reminder_date}}<br/><a href="/reminder/{{$reminder->id}}/skip">skip</a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

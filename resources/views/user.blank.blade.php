@extends('layouts.app')

@section('content')
<?php
$user = App\User::where('sub', Auth::user()->sub)->get()[0];
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Create Reminder</div>

                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

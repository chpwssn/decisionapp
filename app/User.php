<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\DecisionReminder;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'sub'
    ];

    public function reminders()
    {
        return $this->hasMany(DecisionReminder::class, 'author_id');
    }

    public function upcomingReminders()
    {
        return $this->reminders()->upcoming();
    }

    public function pendingReminders()
    {
        return $this->reminders()->pending();
    }

    public function sentReminders()
    {
        return $this->reminders()->sent();
    }

    public function skippedReminders()
    {
        return $this->reminders()->skipped();
    }
}

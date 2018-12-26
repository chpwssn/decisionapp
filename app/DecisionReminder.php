<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class DecisionReminder extends Model
{
    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    /**
     * Reminders that have not been sent yet. Could be in the past or pending.
     *
     * @return void
     */
    public function scopeUnsent($query)
    {
        return $query->where('sent', 0);
    }


    /**
     * Reminders that have been sent. Could be in the past or pending.
     *
     * @return void
     */
    public function scopeSent($query)
    {
        return $query->where('sent', '!=', 0);
    }

    /**
     * Reminders that have been skipped. Could be in the past or pending.
     *
     * @return void
     */
    public function scopeSkipped($query)
    {
        return $query->where('skipped', '!=', 0);
    }

    /**
     * Reminders that are upcoming have reminder_dates in the future.
     *
     * @param [type] $now
     * @return void
     */
    public function scopeUpcoming($query, $now = null)
    {
        if ($now == null) $now = \Carbon\Carbon::now();
        return $query->where('reminder_date', '>', $now);
    }

    /**
     * Reminders that should be sent at runtime
     *
     * @param [type] $now Carbon object defining the time, if null the current time will be calculated.
     * @return void
     */
    public function scopePending($query, $now = null)
    {
        if ($now == null) $now = \Carbon\Carbon::now();
        return $query->where('reminder_date', '<=', $now)->where('sent', 0)->where('skipped', 0);
    }
}

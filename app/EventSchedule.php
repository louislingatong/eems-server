<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'event_id',
    ];

    /**
     * Get event record associated with the schedule.
     *
     * @return mixed
     */
    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}

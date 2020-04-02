<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'location', 'event_status', 'owner_id'
    ];

    /**
     * Get user record associated with the event.
     *
     * return mixed
     */
    public function owner()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get all participants associated with the event.
     *
     * @return mixed
     */
    public function participants()
    {
        return $this->belongsToMany('App\Employee', 'employee_events')
            ->withPivot('id', 'event_response');
    }

    /**
     * Get all schedules associated with the event.
     *
     * @return mixed
     */
    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }

    /**
     * Get liquidation record associated with the event.
     *
     * @return mixed
     */
    public function liquidation()
    {
        return $this->hasOne('App\Liquidation');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'club_id'
    ];

    /**
     * Get club record associated with the budget.
     *
     * @return mixed
     */
    public function club()
    {
        return $this->belongsTo('App\Club');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Get all members associated with the club.
     *
     * @return mixed
     */
    public function members()
    {
        return $this->belongsToMany('App\Employee', 'club_members');
    }
}

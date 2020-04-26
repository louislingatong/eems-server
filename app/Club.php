<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Club extends Model
{
    use SoftDeletes;

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
        return $this->belongsToMany('App\User', 'club_members');
    }

    /**
     * Get club budget record associated with the club.
     *
     * @return mixed
     */
    public function budget()
    {
        return $this->hasOne('App\ClubBudget');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'department_id'
    ];

    /**
     * Get department record associated with the position.
     *
     * @return mixed
     */
    public function department()
    {
        return $this->belongsTo('App\Department');
    }
}

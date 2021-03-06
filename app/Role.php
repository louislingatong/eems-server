<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get all users associated with the role.
     *
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_roles');
    }
}

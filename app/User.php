<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get all roles associated with the user.
     *
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'user_roles');
    }

    /**
     * Get employee record associated with the user.
     *
     * @return mixed
     */
    public function employee()
    {
        return $this->hasOne('App\Employee');
    }

    /**
     * Get all clubs associated with the user.
     *
     * @return mixed
     */
    public function clubs()
    {
        return $this->belongsToMany('App\Club', 'club_members');
    }

    /**
     * Get all events associated with the user.
     *
     * @return mixed
     */
    public function events()
    {
        return $this->belongsToMany('App\Event', 'event_participants')
            ->withPivot('id', 'event_response');
    }

    /**
     * Get all announcements associated with the user..
     *
     * @return mixed
     */
    public function announcements()
    {
        return $this->belongsToMany('App\Announcement', 'announcement_recipients');
    }
}

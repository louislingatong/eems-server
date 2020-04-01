<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get all roles associated with the user.
     *
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_users');
    }

    /**
     * Authorize roles.
     *
     * @param mixed $roles
     *
     * @return mixed
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles);
        }
        return $this->hasRole($roles);
    }

    /**
     * Check multiple roles.
     *
     * @param array $roles
     *
     * @return mixed
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Check one role.
     *
     * @param string $role
     *
     * @return mixed
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
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
}

<?php

namespace App\Policies;

use App\Position;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PositionPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any positions.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can view the position.
     *
     * @param  User  $user
     * @param  Position  $position
     * @return mixed
     */
    public function view(User $user, Position $position)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can create positions.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can update the position.
     *
     * @param  User  $user
     * @param  Position  $position
     * @return mixed
     */
    public function update(User $user, Position $position)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can delete the position.
     *
     * @param  User  $user
     * @param  Position  $position
     * @return mixed
     */
    public function delete(User $user, Position $position)
    {
        //
    }

    /**
     * Determine whether the user can restore the position.
     *
     * @param  User  $user
     * @param  Position  $position
     * @return mixed
     */
    public function restore(User $user, Position $position)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the position.
     *
     * @param  User  $user
     * @param  Position  $position
     * @return mixed
     */
    public function forceDelete(User $user, Position $position)
    {
        return $user->authorizeRoles('administrator');
    }
}

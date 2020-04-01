<?php

namespace App\Policies;

use App\Club;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClubPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any clubs.
     *
     * @param  User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can view the club.
     *
     * @param  User $user
     * @param  Club $club
     * @return mixed
     */
    public function view(User $user, Club $club)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can create clubs.
     *
     * @param  User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can update the club.
     *
     * @param  User $user
     * @param  Club $club
     * @return mixed
     */
    public function update(User $user, Club $club)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can delete the club.
     *
     * @param  User $user
     * @param  Club $club
     * @return mixed
     */
    public function delete(User $user, Club $club)
    {
        //
    }

    /**
     * Determine whether the user can restore the club.
     *
     * @param  User $user
     * @param  Club $club
     * @return mixed
     */
    public function restore(User $user, Club $club)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the club.
     *
     * @param  User $user
     * @param  Club $club
     * @return mixed
     */
    public function forceDelete(User $user, Club $club)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can add a member/s of the club.
     *
     * @param  User $user
     * @return mixed
     */
    public function addMember(User $user)
    {
        return $user->authorizeRoles('administrator');
    }
}

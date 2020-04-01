<?php

namespace App\Policies;

use App\Announcement;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnouncementPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any announcements.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can view the announcement.
     *
     * @param  User  $user
     * @param  Announcement  $announcement
     * @return mixed
     */
    public function view(User $user, Announcement $announcement)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can create announcements.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can update the announcement.
     *
     * @param  User  $user
     * @param  Announcement  $announcement
     * @return mixed
     */
    public function update(User $user, Announcement $announcement)
    {
        //
    }

    /**
     * Determine whether the user can delete the announcement.
     *
     * @param  User  $user
     * @param  Announcement  $announcement
     * @return mixed
     */
    public function delete(User $user, Announcement $announcement)
    {
        //
    }

    /**
     * Determine whether the user can restore the announcement.
     *
     * @param  User  $user
     * @param  Announcement  $announcement
     * @return mixed
     */
    public function restore(User $user, Announcement $announcement)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the announcement.
     *
     * @param  User  $user
     * @param  Announcement  $announcement
     * @return mixed
     */
    public function forceDelete(User $user, Announcement $announcement)
    {
        //
    }

    /**
     * Determine whether the user can upload can create transient images.
     *
     * @param  User  $user
     * @return mixed
     */
    public function createTransientImage(User $user)
    {
        return $user->authorizeRoles('administrator');
    }
}

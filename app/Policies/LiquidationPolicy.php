<?php

namespace App\Policies;

use App\User;
use App\Liquidation;
use Illuminate\Auth\Access\HandlesAuthorization;

class LiquidationPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any liquidations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can view the liquidation.
     *
     * @param  \App\User  $user
     * @param  \App\Liquidation  $liquidation
     * @return mixed
     */
    public function view(User $user, Liquidation $liquidation)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can create liquidations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can update the liquidation.
     *
     * @param  \App\User  $user
     * @param  \App\Liquidation  $liquidation
     * @return mixed
     */
    public function update(User $user, Liquidation $liquidation)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can delete the liquidation.
     *
     * @param  \App\User  $user
     * @param  \App\Liquidation  $liquidation
     * @return mixed
     */
    public function delete(User $user, Liquidation $liquidation)
    {
        //
    }

    /**
     * Determine whether the user can restore the liquidation.
     *
     * @param  \App\User  $user
     * @param  \App\Liquidation  $liquidation
     * @return mixed
     */
    public function restore(User $user, Liquidation $liquidation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the liquidation.
     *
     * @param  \App\User  $user
     * @param  \App\Liquidation  $liquidation
     * @return mixed
     */
    public function forceDelete(User $user, Liquidation $liquidation)
    {
        //
    }
}

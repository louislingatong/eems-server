<?php

namespace App\Policies;

use App\Budget;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BudgetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any budgets.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can view the budget.
     *
     * @param  \App\User $user
     * @param  \App\Budget $budget
     * @return mixed
     */
    public function view(User $user, Budget $budget)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can create budgets.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can update the budget.
     *
     * @param  \App\User $user
     * @param  \App\Budget $budget
     * @return mixed
     */
    public function update(User $user, Budget $budget)
    {
        return $user->authorizeRoles('administrator');
    }

    /**
     * Determine whether the user can delete the budget.
     *
     * @param  \App\User $user
     * @param  \App\Budget $budget
     * @return mixed
     */
    public function delete(User $user, Budget $budget)
    {
        //
    }

    /**
     * Determine whether the user can restore the budget.
     *
     * @param  \App\User $user
     * @param  \App\Budget $budget
     * @return mixed
     */
    public function restore(User $user, Budget $budget)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the budget.
     *
     * @param  \App\User $user
     * @param  \App\Budget $budget
     * @return mixed
     */
    public function forceDelete(User $user, Budget $budget)
    {
        //
    }
}

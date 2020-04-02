<?php

namespace App\Services;

use App\Budget;

class BudgetService
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Add new budget.
     *
     * @param mixed $data
     *
     * @return Budget
     */
    public function add($data)
    {
        return Budget::create($data);
    }

    /**
     * Edit the given budget.
     *
     * @param mixed $data
     * @param Budget $budget
     *
     * @return Budget
     */
    public function edit($data, $budget)
    {
        $budget->update($data);
        return $budget;
    }
}
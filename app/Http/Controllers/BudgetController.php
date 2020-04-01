<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Http\Requests\CreateBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Http\Resources\BudgetResource;
use App\Services\BudgetService;

class BudgetController extends Controller
{
    protected $budgetService;

    /**
     * Create a new controller instance.
     *
     * @param BudgetService $budgetService
     */
    public function __construct(BudgetService $budgetService)
    {
        $this->budgetService = $budgetService;

        $this->middleware('can:viewAny,App\Budget')->only(['index']);
        $this->middleware('can:create,App\Budget')->only(['store']);
        $this->middleware('can:view,budget')->only(['show']);
        $this->middleware('can:update,budget')->only(['update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return BudgetResource
     */
    public function index()
    {
        return BudgetResource::collection(Budget::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateBudgetRequest $request
     * @return BudgetResource
     */
    public function store(CreateBudgetRequest $request)
    {
        $filteredRequest = $request->only('amount', 'club_id');
        return new BudgetResource($this->budgetService->add($filteredRequest));
    }

    /**
     * Display the specified resource.
     *
     * @param  Budget $budget
     * @return BudgetResource
     */
    public function show(Budget $budget)
    {
        return new BudgetResource($budget);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateBudgetRequest $request
     * @param  Budget $budget
     * @return BudgetResource
     */
    public function update(UpdateBudgetRequest $request, Budget $budget)
    {
        $filteredRequest = $request->only('amount');
        return new BudgetResource($this->budgetService->edit($filteredRequest, $budget));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

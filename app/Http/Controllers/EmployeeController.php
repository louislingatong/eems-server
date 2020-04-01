<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeEventResponseRequest;
use App\Http\Resources\EmployeeResource;
use App\Services\EmployeeService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EmployeeController extends Controller
{
    protected $employeeService;

    /**
     * Create a new controller instance.
     *
     * @param EmployeeService $employeeService
     */
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;

        $this->middleware('can:viewAny,App\Employee')->only(['index']);
        $this->middleware('can:create,App\Employee')->only(['store']);
        $this->middleware('can:view,employee')->only(['show']);
        $this->middleware('can:update,employee')->only(['update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return EmployeeResource::collection(Employee::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateEmployeeRequest $request
     * @return EmployeeResource
     */
    public function store(CreateEmployeeRequest $request)
    {
        $filterRequest = $request->only(['first_name', 'last_name', 'middle_name', 'gender', 'marital_status', 'id_number',
            'employment_type', 'employment_status', 'employment_date', 'regularization_date', 'position_id', 'email']);
        return new EmployeeResource($this->employeeService->add($filterRequest));
    }

    /**
     * Display the specified resource.
     *
     * @param  Employee $employee
     * @return EmployeeResource
     */
    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateEmployeeRequest $request
     * @param  Employee $employee
     * @return EmployeeResource
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $filterRequest = $request->only(['first_name', 'last_name', 'middle_name', 'gender', 'marital_status', 'id_number',
            'employment_type', 'employment_status', 'employment_date', 'regularization_date', 'position_id']);
        return new EmployeeResource($this->employeeService->edit($filterRequest, $employee));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Employee $employee
     * @throws
     */
    public function destroy(Employee $employee)
    {
        //
    }
}

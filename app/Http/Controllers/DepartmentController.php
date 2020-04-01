<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\CreateUpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Services\DepartmentService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DepartmentController extends Controller
{
    protected $departmentService;

    /**
     * Create a new controller instance.
     *
     * @param DepartmentService $departmentService
     */
    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;

        $this->middleware('can:viewAny,App\Department')->only(['index']);
        $this->middleware('can:create,App\Department')->only(['store']);
        $this->middleware('can:view,department')->only(['show']);
        $this->middleware('can:update,department')->only(['update']);
        $this->middleware('can:forceDelete,department')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return DepartmentResource::collection(Department::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUpdateDepartmentRequest $request
     * @return DepartmentResource
     */
    public function store(CreateUpdateDepartmentRequest $request)
    {
        $filteredRequest = $request->only('name', 'description');
        return new DepartmentResource($this->departmentService->add($filteredRequest));
    }

    /**
     * Display the specified resource.
     *
     * @param  Department $department
     * @return DepartmentResource
     */
    public function show(Department $department)
    {
        return new DepartmentResource($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CreateUpdateDepartmentRequest $request
     * @param  Department $department
     * @return DepartmentResource
     */
    public function update(CreateUpdateDepartmentRequest $request, Department $department)
    {
        $filteredRequest = $request->only('name', 'description');
        return new DepartmentResource($this->departmentService->edit($filteredRequest, $department));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Department $department
     * @throws
     */
    public function destroy(Department $department)
    {
        $department->delete();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdatePositionRequest;
use App\Http\Resources\PositionResource;
use App\Position;
use App\Services\PositionService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PositionController extends Controller
{
    protected $positionService;

    /**
     * Create a new controller instance.
     *
     * @param PositionService $positionService
     */
    public function __construct(PositionService $positionService)
    {
        $this->positionService = $positionService;

        $this->middleware('can:viewAny,App\Position')->only(['index']);
        $this->middleware('can:create,App\Position')->only(['store']);
        $this->middleware('can:view,position')->only(['show']);
        $this->middleware('can:update,position')->only(['update']);
        $this->middleware('can:forceDelete,position')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return PositionResource::collection(Position::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUpdatePositionRequest $request
     * @return PositionResource
     */
    public function store(CreateUpdatePositionRequest $request)
    {
        $filteredRequest = $request->only('name', 'description', 'department_id');
        return new PositionResource($this->positionService->add($filteredRequest));
    }

    /**
     * Display the specified resource.
     *
     * @param  Position $position
     * @return PositionResource
     */
    public function show(Position $position)
    {
        return new PositionResource($position);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CreateUpdatePositionRequest $request
     * @param  Position $position
     * @return PositionResource
     */
    public function update(CreateUpdatePositionRequest $request, Position $position)
    {
        $filteredRequest = $request->only('name', 'description', 'department_id');
        return new PositionResource($this->positionService->edit($filteredRequest, $position));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Position $position
     * @throws
     */
    public function destroy(Position $position)
    {
        $position->delete();
    }
}

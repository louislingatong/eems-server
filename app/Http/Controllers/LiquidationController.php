<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLiquidationRequest;
use App\Http\Requests\UpdateLiquidationRequest;
use App\Http\Resources\LiquidationResource;
use App\Liquidation;
use App\Services\LiquidationService;
use Illuminate\Http\Request;

class LiquidationController extends Controller
{
    protected $liquidationService;

    /**
     * Create a new controller instance.
     *
     * @param LiquidationService $liquidationService
     */
    public function __construct(LiquidationService $liquidationService)
    {
        $this->liquidationService = $liquidationService;

        $this->middleware('can:viewAny,App\Liquidation')->only(['index']);
        $this->middleware('can:view,liquidation')->only(['show']);
        $this->middleware('can:create,App\Liquidation')->only(['store']);
        $this->middleware('can:update,liquidation')->only(['update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LiquidationResource::collection(Liquidation::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLiquidationRequest  $request
     * @return LiquidationResource
     */
    public function store(CreateLiquidationRequest $request)
    {
        $filteredRequest = $request->only('expenses', 'event_id');
        return new LiquidationResource($this->liquidationService->add($filteredRequest));
    }

    /**
     * Display the specified resource.
     *
     * @param  Liquidation $liquidation
     * @return LiquidationResource
     */
    public function show(Liquidation $liquidation)
    {
        return new LiquidationResource($liquidation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateLiquidationRequest  $request
     * @param  Liquidation $liquidation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLiquidationRequest $request, Liquidation $liquidation)
    {
        $filteredRequest = $request->only('expenses');
        return new LiquidationResource($this->liquidationService->edit($filteredRequest, $liquidation));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

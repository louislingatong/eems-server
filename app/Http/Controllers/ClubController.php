<?php

namespace App\Http\Controllers;

use App\Club;
use App\Http\Requests\AddClubMemberRequest;
use App\Http\Requests\CreateUpdateClubRequest;
use App\Http\Requests\JoinClubRequest;
use App\Http\Resources\ClubResource;
use App\Services\ClubService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClubController extends Controller
{
    protected $clubService;

    /**
     * Create a new controller instance.
     *
     * @param ClubService $clubService
     */
    public function __construct(ClubService $clubService)
    {
        $this->clubService = $clubService;

        $this->middleware('can:viewAny,App\Club')->only(['index']);
        $this->middleware('can:create,App\Club')->only(['store']);
        $this->middleware('can:view,club')->only(['show']);
        $this->middleware('can:update,club')->only(['update']);
        $this->middleware('can:forceDelete,club')->only(['destroy']);
        $this->middleware('can:addMember,club')->only(['addMember']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return ClubResource::collection(Club::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUpdateClubRequest $request
     * @return ClubResource
     */
    public function store(CreateUpdateClubRequest $request)
    {
        $filteredRequest = $request->only('name', 'description');
        return new ClubResource($this->clubService->add($filteredRequest));
    }

    /**
     * Display the specified resource.
     *
     * @param  Club $club
     * @return ClubResource
     */
    public function show(Club $club)
    {
        return new ClubResource($club);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CreateUpdateClubRequest $request
     * @param  Club $club
     * @return ClubResource
     */
    public function update(CreateUpdateClubRequest $request, Club $club)
    {
        $filteredRequest = $request->only('name', 'description');
        return new ClubResource($this->clubService->edit($filteredRequest, $club));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Club $club
     * @throws
     */
    public function destroy(Club $club)
    {
        $club->delete();
    }

    /**
     * Add member/s to the specified resource from storage
     *
     * @param  AddClubMemberRequest $request
     * @param  Club $club
     * @return ClubResource
     */
    public function addMember(AddClubMemberRequest $request, Club $club)
    {
        $filteredRequest = $request->only('employee_ids');
        return $this->clubService->addMember($filteredRequest, $club);
    }
}

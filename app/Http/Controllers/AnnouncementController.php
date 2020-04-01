<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Http\Requests\CreateAnnouncementRequest;
use App\Http\Resources\AnnouncementResource;
use App\Services\AnnouncementService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AnnouncementController extends Controller
{
    protected $announcementService;

    /**
     * Create a new controller instance.
     *
     * @param AnnouncementService $announcementService
     */
    public function __construct(AnnouncementService $announcementService)
    {
        $this->announcementService = $announcementService;

        $this->middleware('can:viewAny,App\Announcement')->only(['index']);
        $this->middleware('can:create,App\Announcement')->only(['store']);
        $this->middleware('can:view,announcement')->only(['show']);
        $this->middleware('can:createTransientImage,App\Announcement')->only(['storeTransientImage']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index()
    {
        return AnnouncementResource::collection(Announcement::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAnnouncementRequest $request
     * @return AnnouncementResource
     */
    public function store(CreateAnnouncementRequest $request)
    {
        $filteredRequest = $request->only('subject', 'body', 'recipients');
        return new AnnouncementResource($this->announcementService->add($filteredRequest));
    }

    /**
     * Display the specified resource.
     *
     * @param  Announcement $announcement
     * @return AnnouncementResource
     */
    public function show(Announcement $announcement)
    {
        return new AnnouncementResource($announcement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  Announcement $announcement
     */
    public function update(Request $request, Announcement $announcement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Announcement $announcement
     */
    public function destroy(Announcement $announcement)
    {
        //
    }

    /**
     * Store the specified resource in storage.
     *
     * @param  CreateAnnouncementRequest $request
     * @return Response
     */
    public function storeTransientImage(CreateAnnouncementRequest $request)
    {
        return $this->announcementService->addTransientImage($request);
    }
}

<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventResponseState;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Services\EventService;

class EventController extends Controller
{
    protected $eventService;

    /**
     * Create a new controller instance.
     *
     * @param EventService $eventService
     */
    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;

        $this->middleware('can:viewAny,App\Event')->only(['index']);
        $this->middleware('can:view,event')->only(['show']);
        $this->middleware('can:create,App\Event')->only(['store']);
        $this->middleware('can:update,event')->only(['update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index()
    {
        return EventResource::collection(Event::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateEventRequest $request
     * @return EventResource
     */
    public function store(CreateEventRequest $request)
    {
        $filteredRequest = $request->only('name', 'description', 'location', 'event_status', 'schedules', 'recipients');
        return new EventResource($this->eventService->add($filteredRequest));
    }

    /**
     * Display the specified resource.
     *
     * @param  Event $event
     * @return EventResource
     */
    public function show(Event $event)
    {
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateEventRequest $request
     * @param  Event $event
     * @return EventResource
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $filteredRequest = $request->only('name', 'description', 'location', 'event_status', 'schedules');
        return new EventResource($this->eventService->edit($filteredRequest, $event));
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

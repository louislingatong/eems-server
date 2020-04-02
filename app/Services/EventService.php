<?php

namespace App\Services;

use App\Employee;
use App\Event;
use App\Schedule;
use App\Mail\EventMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EventService
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Add new event.
     *
     * @param mixed $data
     *
     * @return Event
     * @throws \Exception
     */
    public function add($data)
    {
        DB::beginTransaction();

        try {
            // set event owner to data array
            $data['owner_id'] = Auth::id();
            // create new event
            $event = Event::create($data);
            // create event schedule
            foreach ($data['schedules'] as $key => $value) {
                $value['event_id'] = $event->id;
                Schedule::create($value);
            }
            // check if recipients is array and retrieve employee by email
            if (is_array($data['recipients'])) {
                $employees = Employee::with('user')->get()->whereIn('user.email', $data['recipients']);
            } else {
                $employees = Employee::with('user')->get()->where('user.email', $data['recipients']);
            }
            // attach users as event participants
            $event->participants()->attach($employees);
            // initialize email details
            $details = [
                'name' => $event->name,
                'schedules' => $event->schedules->toArray(),
                'organizer' => $event->owner->name,
                'location' => $event->location,
            ];
            // send event
            Mail::to($data['recipients'])->send(new EventMail($details));

            DB::commit();

            return $event;
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    /**
     * Edit the given event.
     *
     * @param mixed $data
     * @param Event $event
     * @return Event
     * @throws \Exception
     */
    public function edit($data, $event)
    {
        DB::beginTransaction();

        try {
            // delete all schedules
            $event->schedules()->delete();
            // update event
            $event->update($data);
            // create event schedule
            foreach ($data['schedules'] as $key => $value) {
                $value['event_id'] = $event->id;
                Schedule::create($value);
            }
            // initialize email details
            $details = [
                'name' => $event->name,
                'schedules' => $event->schedules->toArray(),
                'organizer' => $event->owner->name,
                'location' => $event->location,
            ];
            // initialize $recipients
            $recipients = $event->participants()->get()
                ->map(function ($participant) {
                    return $participant->user()->first()->email;
                })
                ->toArray();
            // send event
            Mail::to($recipients)->send(new EventMail($details));

            DB::commit();

            return $event;
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }
    }
}
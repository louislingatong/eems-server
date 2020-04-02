<?php

namespace App\Services;

use App\Club;
use App\ClubJoinTicket;
use App\Employee;

class ClubService
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Add new club.
     *
     * @param mixed $data
     * @return Club
     */
    public function add($data)
    {
        return Club::create($data);
    }

    /**
     * Edit the given club.
     *
     * @param mixed $data
     * @param Club $club
     * @return Club
     */
    public function edit($data, $club)
    {
        $club->update($data);
        return $club;
    }

    /**
     * Add member to the given club/s.
     *
     * @param mixed $data
     * @param Club $club
     * @return String
     */
    public function addMember($data, $club)
    {
        // attach employee to the given clubs
        $club->members()->attach($data['employee_ids']);

        return response()->json([
            'message' => 'The employee has been added to the given club successfully.'
        ], 200);
    }

    /**
     * Join to the given club/s.
     *
     * @param mixed $data
     * @return String
     */
    public function joinClub($data)
    {
        // retrieve club join ticket by token
        $clubJoinTicket = ClubJoinTicket::where('token', $data['token'])->first();
        // retrieve employee by email
        $employees = Employee::with('user')->get()->where('user.email', $clubJoinTicket->email)->first();
        // attach club to the employee clubs
        Employee::find($employees->id)->first()->clubs()->attach($data['club_id']);
        // delete club join token
        $clubJoinTicket->delete();

        return response()->json([
            'message' => 'The employee has been added to the given club successfully.'
        ], 200);
    }
}
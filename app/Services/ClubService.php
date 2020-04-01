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
}
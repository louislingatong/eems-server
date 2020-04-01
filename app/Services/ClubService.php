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
}
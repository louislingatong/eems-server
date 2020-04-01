<?php

namespace App\Services;

use App\Position;

class PositionService
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Add new position.
     *
     * @param mixed $data
     *
     * @return Position
     */
    public function add($data)
    {
        return Position::create($data);
    }

    /**
     * Edit the given position.
     *
     * @param mixed $data
     * @param Position $position
     *
     * @return Position
     */
    public function edit($data, $position)
    {
        $position->update($data);
        return $position;
    }
}
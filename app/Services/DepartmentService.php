<?php

namespace App\Services;

use App\Department;

class DepartmentService
{
    protected $departmentRepository;

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Add new department.
     *
     * @param mixed $data
     *
     * @return Department
     */
    public function add($data)
    {
        return Department::create($data);
    }

    /**
     * Edit the given department.
     *
     * @param mixed $data
     * @param Department $department
     *
     * @return Department
     */
    public function edit($data, $department)
    {
        $department->update($data);
        return $department;
    }
}
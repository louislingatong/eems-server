<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = ['BPO', 'ITO'];

        foreach ($departments as $key => $value) {
            $department = new Department;
            $department->name = $value;
            $department->save();
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = array(
            'ITO',
            'BPO Creatives',
            'BPO Accounting',
        );

        foreach ($departments as $key => $value) {
            $department = new Department;
            $department->name = $value;
            $department->save();
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Position;
use App\Department;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ITODepartment = Department::where('name', 'ITO')->first();

        $positions = array(
            'Programmer',
            'Associate Software Engineer',
            'Software Engineer',
            'Senior Software Engineer',
            'Associate System Analyst',
        );

        foreach ($positions as $key => $value) {
            $position = new Position;
            $position->name = $value;
            $position->department_id = $ITODepartment->id;
            $position->save();
        }
    }
}

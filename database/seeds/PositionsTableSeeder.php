<?php

use App\Position;
use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            'Programmer',
            'Associate Software Engineer',
            'Software Engineer',
            'Senior Software Engineer',
            'Project Manager'
        ];

        foreach ($positions as $key => $value) {
            $position = new Position;
            $position->name = $value;
            $position->department_id = 2;
            $position->save();
        }
    }
}

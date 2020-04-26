<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = new Role();
        $adminRole->name = 'administrator';
        $adminRole->save();

        $employeeRole = new Role();
        $employeeRole->name = 'employee';
        $employeeRole->save();
    }
}

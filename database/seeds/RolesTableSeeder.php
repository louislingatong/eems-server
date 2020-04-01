<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
        $role_employee->name = 'Administrator';
        $role_employee->description = 'A Administrator User';
        $role_employee->save();

        $role_manager = new Role();
        $role_manager->name = 'Employee';
        $role_manager->description = 'A Employee User';
        $role_manager->save();
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Employee;
use App\Role;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Employee::class, 20)
            ->create()
            ->each(function ($employee) {
                $employee->user()
                    ->first()
                    ->roles()
                    ->attach(Role::where('name', 'employee')->first());
            });;
    }
}

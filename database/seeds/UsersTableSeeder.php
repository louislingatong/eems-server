<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'administrator')->first();

        $administrator = new User();
        $administrator->name = 'Administrator';
        $administrator->email = 'admin@eems.local';
        $administrator->password = bcrypt('secret');
        $administrator->save();
        $administrator->roles()->attach($adminRole);
    }
}

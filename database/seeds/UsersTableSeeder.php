<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'Administrator')->first();

        $administrator = new User();
        $administrator->name = 'Administrator';
        $administrator->email = 'admin@eems.local';
        $administrator->password = bcrypt('secret');
        $administrator->save();
        $administrator->roles()->attach($role_admin);
    }
}

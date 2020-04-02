<?php

use Illuminate\Database\Seeder;
use App\Club;

class ClubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clubs = [
            'Gamers',
            'Adventure',
            'Performing Arts',
            'Sports',
            'Multimedia'
        ];

        foreach ($clubs as $key => $value) {
            $club = new Club();
            $club->name = $value;
            $club->save();
        }
    }
}

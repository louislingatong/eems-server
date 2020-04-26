<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;
use Carbon\Carbon;
use App\Position;

$factory->define(Employee::class, function (Faker $faker) {
    static $i;
    static $employmentDate;
    static $employmentStatus;
    static $idNumber = 120010;
    static $regularizationDate;
    static $positionId;

    if (!$employmentDate) {
        $i = $faker->numberBetween($min = 1, $max = 5);
        $employmentDate = '2012-06-01';
        $employmentStatus = 'employee';
    } else if ($i === 0) {
        $i = $faker->numberBetween($min = 1, $max = 5);
        $employmentDate = $faker->dateTimeBetween($employmentDate, 'now')->format('Y-m-d');
        $employmentStatus = $faker->randomElement(['employee', 'worker']);
    }
    $i--;

    if ($employmentStatus === 'employee') {
        $employmentType = 'full-time';

        $estimatedRegularizationDate = Carbon::parse($employmentDate)->addMonths(6);

        if ($estimatedRegularizationDate->isPast()) {
            $regularizationDate = $estimatedRegularizationDate;

            $tenure = Carbon::now()->floatDiffInYears($regularizationDate);

            switch (true) {
                case $tenure >= 1 && $tenure < 3:
                    $positionId = Position::where('name', 'Associate Software Engineer')->first()->id;
                    break;
                case $tenure >= 3 && $tenure < 5:
                    $positionId = Position::where('name', 'Software Engineer')->first()->id;
                    break;
                case $tenure >= 5 && $tenure < 7:
                    $positionId = Position::where('name', 'Senior Software Engineer')->first()->id;
                    break;
                case $tenure >= 7 :
                    $positionId = Position::where('name', 'Associate System Analyst')->first()->id;
                    break;
                default:
                    break;
            }
        } else {
            $positionId = Position::where('name', 'Programmer')->first()->id;
        }
    } else {
        $employmentType = $faker->randomElement(['part-time', 'ojt']);
        $regularizationDate = null;
        $positionId = $faker->randomElement(Position::all()->pluck('id'));
    }

    $maritalStatus = $faker->randomElement(['single', 'married']);
    $birthDate = $faker->dateTimeBetween('1988-01-01', '2000-12-31')->format('Y-m-d');
    $gender = $faker->randomElement(['male', 'female']);
    $lastName = $faker->lastName($gender);
    $firstName = $faker->firstName($gender);

    return [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'gender' => $gender,
        'birth_date' => $birthDate,
        'marital_status' => $maritalStatus,
        'employment_date' => $employmentDate,
        'employment_status' => $employmentStatus,
        'employment_type' => $employmentType,
        'id_number' => (string)$idNumber++,
        'regularization_date' => $regularizationDate,
        'position_id' => $positionId,
        'user_id' => factory(App\User::class)->create([
            'name' => $firstName.' '.$lastName,
        ]),
    ];
});

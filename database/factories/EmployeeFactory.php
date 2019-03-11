<?php

use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
    	'department_id' => $faker->randomElement(App\Department::all()->pluck('id')->toArray()),
    	'user_id' => $faker->randomElement(App\User::all()->pluck('id')->toArray()),
    ];
});

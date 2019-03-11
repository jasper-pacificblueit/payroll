<?php

use Faker\Generator as Faker;

$factory->define(App\DateTimeRecord::class, function (Faker $faker) {
    return [
    	'user_id' => $faker->randomElement(App\User::all()->pluck('id')->toArray()),
    	'status' => rand(0, 1),
    	'type' => $faker->randomElement(['regular', 'break', 'ot']),
    ];
});

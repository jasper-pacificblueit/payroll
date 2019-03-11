<?php

use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
    	'user_id' => $faker->randomElement(App\User::all()->pluck('id')->toArray()),
        'fname' => $faker->name,
        'lname' => $faker->name,
        'mname' => $faker->name,
        'birtdate' => now(),
        'age' => rand(1, 79),
        'image' => bcrypt('secret')
    ];
});

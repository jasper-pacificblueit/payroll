<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
    	'user_id' => $faker->randomElement(App\User::all()->pluck('id')->toArray()),
        'phone' => rand(1, 1e10),
        'mobile' => rand(1, 1e10),
        'email' => $faker->randomElement(App\User::all()->pluck('id')->toArray())
    ];
});

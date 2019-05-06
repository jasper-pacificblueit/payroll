<?php

use Faker\Generator as Faker;

$factory->define(App\Positions::class, function (Faker $faker) {
    return [
    		'title' => $faker->jobTitle,
        'description' => $faker->text,
        'state' => (string)rand(0, 3),
    ];
});

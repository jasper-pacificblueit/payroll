<?php

use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {
  
		$last = $faker->unique()->lastName;

    return [
  		'user_id' => $faker->randomElement(App\User::all()->pluck('id')->toArray()),
      'fname' => $faker->unique()->firstName,
      'gender' => $faker->boolean,
      'lname' => $last,
      'mname' => $last,
      'birthdate' => now(),
      'age' => rand(1, 79),
      'image' => json_encode([
            'data' => "/img/landing/avatar_anonymous.png",
            'path' => "/img/landing/avatar_anonymous.png",
       ]),
    ];
});

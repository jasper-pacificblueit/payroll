<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    $user = $faker->unique()->userName;

    return [
    		'user' => strtolower($user),
    		'position' => $faker->randomElement(['hr', 'employee']),
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(strtolower($user)),
    ];
});

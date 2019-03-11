<?php

use Faker\Generator as Faker;

$factory->define(App\Department::class, function (Faker $faker) {
    return [
    	'company_id' => $faker->randomElement(App\Company::all()->pluck('id')->toArray()),
        'name' => $faker->company
    ];
});

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		$this->call(UsersTableSeeder::class);

   	factory(App\Company::class, 1)->create()->each(function($company) {

   		$company->departments()->saveMany(factory(App\Department::class, 5)->make());

   	});


    }
}

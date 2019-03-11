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

//    	factory(App\Company::class, 1)->create()->each(function($company) {
//
//    		$company->departments()->saveMany(factory(App\Department::class, 5)->make());
//
//    	});
//
//    	factory(App\User::class, 10)->create()->each(function($user) {
//
//    		$user->profile()->save(factory(App\Profile::class)->make());
//    		$user->contacts()->saveMany(factory(App\Contact::class, 5)->make());
//    		$user->employee()->save(factory(App\Employee::class)->make());
//
//    	});


    }
}

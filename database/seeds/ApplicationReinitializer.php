<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationReinitializer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::raw("drop database " . env("DB_DATABASE"));
		DB::raw("create database " . env("DB_DATABASE"));
        DB::raw("use " . env("DB_DATABASE"));
		DB::raw("create table companies (id int auto_increment, primary key(id))");

		$this->command->call("migrate:fresh");
        $this->call(Permission::class);

		// ----------------------------------------------------------------------------------
        $info = [

            'user' => 'admin',
            'password' => bcrypt('admin'),
            'email' => 'admin@example.com',

            'gender' => 1,
            'fname' => 'Admin',
            'lname' => 'Admin',
            'mname' => 'Admin',
            'age' => 99,
            'image' => [
                'data' => '/img/landing/avatar_anonymous.png',
                'path' => '/img/landing/avatar_anonymous.png',
            ],
            'birthdate' => '2019-06-15',

            'mobile' => '',
            'address' => '',

            // positions
            'title' => 'Administrator',
            'state' => 2,
            'lim' => 1,
            'description' => '',

        ];
        // ------------------------------------------------------------------------------------
        UsersTableSeeder::create((object)$info);
    }
}

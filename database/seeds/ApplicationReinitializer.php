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
        DB::raw("drop database payroll");
		DB::raw("create database payroll");
        DB::raw("use payroll");
		DB::raw("create table companies (id int auto_increment, primary key(id))");

		$this->command->call("migrate:fresh");
        $this->call(Permission::class);

		// ----------------------------------------------------------------------------------
        $info = [

            'user' => 'admin',
            'password' => bcrypt('admin'),
            'email' => 'admin@example.com',

            'gender' => 1,
            'fname' => 'Ching',
            'lname' => 'Chong',
            'mname' => 'Chang',
            'age' => 99,
            'image' => [
                'data' => '/img/landing/avatar_anonymous.png',
                'path' => '/img/landing/avatar_anonymous.png',
            ],
            'birthdate' => '1999-07-26',

            'mobile' => '09182639024',
            'address' => 'San Rafael St., Sto. Domingo, Albay',

            // positions
            'title' => 'Administrator',
            'state' => 2,
            'lim' => 1,
            'description' => 'Controls the entire company',

        ];
        // ------------------------------------------------------------------------------------
        UsersTableSeeder::create((object)$info);
    }
}

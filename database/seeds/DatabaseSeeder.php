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
        if ($this->command->confirm('Do you want to migrate:refresh? [y/N]'))
            $this->command->call('migrate:refresh');

        $this->command->info('Creating admin account...');

        $info = [

            'user' => 'admin',
            'password' => bcrypt('admin'),
            'email' => 'admin@example.com',
            'position' => '',

            'fname' => '',
            'lname' => '',
            'mname' => '',
            'age' => 99,
            'image' => '',
            'birthdate' => new DateTime(),

            'phone' => '',
            'mobile' => '',
            'email' => '',
            'address' => '',

        ];

        UsersTableSeeder::createAdmin((object)$info);

        $this->command->info('Creating default company and departments...');

        $address = $this->command->ask('Enter company address');
        $name = $this->command->ask('Enter default company');
        $depList = $this->command->ask('Enter departments (comma separated [i.e. Dep1, Dep2])');

        $departments = explode(',', $depList);

        UsersTableSeeder::default((object)['name' => $name, 'address' => $address], $departments);
    }
}

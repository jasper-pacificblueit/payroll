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

        $this->call(Permission::class);
        $this->call(Role::class);
        $this->command->info('Added default roles & permissions.');

        $this->command->info('Creating admin account...');

        // admin info
        $info = [

            'user' => 'admin',
            'password' => bcrypt('admin'),
            'email' => 'admin@example.com',
            'position' => 'admin',

            'gender' => 1,
            'fname' => 'Rom',
            'lname' => 'Villanueva',
            'mname' => 'Vales',
            'age' => 19,
            'image' => 'https://res.cloudinary.com/teepublic/image/private/s--1Sd8Sjas--/t_Preview/b_rgb:191919,c_limit,f_jpg,h_630,q_90,w_630/v1512484579/production/designs/2143028_1.jpg',
            'birthdate' => '1999-07-26',

            'phone' => '09182639024',
            'mobile' => '09182639024',
            'email' => 'romdevmod@gmail.com',
            'address' => 'San Rafael St., Sto. Domingo, Albay',

        ];

        UsersTableSeeder::create((object)$info);

        $this->command->info('Creating default company and departments...');

        $address = $this->command->ask('Enter company address');
        $name = $this->command->ask('Enter default company');
        $depList = $this->command->ask('Enter departments (comma separated [i.e. Dep1, Dep2])');

        $departments = explode(',', $depList);

        UsersTableSeeder::default((object)['name' => $name, 'address' => $address], $departments);
    }
}

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
        
        $this->command->info('Added default roles & permissions.');
        $this->command->info('Creating admin account...');

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
            'lim' => 2,
            'description' => 'Controls the entire company',

        ];
        // ------------------------------------------------------------------------------------

        UsersTableSeeder::create((object)$info);

        if (!$this->command->confirm('Use DatabaseSeeder::default to create default company and departments? ')) {
            $this->command->info('Creating default company and departments...');

            $address = $this->command->ask('Enter company address');
            $name = $this->command->ask('Enter default company');
            $depList = $this->command->ask('Enter departments (comma separated [i.e. Dep1, Dep2])');

            $departments = explode(',', $depList);

            UsersTableSeeder::default((object)['name' => $name, 'address' => $address], $departments);
        } else
            if ($this->command->confirm('Do you want to continue? '))
                self::default();

    }

    public static function employees() {
        return [
            (object)[
                'users' => [
                    'user' => 'jasper',
                    'position_id' => 4,
                    'email' => 'example@example1.com',
                    'password' => bcrypt('jasper')
                ],
                'contacts' => [
                    'mobile' => '',
                    'address' => '',
                    'email' => 'example@example1.com',
                ],
                'profiles' => [
                    'gender' => 1,
                    'fname' => 'Jasper',
                    'lname' => 'Garcera',
                    'mname' => '',
                    'age' => 0,
                    'birthdate' => now(),
                    'image' => json_encode([
                      'data' => "/img/landing/avatar_anonymous.png",
                      'path' => "/img/landing/avatar_anonymous.png",
                    ]),
                ],
                'employees' => [
                    'company_id' => 1,
                    'department_id' => 2,
                ],

            ],
            (object)[
                'users' => [
                    'user' => 'angie',
                    'position_id' => 4,
                    'email' => 'example@example2.com',
                    'password' => bcrypt('angie')
                ],
                'contacts' => [
                    'mobile' => '',
                    'address' => '',
                    'email' => 'example@example2.com',
                ],
                'profiles' => [
                    'gender' => 0,
                    'fname' => 'Angelie',
                    'lname' => 'Orosco',
                    'mname' => '',
                    'age' => 0,
                    'birthdate' => now(),
                    'image' => json_encode([
                      'data' => "/img/landing/avatar_anonymous.png",
                      'path' => "/img/landing/avatar_anonymous.png",
                    ]),
                ],
                'employees' => [
                    'company_id' => 1,
                    'department_id' => 2,
                ]

            ],
            (object)[
                'users' => [
                    'user' => 'saturnino',
                    'position_id' => 4,
                    'email' => 'example@example3.com',
                    'password' => bcrypt('saturnino')
                ],
                'contacts' => [
                    'mobile' => '',
                    'address' => '',
                    'email' => 'example@example3.com',
                ],
                'profiles' => [
                    'gender' => 1,
                    'fname' => 'Saturnino',
                    'lname' => 'Adral',
                    'mname' => '',
                    'age' => 0,
                    'birthdate' => now(),
                    'image' => json_encode([
                      'data' => "/img/landing/avatar_anonymous.png",
                      'path' => "/img/landing/avatar_anonymous.png",
                    ]),
                ],
                'employees' => [
                    'company_id' => 1,
                    'department_id' => 2,
                ]

            ]
        ];
    }

    public static function default() {
        $company = (object)[

            'name' => 'Pacific Blue Co. Ltd.',
            'address' => 'Puro, Legazpi City, Albay',

        ];

        $departments = [

            'Pacific Blue Dive Center',
            'Pacific Blue IT',
            'Pacific Blue DLAB',

        ];

        $defaultCompany = new App\Company;

        $defaultCompany->name = $company->name;
        $defaultCompany->address = $company->address;

        $defaultCompany->save();

        foreach($departments as $dep) {

            $defaultDepartment = new App\Department;

            $defaultDepartment->company_id = $defaultCompany->id;
            $defaultDepartment->name = trim($dep);

            $defaultDepartment->save();
        }

    }
}

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
            'image' => [
                'data' => '/img/landing/avatar_anonymous.png',
                'path' => '/img/landing/avatar_anonymous.png',
            ],
            'birthdate' => '1999-07-26',

            'phone' => '09182639024',
            'mobile' => '09182639024',
            'address' => 'San Rafael St., Sto. Domingo, Albay',

        ];

        UsersTableSeeder::create((object)$info);


        if (!$this->command->confirm('Use DatabaseSeeder::default to create default company and departments? ')) {
            $this->command->info('Creating default company and departments...');

            $address = $this->command->ask('Enter company address');
            $name = $this->command->ask('Enter default company');
            $depList = $this->command->ask('Enter departments (comma separated [i.e. Dep1, Dep2])');

            $departments = explode(',', $depList);

            UsersTableSeeder::default((object)['name' => $name, 'address' => $address], $departments);
        } else
            self::default();


        
    }

    public static function default() {

        $company = (object)[

            'name' => 'Pacific Blue Co. Ltd.',
            'address' => 'Puro, Legazpi City, Albay',

        ];

        $departments = [

            'Pacific Blue Dive Center',
            'Pacific Blue IT',
            'Pacific Blue DLAB'

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

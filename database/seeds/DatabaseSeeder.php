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

	   	// factory(App\Company::class, 1)->create()->each(function($company) {
	   	// 	$company->departments()->saveMany(factory(App\Department::class, 5)->make());
	   	// });

        $defaultCompany = new App\Company;

        $defaultCompany->name = 'Pacific Blue';
        $defaultCompany->address = 'Puro, Legazpi City, Albay';

        $defaultCompany->save();

        $departments = ['Pacific Blue IT', 'Pacific Blue DLAB'];

        foreach($departments as $dep) {

            $defaultDepartment = new App\Department;

            $defaultDepartment->company_id = $defaultCompany->id;
            $defaultDepartment->name = $dep;

            $defaultDepartment->save();
        }

    }
}

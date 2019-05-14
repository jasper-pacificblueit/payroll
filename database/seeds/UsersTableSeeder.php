<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class UsersTableSeeder extends Seeder
{
    protected static function dummy() {

        factory(App\Positions::class, 4)->create();

        // random employee
        factory(App\User::class, 10)->create()->each(function ($user) {
            $faker = Faker\Factory::create();
            
            // profile
            $user->profile()->save(new App\Profile([
                'user_id' => $user->id,
                'fname' => $faker->unique()->firstName,
                'gender' => $faker->boolean,
                'lname' => $faker->unique()->lastName,
                'mname' => $faker->unique()->lastName,
                'birthdate' => now(),
                'age' => rand(1, 40),
                'image' => json_encode([
                      'data' => "/img/landing/avatar_anonymous.png",
                      'path' => "/img/landing/avatar_anonymous.png",
                ]),
            ]));

            // contact
            $user->contacts()->save(new App\Contact([
                'address' => $faker->address,
                'user_id' => $user->id,
                'mobile' => rand(1, 1e10),
                'email' => $user->email,
            ]));

            // user's employee detail
            $user->employee()->save(new App\Employee([
                'user_id' => $user->id,
                'company_id' => 1,
                'department_id' => 
                    $faker->randomElement(App\Department::find(1)->pluck('id')->toArray()),
            ]));

            // rates
            $user->employee->rates()->save(new App\Rate([
                'employee_id' => $user->employee->id,
                'hourly' => 50.5,

                'holiday' => 50.5,
                'overtime' => 45.7,
                'nightdiff' => 40.6,
            ]));

            // deductions
            $user->employee->deductions()->save(new App\Deduction([
                'deductions' => json_encode([
                    'statutory' => [
                        'sss' => 120.5,
                        'pagibig' => 99.4,
                        'philhealth' => 54.4,
                    ],
                ]),
            ]));

            // settings
            $user->settings()->save(new App\Settings([
                'user_id' => $user->id,
                'settings' => json_encode([

                    'skin' => '',

                ]),
            ]));
        });

        // static employees
        foreach(DatabaseSeeder::employees() as $em) {

            $user = new App\User($em->users);

            $user->save();

            $em->employees["user_id"] = $user->id;
            $em->profiles["user_id"] = $user->id;
            $em->contacts["user_id"] = $user->id;

            (new App\Employee($em->employees))->save();
            (new App\Profile($em->profiles))->save();
            (new App\Contact($em->contacts))->save();
            (new App\Rate([
                'employee_id' => $user->employee->id,
                'hourly' => 50.5,
                'holiday' => 50.5,
                'overtime' => 45.7,
                'nightdiff' => 40.6,

            ]))->save();

            (new App\Deduction([
                'employee_id' => $user->employee->id,
                'deductions' => json_encode([
                    'statutory' => [
                        'sss' => 120.5,
                        'pagibig' => 99.4,
                        'philhealth' => 45.2,
                    ],
                ]),

            ]))->save();

            (new App\Settings([
                'user_id' => $user->id,
                'settings' => json_encode([

                    'skin' => 'skin-1',

                ]),
            ]));
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::dummy();
    }

    public static function create($userInfo) {
        // Administrator
        (new App\Positions([
            'title' => $userInfo->title,
            'lim' => $userInfo->lim,
            'description' => $userInfo->description,
            'state' => $userInfo->state,
        ]))->save();

        // HR
        (new App\Positions([
            'title' => 'Human Resources Manager',
            'lim' => 10,
            'description' => '',
            'state' => '0',
        ]))->save();

        $user = new App\User;
        $userProfile = new App\Profile;
        $userContact = new App\Contact;

        $user->user = $userInfo->user;
        $user->password = $userInfo->password;
        $user->position_id = 1;
        $user->email = $userInfo->email;
        $user->save();

        $userProfile->gender = $userInfo->gender;
        $userProfile->fname = $userInfo->fname;
        $userProfile->lname = $userInfo->lname;
        $userProfile->mname = $userInfo->mname;
        $userProfile->age = $userInfo->age;
        $userProfile->image = json_encode($userInfo->image);
        $userProfile->birthdate = (new Carbon($userInfo->birthdate))->toDateTimeString();
        $userProfile->user_id = $user->id;
        $userProfile->save();

        $userContact->mobile = $userInfo->mobile;
        $userContact->email = $user->email;
        $userContact->address = $userInfo->address;
        $userContact->user_id = $user->id;
        $userContact->save();

        $user->settings()->save(new App\Settings([
            'user_id' => $user->id,
            'settings' => json_encode([
                'skin' => '',
            ]),
        ]));

        // set permissions for admin
        $user->syncPermissions(Permission::getPerm());

    }

    public static function default($company, $departments) {

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

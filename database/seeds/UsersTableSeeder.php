<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    }

    public static function create($userInfo) {

        $user = new App\User;
        $userProfile = new App\Profile;
        $userContact = new App\Contact;

        $user->user = $userInfo->user;
        $user->password = $userInfo->password;
        $user->email = $userInfo->email;
        $user->position = $userInfo->position;

        $user->save();

        $userProfile->gender = $userInfo->gender;
        $userProfile->fname = $userInfo->fname;
        $userProfile->lname = $userInfo->lname;
        $userProfile->mname = $userInfo->mname;
        $userProfile->age = $userInfo->age;
        $userProfile->image = $userInfo->image;
        $userProfile->birthdate = (new Carbon($userInfo->birthdate))->toDateTimeString();

        $userProfile->user_id = $user->id;
        $userProfile->email = $user->email;

        $userProfile->save();

        $userContact->phone = $userInfo->phone;
        $userContact->mobile = $userInfo->mobile;
        $userContact->email = $user->email;
        $userContact->address = $userInfo->address;
        $userContact->user_id = $user->id;

        $userContact->save();

        $user->assignRole($user->position);

        if ($user->position == 'admin') {
            $user->syncPermissions(Permission::getPerm());
        } else
            $user->syncPermissions([
                'company_read',
                'employee_read', 'employee_write',
                'department_read', 'department_write',
            ]);
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

<?php

use Illuminate\Database\Seeder;

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

    public static function createAdmin($adminInfo) {

        $admin = new App\User;
        $adminProfile = new App\Profile;
        $adminContact = new App\Contact;

        $admin->user = $adminInfo->user;
        $admin->password = $adminInfo->password;
        $admin->email = $adminInfo->email;
        $admin->position = $adminInfo->position;

        $admin->save();

        $adminProfile->fname = $adminInfo->fname;
        $adminProfile->lname = $adminInfo->lname;
        $adminProfile->mname = $adminInfo->mname;
        $adminProfile->age = $adminInfo->age;
        $adminProfile->image = $adminInfo->image;
        $adminProfile->birtdate = $adminInfo->birthdate;

        $adminProfile->user_id = $admin->id;
        $adminProfile->email = $admin->email;

        $adminProfile->save();

        $adminContact->phone = $adminInfo->phone;
        $adminContact->mobile = $adminInfo->mobile;
        $adminContact->email = $admin->email;
        $adminContact->address = $adminInfo->address;
        $adminContact->user_id = $admin->id;

        $adminContact->save();

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

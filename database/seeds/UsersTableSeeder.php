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

    public static function create($userInfo) {



        $user = new App\User;
        $userProfile = new App\Profile;
        $userContact = new App\Contact;

        $user->user = $userInfo->user;
        $user->password = $userInfo->password;
        $user->email = $userInfo->email;
        $user->position = $userInfo->position;

        $user->save();

        $userProfile->fname = $userInfo->fname;
        $userProfile->lname = $userInfo->lname;
        $userProfile->mname = $userInfo->mname;
        $userProfile->age = $userInfo->age;
        $userProfile->image = $userInfo->image;
        $userProfile->birtdate = $userInfo->birthdate;

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

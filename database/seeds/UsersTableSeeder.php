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
        // admin
        $admin = new App\User;
        $adminProfile = new App\Profile;
        $adminContact = new App\Contact;

        $admin->user = 'admin';
        $admin->password = bcrypt('admin');
        $admin->email = 'legazpi@pblue.com';
        $admin->position = 'CEO';

        $admin->save();

        $adminProfile->fname = "Si boss";
        $adminProfile->lname = "na";
        $adminProfile->mname = "magaling";
        $adminProfile->age = 99;
        $adminProfile->image = "";
        $adminProfile->birtdate = new DateTime();

        $adminProfile->user_id = $admin->id;
        $adminProfile->email = $admin->email;

        $adminProfile->save();

        $adminContact->phone = "+99999999999";
        $adminContact->mobile = "+99999999999";
        $adminContact->email = $admin->email;
        $adminContact->address = 'Legazpi City';
        $adminContact->user_id = $admin->id;

        $adminContact->save();

    }
}

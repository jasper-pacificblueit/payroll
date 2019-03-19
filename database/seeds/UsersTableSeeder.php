<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userList = array(
            array('Admin', 'admin@gmail.com', 'pacific')
        );

        foreach($userList as $data){
            $user = new User();
            $user->user = $data[0];
            $user->email = $data[1];
            $user->password = bcrypt($data[2]);
            $user->save();
        }
    }
}

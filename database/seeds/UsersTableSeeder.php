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
            array('admin', 'Administrator', 'admin@pblue.com', 'admin')
        );

        foreach($userList as $data){
            $user = new User();
            $user->user  = $data[0];
            $user->position = $data[1];
            $user->email = $data[2];
            $user->password = bcrypt($data[3]);
            $user->save();
        }
    }
}

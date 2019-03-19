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
<<<<<<< HEAD
            $user->user = $data[0];
            $user->email = $data[1];
            $user->password = bcrypt($data[2]);
=======
            $user->user  = $data[0];
            $user->position = $data[1];
            $user->email = $data[2];
            $user->password = bcrypt($data[3]);
>>>>>>> 7cc65b8dce3bd67e0683ddb21daf37a6d7419b21
            $user->save();
        }
    }
}

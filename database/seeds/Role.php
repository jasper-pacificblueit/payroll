<?php

use Illuminate\Database\Seeder;

class Role extends Seeder
{

	public static function roles() {
		return [
			'admin',
			'hr',
			'employee',
		];

		
	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    }
}

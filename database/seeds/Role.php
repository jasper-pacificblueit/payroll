<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

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
    	foreach(self::roles() as $r) {
            $role = Spatie\Permission\Models\Role::create(['name' => $r]);
        }
    }
}

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

            if ($role->name == 'admin') $role->syncPermissions(Permission::all());
            else if ($role->name == 'hr')
                $role->syncPermissions([
                    'company_read',
                    'department_read', 'department_write',
                    'employee_read', 'employee_write',
                    'date_time_record_read', 'date_time_record_write'
                ]);


        }
    }
}

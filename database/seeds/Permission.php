<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

class Permission extends Seeder
{
    public static function getPerm() {
        return [

            'company_read',
            'company_write',

            'department_read',
            'department_write',

            'employee_read',
            'employee_write',

            'date_time_record_read',
            'date_time_record_write',

        ];
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach(self::getPerm() as $perm) Spatie\Permission\Models\Permission::firstOrCreate(['name' => $perm]);

    }

    
}
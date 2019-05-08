<?php

use Illuminate\Database\Seeder;


class Permission extends Seeder
{
    public static function getPerm() {
        return [
            'department_Create',    'company_Create',       'employee_Create',      'position_Create',
            'department_View',      'company_View',         'employee_View',        'position_View',
            'department_Modify',    'company_Modify',       'employee_Modify',      'position_Modify',
            'department_Delete',    'company_Delete',       'employee_Delete',      'position_Delete',
        ];
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::getPerm() as $perm)
            Spatie\Permission\Models\Permission::create(['name' => $perm]);
    }

    
}
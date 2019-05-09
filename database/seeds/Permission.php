<?php

use Illuminate\Database\Seeder;


class Permission extends Seeder
{
    public static function getPerm() {
        return [
            'department_Create',    'company_Create',       'employee_Create',      'position_Create',      'dtr_Create',
            'department_View',      'company_View',         'employee_View',        'position_View',        'dtr_View',
            'department_Modify',    'company_Modify',       'employee_Modify',      'position_Modify',      'dtr_Modify',
            'department_Delete',    'company_Delete',       'employee_Delete',      'position_Delete',      'dtr_Delete',

            'payroll_Create',       'rate_Create',         'schedule_Create',     'deduction_Create',       'earning_Create',
            'payroll_View',         'rate_View',           'schedule_View',       'deduction_View',         'earning_View',
            'payroll_Modify',       'rate_Modify',         'schedule_Modify',     'deduction_Modify',       'earning_Modify',
            'payroll_Delete',       'rate_Delete',         'schedule_Delete',     'deduction_Delete',       'earning_Delete',
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
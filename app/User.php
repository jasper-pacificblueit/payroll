<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    public static function getPerms() {
        return [
            'admin' => [
                'department_Create',    'company_Create',       'employee_Create',      'position_Create',      'dtr_Create',
                'department_View',      'company_View',         'employee_View',        'position_View',        'dtr_View',
                'department_Modify',    'company_Modify',       'employee_Modify',      'position_Modify',      'dtr_Modify',
                'department_Delete',    'company_Delete',       'employee_Delete',      'position_Delete',      'dtr_Delete',

                'payroll_Create',       'rate_Create',         'schedule_Create',     'deduction_Create',       'earning_Create',
                'payroll_View',         'rate_View',           'schedule_View',       'deduction_View',         'earning_View',
                'payroll_Modify',       'rate_Modify',         'schedule_Modify',     'deduction_Modify',       'earning_Modify',
                'payroll_Delete',       'rate_Delete',         'schedule_Delete',     'deduction_Delete',       'earning_Delete'
            ],
            'hr' => [
                'department_Create',           'employee_Create',      'position_Create',      'dtr_Create',
                'department_View',      'company_View',         'employee_View',        'position_View',        'dtr_View',
                'department_Modify',           'employee_Modify',      'position_Modify',      'dtr_Modify',
                'department_Delete',           'employee_Delete',      'position_Delete',      'dtr_Delete',

                'payroll_Create',       'rate_Create',         'schedule_Create',     'deduction_Create',       'earning_Create',
                'payroll_View',         'rate_View',           'schedule_View',       'deduction_View',         'earning_View',
                'payroll_Modify',       'rate_Modify',         'schedule_Modify',     'deduction_Modify',       'earning_Modify',
                'payroll_Delete',       'rate_Delete',         'schedule_Delete',     'deduction_Delete',       'earning_Delete'
            ],
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function position() {
        return Positions::find($this->position_id);
    }

    public function profile() {
        return $this->hasOne('App\Profile');
    }

    public function contacts() {
        return $this->hasMany('App\Contact');
    }

    public function employee() {
        return $this->hasOne('App\Employee');
    }

    public static function online($user) {
        return Cache::has($user);
    }

}

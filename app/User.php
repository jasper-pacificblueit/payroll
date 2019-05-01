<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    public static $positions = [

        'admin' => 'Administrator',
        'hr' => 'HR',
        'employee' => 'Employee'

    ];

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

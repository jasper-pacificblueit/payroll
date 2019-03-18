<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /*
        [HasRoles] This package allows for users to be associated with permissions and roles.

        note that if you need to use HasRoles trait with another model 
        ex.Page you will also need to add protected $guard_name = 'web'; 
        as well to that model or you would get an error
    */
    use Notifiable, HasRoles;

    public $timestamps = false;

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

}

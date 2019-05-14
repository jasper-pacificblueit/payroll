<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $guarded = [];
	protected $table = 'companies';

	public function departments() {
		return $this->hasMany('App\Department');
	}

	public function employees() {
		return $this->hasMany('App\Employee');
	}

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $guarded = [];
	
	public $timestamps = false;

	public function departments() {
		return $this->hasMany('App\Department');
	}

	public function employees() {
		return $this->hasMany('App\Employee');
	}

	// public function addDepartment($name) {
	// 	return name;
	// }
}

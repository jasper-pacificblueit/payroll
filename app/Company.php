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


	public function addDepartment($name){
		return name;
	}
}

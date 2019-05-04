<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	protected $guarded = [];
	
	public function company() {
		return $this->belongsTo('App\Company');
	}

	public function getEmployee() {
		return Employee::where('department_id', $this->id)->get();

	}

	public function dateTimeRecords() {
		return $this->hasMany('App\DateTimeRecord');
	}
}

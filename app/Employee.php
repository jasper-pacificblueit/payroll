<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	public $timestamps = false;
	public function user() {
		return $this->belongsTo('App\User');
	}

  public function getProfile() {
		return $this->hasOne('App\Profile','user_id', 'user_id');
    // return Profile::where('user_id', $this->user_id)->first();
	}
	
	public function getDepartment() {
		return $this->hasOne('App\Department', 'id', 'department_id');
  }

	public function dateTimeRecord() {
		return $this->hasOne('App\DateTimeRecord');
	}

	public function deductions() {
		return $this->hasOne('App\Deduction');
	}

	public function rates() {
		return $this->hasOne('App\Rate' , 'employee_id');
	}

}

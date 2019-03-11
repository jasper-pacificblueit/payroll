<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	public $timestamps = false;
	public function user() {
		return $this->belongsTo('App\User');
	}

	public function dateTimeRecord() {
		return $this->hasMany('App\DateTimeRecord');
	}
}

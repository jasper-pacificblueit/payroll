<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	public $timestamps = false;
	
	public function company() {
		return $this->belongsTo('App\Company');
	}

	public function dateTimeRecords() {
		return $this->hasMany('App\DateTimeRecord');
	}
}

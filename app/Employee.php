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
    return Profile::where('user_id', $this->user_id)->first();
  }

	public function dateTimeRecord() {
		return $this->hasOne('App\DateTimeRecord');
	}
}

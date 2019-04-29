<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DateTimeRecord extends Model
{
    protected $guarded = [];
    public function user() {
    	return $this->belongsTo('App\User');
    }
    public function getProfile() {
	  	return $this->belongsTo('App\Profile','user_id');
    }

    public function getEmployee() {
	  	return $this->belongsTo('App\Employee','user_id');
    }

    public function getRate() {
	  	return $this->belongsTo('App\Rate','user_id');
    }
    

    public function company() {
    	return $this->belongsTo('App\Company');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DateTimeRecord extends Model
{
    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function company() {
    	return $this->belongsTo('App\Company');
    }
}

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

    public static function getTotalHours($start , $end , $user_id) {

        $attendances = DateTimeRecord::where('user_id' , '=' , $user_id)->whereBetween('date', [$start,$end])->get();

        $totalHours = 0;
        foreach ($attendances as $attendance) {
            $totalHours += $attendance->total_hours;
        }
        return $totalHours;
    }

    public static function getTotalDays($start , $end , $user_id) {

        $attendances = DateTimeRecord::where('user_id' , '=' , $user_id)->whereBetween('date', [$start,$end])->get();

        $totalDays = 0;
        foreach ($attendances as $attendance) {
            $totalDays++;
        }
        return $totalDays;
    }
    
}

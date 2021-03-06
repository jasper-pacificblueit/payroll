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
    

    public static function getTotalLate($schedule , $start , $end , $user_id){
        $TotalLate = 0;

        $attendances = DateTimeRecord::where('user_id' , '=' , $user_id)->whereBetween('date', [$start,$end])->get();
        
        foreach ($attendances as $attendance) {
            $in_am = strtotime($attendance->in_am);
            $sched_in_am = strtotime($schedule->in_am);

            if($in_am > $sched_in_am){
                $TotalLate++;
            }
        }

        return $TotalLate;
    }

       

    public static function getOvertime($schedule , $start , $end , $user_id){
        $TotalOvertime = 0;
        $attendances = DateTimeRecord::where('user_id' , '=' , $user_id)->whereBetween('date', [$start,$end])->get();
        $diffArr = array();
        foreach ($attendances as $attendance) {
            $out_pm = strtotime($attendance->out_pm);
            $sched_out_pm = strtotime($schedule->out_pm);
           
         
            if($out_pm > $sched_out_pm){

                $diff = round(abs($out_pm - $sched_out_pm) / 3600, 1);
                if($diff > 1){
                    array_push($diffArr , $diff);
                    $TotalOvertime += $diffArr;
                }
               
                
            }
        }

       return $TotalOvertime;
    }

    public static function getTotalUndertime($start , $end , $user_id){
        $TotalUndertime = 0;
        $attendances = DateTimeRecord::where('user_id' , '=' , $user_id)->whereBetween('date', [$start,$end])->get();
        foreach ($attendances as $attendance) {
            if($attendance->total_hours < 8){
                $undertime = (8 - $attendance->total_hours);
               
                $TotalUndertime+= $undertime;

            }
        }

        return $TotalUndertime;
    }

   

    
}

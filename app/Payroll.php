<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $guarded = [];

    public static function getBasic($rate , $totalhours) {
        
      return $rate * $totalhours;
    }	

    public static function getEarnings($Basic , $Overtime , $Holiday) {
        
      return $Basic;
    }	
    
    public static function NetPay($TotalEarnings , $TotalDeduction) {
        
        return $TotalEarnings - $TotalDeduction;
    }
}

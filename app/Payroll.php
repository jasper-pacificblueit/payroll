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

    public static function CalculateLate($lates , $late_rate){
    
      return $lates * $late_rate;
    }

    public static function getDeductions($DeductionsRates , $Late) {
      $TotalDeductions = 0;
      foreach ($DeductionsRates->statutory as $name => $value) {
        $TotalDeductions+= $value;
      }
      return $TotalDeductions + $Late;
    }
    
    public static function NetPay($TotalEarnings , $TotalDeduction) {
        
        return $TotalEarnings - $TotalDeduction;
    }
}

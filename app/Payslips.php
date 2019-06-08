<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payslips extends Model
{   
     public function getEmployee() {
        return $this->belongsTo('App\Employee' , 'employee_id');
    }
    public function getUser(){
        return $this->belongsTo('App\User' , 'user_id');
    }
   
    
}

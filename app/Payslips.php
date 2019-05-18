<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payslips extends Model
{   
     public function getEmployee() {
        return $this->belongsTo('App\Employee' , 'employee_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function department() {
    	return $this->hasOne("App\Department", "id", "department_id");
    }

    public function count() {
    	return Employee::where("schedule_id", $this->id)->count();
    }

}


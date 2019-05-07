<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    public function count() {
    	return (User::where("position_id", "=", $this->id)->get())->count();
    }
}

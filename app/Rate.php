<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public static function getHourlyRate($id) {
    
        $rate = Rate::where('id', $id)->first();
    
        return $rate->hourly;
    }	

}

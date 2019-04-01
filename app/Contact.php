<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	public $timestamps = false;

	protected $primaryKey = 'user_id';
	
  public function user() {
  	return $this->belongsTo('App\User');
  }
}

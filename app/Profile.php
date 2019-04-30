<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	public $timestamps = false;
	
	protected $primaryKey = 'user_id';
	
  public function user() {
  	return $this->belongsTo('App\User');
  }

  public static function getFullName($id) {
    
    $user = Profile::where('user_id', $id)->first();

  	return sprintf('%s %s', $user->fname, $user->lname);
  }	

}

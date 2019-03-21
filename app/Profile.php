<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	public $timestamps = false;
	
  public function user() {
  	return $this->belongsTo('App\User');
  }

  public static function getFullName($id) {
  	if (User::find($id)['position'] == 'admin') return sprintf('Administrator');
    
    $user = Profile::where('user_id', $id)->first();

  	return sprintf('[%s] %s %s %s', 
      User::$positions[User::find($id)['position']], $user->fname, $user->lname, $user->mname);	
  }	

}

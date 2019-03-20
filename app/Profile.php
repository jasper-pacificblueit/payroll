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
  	if (User::find($id)['position'] == 'admin') sprintf('Administrator');
    
    $user = Profile::where('user_id', $id)->first();

  	return sprintf('%s %s %s', $user->fname, $user->lname, $user->mname);	
  }	

}

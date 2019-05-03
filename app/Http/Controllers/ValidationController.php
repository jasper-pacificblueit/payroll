<?php

namespace App\Http\Controllers;


use App\User;
use App\Employee;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function index() {
    	$json = json_decode(request()->getContent(), 1);

    	switch (key($json)) {
    	case 'email':
    		if (User::where('email', '=', $json['email'])->exists()) return json_encode(['error' => 1]);
    		break;
    	case 'user':
    		if (User::where('user', '=', $json['user'])->exists()) return json_encode(['error' => 1]);
    		break;
    	case 'bio':
    		if (Employee::where('bio_id', '=', $json['bio'])->exists()) return json_encode(['error' => 1]);
    		break;
    	}

    	return json_encode(['error' => 0]);
    }
}

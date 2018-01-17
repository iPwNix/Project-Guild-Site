<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;

class UserlistController extends Controller
{
    public function index()
    {
     if (Auth::check())
 		{
 			if(Auth::user()->siteRole !== "1" && Auth::user()->siteRole !== "8" && Auth::user()->siteRole !== "9")
 			{
 				$allUsers = User::select('id', 'username', 'useravatar')->paginate(10);
    	    	return view("userlist/userlist", array("allUsers" => $allUsers));
 			}else{
 				return redirect('/home');
 			}
	
    	}else{
    		return redirect('/login');
    	}

    }
}

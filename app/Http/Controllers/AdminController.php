<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Roles;
use Auth;


class AdminController extends Controller
{
	/****
	Check of de user wel Admin/Officer/Leader is 
	****/
	public function index()
	{
	  if (Auth::check())
 		{
 			if(Auth::user()->siteRole == "5" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "7")
 			{
 				return view("adminpanel/index", array());
 			}
 			else{
 				return redirect('/home');
 			}
		}else{
			return redirect('/login');
		}
}

	/****
	Lists alle geregistreerde users
	****/
    public function userList()
    {
     if (Auth::check())
 		{
 			if(Auth::user()->siteRole == "5" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "7")
 			{
 				$allUsers = User::select('id', 'username', 'useravatar')->paginate(10);
    	    	return view("adminpanel/userlist", array("allUsers" => $allUsers));
 			}else{
 				return redirect('/home');
 			}
	
    	}else{
    		return redirect('/login');
    	}

    }

	/****
	Haalt alle ranks uit de database en stuurt ze naar de view
	****/
    public function changeUserRank($userID){
	  if (Auth::check())
 		{
 			if(Auth::user()->siteRole == "5" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "7")
 			{
 				$userToChange = User::find($userID);
 				$allRanks = Roles::all();
		    	return view("adminpanel/changerank" ,array("userToChange" => $userToChange,
		    				"allRanks" => $allRanks));
 			}else{
 				return redirect('/home');
 			}
 		}else{
 			return redirect('/login');
 		}
    }

	/****
	Haalt de user op die gebanned moet worden en stuurt hem mee naar de view
	****/
    public function banUser($userID){
	  if (Auth::check())
 		{
 			if(Auth::user()->siteRole == "5" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "7")
 			{
		    	$userToBan = User::find($userID);
		    	return view("adminpanel/banuser" ,array("userToBan" => $userToBan));
 			}else{
				return redirect('/home');
 			}
 		}else{
 			return redirect('/login');
 		}
    }

	/****
	Haalt de user op die geunbanned moet worden en stuurt hem mee naar de view
	****/
	public function unbanUser($userID){
		if (Auth::check())
 		{
 			if(Auth::user()->siteRole == "5" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "7")
 			{
	 			$userToUnban = User::find($userID);
	    		return view("adminpanel/unbanuser" ,array("userToUnban" => $userToUnban));
 			}else{
 				return redirect('/home');
 			}
 		}else{
 			return redirect('/login');
 		}
	}
	/****
	Haalt de user op waarvan de rank gechanged moet worden en veranderd het naar de value die uit de request komt en slaat deze op in de database.
	****/
	public function changingUserRank($id, Request $request){
		$userToChange = User::find($id);

	    $userToChange->siteRole = $request->rank;
	    $userToChange->save();

	    return redirect()->route('showProfile', ['id' => $id]);
	}

	/****
	Haalt de user op die gebanned moet worden en veranderd zijn siteRole naar 9 (Banned) en slaat het op in de database
	****/
	public function baningUser($id, Request $request){
		$userToChange = User::find($id);

	    $userToChange->siteRole = 9;
	    $userToChange->save();

	    return redirect()->route('showProfile', ['id' => $id]);
	}

	/****
	Haalt de user op die geunbanned moet worden en zet zijn rank naar 2 (Trial) en slaat het op in de database
	****/
	public function unbaningUser($id, Request $request){
		$userToChange = User::find($id);

	    $userToChange->siteRole = 2;
	    $userToChange->save();

	    return redirect()->route('showProfile', ['id' => $id]);
	}

}

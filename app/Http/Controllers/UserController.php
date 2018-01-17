<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

use App\Http\Requests;
use File;
use Auth;
use Image;
use DB;
use App\User;
use App\Roles;
use App\Guildranks;
use App\Maincharacters;
use App\Classes;
use App\Classspecs;
use App\Classroles;
use App\Characterraces;
use App\Userprofiles;
use App\Characters;

// require_once (url('/').'/vendor/logansua/blizzard-api-client/src/BlizzardClient.php');

class UserController extends Controller
{

	/****
	Een gebruiker gaat naar een profile pagina
	De informatie van het mee gegeven profileid word opgehaald
	Er word gecontroleerd of er een mainCharacter aan de user staat gekoppeld
	Zo nee word er niets gedaan met de Blizzard API en word mainCharacter naar Null gezet

	Als er wel een mainCharacter aan de user gekoppelt staat word de MainCharacter naam naar de Blizzard API gestuurt en gecontroleerd of hij wel op silvermoon bestaat en wat voor class, level en race het character is.

	Hetzelfde word gedaan met alle alt characters die de user mischien wel geadd heeft, met behulp van een loop.
	****/

	public function showProfile($id)
	{
		if (Auth::check()) 
		    {
			try
			 {
		            $user = User::findOrFail($id);
			    $siteRole = Roles::findOrFail($user->siteRole);
	    		    $guildRank = Guildranks::findOrFail($user->guildRank);
	    		    $profileInfo = Userprofiles::find($user->usersProfile);

	    		    $menuSiteRole = Roles::findOrFail(Auth::user()->siteRole);
	    		    $menuGuildRank = Guildranks::findOrFail(Auth::user()->guildRank);

	    		    $characterRaces = Characterraces::all();

	    		    $mainCharacter = Maincharacters::find($user->mainCharacter);

	    		    if($mainCharacter === NULL){
	    		    	return view("profiles/profile", array('user' => $user, 'siteRole' => $siteRole, 
										       'guildRank' => $guildRank, 
										       'menuSiteRole' => $menuSiteRole, 
										       'menuGuildRank' => $menuGuildRank, 
										       'mainCharacter' => $mainCharacter, 
										       'wowAPIArray' => NULL, 
										       'characterRace' => NULL,
										       'profileInfo' => $profileInfo, 
										       'allCharacters' => NULL,
										       'mainCharNotFound' => NULL, 
										       'altsNameArray' => NULL));
	    		    }
	    		    else
	    		    {
	    		    	$mainCharNotFound = NULL;
	    		    	$altCharNotFound = 0;
		    		    $mainCharacterName = $mainCharacter->charactername;

		    		    try{
			    		    $client = new \BlizzardApi\BlizzardClient('{Blizzard APIKEY}');
					        $wow = new \BlizzardApi\Service\WorldOfWarcraft($client->setAccessToken('accessToken'));

					        $response = $wow->getCharacter('silvermoon', 
					         	urlencode($mainCharacterName), [
					             'fields' => 'name,realm,class,race,level',
					        ]);
					        $apiResponse = $response->getBody();
					        $responseArray = json_decode($apiResponse, true);

					        $responseRace = $responseArray['race'];
					        $characterRace = Characterraces::findOrFail($responseRace);
		    		    }catch(\GuzzleHttp\Exception\ClientException $e){
		    		    	$mainCharNotFound = "Character Not Found!";
		    		    	$responseArray = NULL;
		    		    	$characterRace = NULL;
						}
				         
				        $characters = Characters::where('userID', '=', $user->id)->get();

				        $length = count($characters);
				        $tempAPIArray = array();
				        $tempRaceArray = array();
				        $altsNameArray = array();

				        for ($i = 0; $i < $length; $i++) {
				        	array_push($altsNameArray, $characters[$i]['charactername']);
							try{
							 	$characterResponse = $wow->getCharacter('silvermoon', 
					         	urlencode($characters[$i]['charactername']), [
					            'fields' => 'name,realm,class,race,level',
						        ]);
						        $apiCharResponse = $characterResponse->getBody();
						        $responseCharArray = json_decode($apiCharResponse, true);
						        array_push($tempAPIArray, $responseCharArray);

						        $responseCharRace = $responseCharArray['race'];
						        $currentCharRace = Characterraces::findOrFail($responseCharRace);
						        array_push($tempRaceArray, $currentCharRace);
							}
							catch(\GuzzleHttp\Exception\ClientException $e){
							    $altCharNotFound++;
							    array_push($tempAPIArray, "Character Not Found");
							    array_push($tempRaceArray, "Race Not Found");
							}//END TRY
						}//END FOR


				    	return view("profiles/profile", array('user' => $user, 'siteRole' => $siteRole, 
				    														   'guildRank' => $guildRank, 
						    												   'menuSiteRole' => $menuSiteRole, 
						    												   'menuGuildRank' => $menuGuildRank, 
						    												   'mainCharacter' => $mainCharacter, 
						    												   'wowAPIArray' => $responseArray,
						    	    										           'characterRace' => $characterRace,
						    												   'profileInfo' => $profileInfo,
						    												   'allCharacters' => $characters,
						    												   'allCharAPIArray' => $tempAPIArray,
						    												   'allCharRaces' => $tempRaceArray,
						    												   'mainCharNotFound' => $mainCharNotFound,
						    												   'altsNameArray' => $altsNameArray));
	    		    }//END ifselse $mainCharacter === NULL 
			    }//END Try
			    catch(ModelNotFoundException $e)
			    {
			    	return view('errors/404');
			    }
			}
			else
			{
				return redirect('/login')->withErrors('Please Login or Register first');
			}//END Auth check

	}

	/****
	Als ingelogde user hetzelfde is als het meegegeve ID of als de ingelogde user siteRole heeft van 5 (GMC aka Guild Officers), 6 (Guild Master) of 7 (Admins)
	****/
	public function editingAvatar($id){
		if (Auth::check())
		{
			if(Auth::user()->id == $id || Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
			{
				if(Auth::user()->siteRole !== "1" && Auth::user()->siteRole !== "8" && Auth::user()->siteRole !== "9"){
				$user = User::findOrFail($id);

				return view('profiles/edit/editprofileavatar', array('user' => $user));
				}else{
					return redirect()->route('showProfile', ['id' => $id]);
				}
			}
			else
			{
				return redirect('/home');
			}
		  }else{
			return redirect('/login')->withErrors('Please Login or Register first');
		  }
	}


	//Request from the post event

	/****
	Krijgt het id en het request met de avatar binnen er word gecontroleerd of er wel een file in het request zit zo niet word er niets gedaan en word de user terug gestuurt naar de profile pagina.
	Zo ja word er een filename aangemaakt met de username + tijd en de Extension.
	Dan word de avatar geresized naar 300x300px en geupload naar de server.
	Als de user zijn oude avatar niet de default avatar is word hij van de server gedelete en de nieuwe avatar naam word opgeslagen in de database
	****/

	public function updateUserAvatar($id, Request $request)
	{
	  if (Auth::check())
	  {
		$findUser = User::find($id);
		//If the requests has a file from the input "avatar"
		if($request->hasFile('avatar'))
		{
			//Sets the file in the $avatar variable
			$avatar = $request->file('avatar');
			//Generates the file name {{ Username + tijd + jpg/png/gif}}
		    $filename = $findUser->username . time() . "." . $avatar->getClientOriginalExtension();
		    //Resizes the image to 300x300 with Image Intervention and save it in 
		    //public/uploads/avatars/{{FILENAME}}
			Image::make($avatar)->fit(300,300)
			->save(public_path("/uploads/avatars/" . $filename ));
			//If the users current avatar is not the default.jpg
			if ($findUser->useravatar != "default.jpg") 
			{
				 //Avatar upload path & current Avatar Name
	             $path = '/uploads/avatars/';
	             $currentAvatarName = $findUser->useravatar;
	             //Combines the $path & $currentAvatar and deletes the file
	             File::Delete(public_path( $path . $currentAvatarName) );
	 
	        }
	        	//Saves the filename (Line 36) to the user in the database.
	           	$user = $findUser;
	    		$user->useravatar = $filename;
	    		$user->save();
		}	
			//Returns the user back to their Profile.
			$siteRole = Roles::findOrFail($findUser->siteRole);
	    	$guildRank = Guildranks::findOrFail($findUser->guildRank);


	    	//https://laravel.com/docs/5.3/responses#redirecting-named-routes
	    	//http://stackoverflow.com/a/30019884
	    	//Takes the named route showProfile and adds the $id so it makes profile/{id}
	    	return redirect()->route('showProfile', ['id' => $id])->with(array('user' => $findUser, 'siteRole' => $siteRole, 'guildRank' => $guildRank));
		}else{
			return redirect('/login')->withErrors('Please Login or Register first');
		}

	}

	/****
	Als ingelogde user hetzelfde is als het meegegeve ID of als de ingelogde user siteRole heeft van 5 (GMC aka Guild Officers), 6 (Guild Master) of 7 (Admins).
	De profile info van het mee gegeven id word opgehaald, als deze NULL is dus niet bestaat word er een voor de user aangemaakt en word de editProfileMain pagina laten zien met de net aangemaakte default info.
	Zo niet word gelijk de editProfileMain laten zien met de user zijn info.
	****/
	public function editProfileMain($id){
	  if (Auth::check())
	 	{
			if(Auth::user()->id == $id || Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
			{
			if(Auth::user()->siteRole !== "1" && Auth::user()->siteRole !== "8" && Auth::user()->siteRole !== "9"){
				$user = User::findOrFail($id);
				$gettingProfileInfo = Userprofiles::find($user->usersProfile);
				//New users dont have a profile yet, so this creates one for them and links it with the user in the database.
				if($gettingProfileInfo === NULL){
					$newProfile = new Userprofiles;
					$newProfile->id = $user->id;
					$newProfile->created_at = Carbon::now();
		    		$newProfile->updated_at = Carbon::now();
		    		$newProfile->save();

		    		$user->usersProfile = $user->id;
		    		$user->save();

		    		$getNewProfile = Userprofiles::find($user->usersProfile);
		    		return view('profiles/edit/editprofilemain', array('user' => $user,
														'profileInfo' => $getNewProfile));
				}else{
					return view('profiles/edit/editprofilemain', array('user' => $user,
														'profileInfo' => $gettingProfileInfo));	
				}
			}else{
				return redirect()->route('showProfile', ['id' => $id]);
			}
		}
		else
		{
			return redirect('/home');
		}
	  }else{
	  	return redirect('/login')->withErrors('Please Login or Register first');
	  }
	}


	/****
	Krijgt het mee gestuurde id en request waar de geupdate data inzit en word opgeslagen in de database.
	Waarna de user geredirect word naar de profile page van de user die geedit is.
	****/
	public function updateProfileMain($id, Request $request){
	  if (Auth::check())
	 	{
	 	if(Auth::user()->id == $id || Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
			{
			$user = User::findOrFail($id);

		    $profileToUpdate = Userprofiles::find($user->usersProfile);
	    	$profileToUpdate->about = $request->about;
	    	$profileToUpdate->motto = $request->motto;
	    	$profileToUpdate->save();

	    	return redirect()->route('showProfile', ['id' => $id]);
	    	}else{
	    		return redirect('/home');
	    	}
		}else{
	  		return redirect('/login')->withErrors('Please Login or Register first');
		}
	}


	/****
	Als ingelogde user hetzelfde is als het meegegeve ID of als de ingelogde user siteRole heeft van 5 (GMC aka Guild Officers), 6 (Guild Master) of 7 (Admins).
	Al de gebruikers characters worden opgehaald Main en geadde Alt characters.
	****/
	public function editProfileCharacters($id){
		if (Auth::check())
	    {
			if(Auth::user()->id == $id || Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
			{
				$user = User::findOrFail($id);
				$characterRaces = Characterraces::all();
				$mainCharacter = Maincharacters::find($user->mainCharacter);
				$altCharacters = Characters::where('userID', '=', $user->id)->get();
				$length = count($altCharacters);
				$altsNameArray = array();

				for ($i = 0; $i < $length; $i++) {
					 array_push($altsNameArray, $altCharacters[$i]['charactername']);
				}

			return view('profiles/edit/editprofilecharacters', array('user' => $user,
										 'mainCharacter' => $mainCharacter,
										 'altCharacters' => $altCharacters,
										 'altsNameArray' => $altsNameArray));
			}
			else
			{
				return redirect('/home');
			}
		}else{
			return redirect('/login')->withErrors('Please Login or Register first');	
		}
	}

	/****
	Als ingelogde user hetzelfde is als het meegegeve ID of als de ingelogde user siteRole heeft van 5 (GMC aka Guild Officers), 6 (Guild Master) of 7 (Admins).
	De function krijgt de userID en mainCharacter id mee waarna $editingMain naar true word gezet en alle info van de mainCharacter word opgehaald
	(Dit was een test om te kijken of het mogelijk was om mainCharacters en AltCharacters te kunnen edite met de zelfde view daar helpt $editingMain mee)
	De edit pagina krijgt $editingMain en alle mainCharacter info mee.
	****/
	public function editMainCharacter($userID, $mainCharacterID){
		if (Auth::check())
		{
			if(Auth::user()->id == $userID || Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
			{
				if(Auth::user()->siteRole == "1" && Auth::user()->siteRole == "8" && Auth::user()->siteRole == "9")
				{
					return redirect('/home');
				}
			$editingMain = true;
			$user = User::findOrFail($userID);
			$mainCharacter = Maincharacters::find($mainCharacterID);
			$allClasses = Classes::select('id', 'className', 'classColor')->get();
			$allSpecs = Classspecs::select()->get();
			$allRoles = Classroles::select('id', 'classRole')->get();

			return view('profiles/edit/editcharacter', array('editingMain' => $editingMain,
									 'user' => $user,
									 'mainCharacter' => $mainCharacter,
									 'allClasses' => $allClasses,
									 'allSpecs' => $allSpecs,
									 'allRoles' => $allRoles));

			}else{
				return redirect('/home');
			}
		}else{
		  return redirect('/login')->withErrors('Please Login or Register first');			
		}
	}


	/****
	Krijgt het id en request binnen met de nieuwe info, waarmee de database word geupdate.
	Waarna de gebruiker terug gestuurt word naar de editCharacters pagina van de gebruiker.
	****/
	public function editingMainCharacter($id, Request $request){
	if (Auth::check())
	   {
	   	if(Auth::user()->id == $id || Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
		{
			$this->validate($request, [
	            'charactername' => 'required',
	            'class' => 'required',
	            'spec' => 'required',
	            'role' => 'required'
	            ]);

		$mainCharacterID = $request->mainCharacterID;

		$mainToUpdate = Maincharacters::find($mainCharacterID);

	    	$mainToUpdate->charactername = $request->charactername;
	    	$mainToUpdate->armoryLink = $request->armoryLink;
	    	$mainToUpdate->classID = $request->class;
	    	$mainToUpdate->classSpecID = $request->spec;
	    	$mainToUpdate->classRoleID = $request->role;

	    	$mainToUpdate->updated_at = Carbon::now();
	    	$mainToUpdate->save();

	    	return redirect()->route('editCharactersHome', ['id' => $id]);

		}else{
			return redirect('/home');
		}
	 }else{
	 	return redirect('/login')->withErrors('Please Login or Register first');
	 }
}

	/****
	Als ingelogde user hetzelfde is als het meegegeve ID of als de ingelogde user siteRole heeft van 5 (GMC aka Guild Officers), 6 (Guild Master) of 7 (Admins).

	De function krijgt de userID mee en alle Classes, Specs en Roles uit de database worden gehaald en naar de pagina gestuurd word.
	****/
	public function addAltCharacter($userID){
	if (Auth::check())
	   {
	   	if(Auth::user()->id == $userID || Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
		{
		$user = User::findOrFail($userID);
		$allClasses = Classes::select('id', 'className', 'classColor')->get();
		$allSpecs = Classspecs::select()->get();
		$allRoles = Classroles::select('id', 'classRole')->get();

		return view('profiles/edit/addcharacter', array('user' => $user,
							        'allClasses' => $allClasses,
							        'allSpecs' => $allSpecs,
							        'allRoles' => $allRoles));
		}else{
			return redirect('/home');
		}
	}else{
		return redirect('/login')->withErrors('Please Login or Register first');
	}
}

	/****
	Function krijgt de userid en data van de request binnen en slaat het op in de database als een nieuwe altCharacter die gekoppelt staat aan de user
	****/
	public function addingAltCharacter($id, Request $request){
	  if (Auth::check())
	   {
	   	if(Auth::user()->id == $id || Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
		{
		   $this->validate($request, [
	            'charactername' => 'required',
	            'class' => 'required',
	            'spec' => 'required',
	            'role' => 'required'
	            ]);

	    	$newAltChar = new Characters;

	    	$newAltChar->charactername = $request->charactername;
	    	$newAltChar->armoryLink = $request->armoryLink;
	    	$newAltChar->classID = $request->class;
	    	$newAltChar->classSpecID = $request->spec;
	    	$newAltChar->classRoleID = $request->role;
	    	$newAltChar->userID = $id;

	    	$newAltChar->created_at = Carbon::now();
	    	$newAltChar->updated_at = Carbon::now();

	    	$newAltChar->save();
	    	return redirect()->route('editCharactersHome', ['id' => $id]);


		}else{
			return redirect('/home');
		}
	}else{
		return redirect('/login')->withErrors('Please Login or Register first');
	}
}

	/****
	Haalt de info van de altCharacter op en stuurt hem naar de view.
	****/
	public function editAltCharacter($userID, $altCharacterID){
		
	if (Auth::check())
	   {
	   	if(Auth::user()->id == $userID || Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
		{

			$editingMain = NULL;
			$user = User::findOrFail($userID);
			$altCharacter = Characters::find($altCharacterID);
			$allClasses = Classes::select('id', 'className', 'classColor')->get();
			$allSpecs = Classspecs::select()->get();
			$allRoles = Classroles::select('id', 'classRole')->get();

			return view('profiles/edit/editcharacter', array('editingMain' => $editingMain,
									 'user' => $user,
									 'altCharacter' => $altCharacter,
									 'allClasses' => $allClasses,
									 'allSpecs' => $allSpecs,
									 'allRoles' => $allRoles));
		}else{
			return redirect('/home');
		}
		}else{
		  return redirect('/login')->withErrors('Please Login or Register first');		
		}
	}

	/****
	Function krijgt de geupdate info van de altCharacer binnen en update het in de database
	****/
	public function editingAltCharacter($id, Request $request){

	if (Auth::check())
	   {
	   	if(Auth::user()->id == $id || Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
		{

		   $this->validate($request, [
	            'charactername' => 'required',
	            'class' => 'required',
	            'spec' => 'required',
	            'role' => 'required'
	            ]);

		    $altCharacterID = $request->altCharacterID;

		    $characterToUpdate = Characters::find($altCharacterID);


	    	$characterToUpdate->charactername = $request->charactername;
	    	$characterToUpdate->armoryLink = $request->armoryLink;
	    	$characterToUpdate->classID = $request->class;
	    	$characterToUpdate->classSpecID = $request->spec;
	    	$characterToUpdate->classRoleID = $request->role;

	    	$characterToUpdate->updated_at = Carbon::now();
	    	$characterToUpdate->save();

	    	return redirect()->route('editCharactersHome', ['id' => $id]);



		}else{
			return redirect('/home');
		}
		}else{
		  return redirect('/login')->withErrors('Please Login or Register first');		
		}	
	}

	/****
	Delete het altCharacter die bij het meegegeve id hoord
	****/
	public function deletingAltCharacter($id, $charid){
		$altCharacter = Characters::findOrFail($charid);
		$altCharacter->delete();

		return redirect()->route('editCharactersHome', ['id' => $id]);
		
		// echo "Deleting: ".$charid."<br>";
		// echo "For: ".$id;
	}


	/****
	Als ingelogde user hetzelfde is als het meegegeve ID of als de ingelogde user siteRole heeft van 5 (GMC aka Guild Officers), 6 (Guild Master) of 7 (Admins).
	****/
	public function editProfileCover($id){
	 if (Auth::check())
	   {
		if(Auth::user()->id == $id || Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
		{
			if(Auth::user()->siteRole !== 1 && Auth::user()->siteRole !== 8 && Auth::user()->siteRole !== 9){
			$user = User::findOrFail($id);

			return view('profiles/edit/editprofilecover', array('user' => $user));
			}else{
				return redirect()->route('showProfile', ['id' => $id]);
			}
		}
		else
		{
			return redirect('/home');
		}
	  }else{
		return redirect('/login')->withErrors('Please Login or Register first');
	  }
	}


	/****
	Krijgt het id en het request met de Cover binnen er word gecontroleerd of er wel een file in het request zit zo niet word er niets gedaan en word de user terug gestuurt naar de profile pagina.
	Zo ja word er een filename aangemaakt met de username + tijd en de Extension.
	Dan word de Cover geresized naar 1920x300px en geupload naar de server.
	Als de user zijn oude Cover niet de default Cover is word hij van de server gedelete en de nieuwe Cover naam word opgeslagen in de database
	****/
	public function updateUserCover($id, Request $request)
	{
		$findUser = User::find($id);
		//If the requests has a file from the input "cover"
		if($request->hasFile('cover'))
		{
			//Sets the file in the $cover variable
			$cover = $request->file('cover');
			//Generates the file name {{ Username + tijd + jpg/png/gif}}
		    $filename = $findUser->username . time() . "." . $cover->getClientOriginalExtension();
		    //Resizes the image to 1920x300 with Image Intervention and save it in 
		    //public/uploads/cover/{{FILENAME}}
			Image::make($cover)->fit(1920,300)
			->save(public_path("/uploads/profilecovers/" . $filename ));
			//If the users current cover is not the defaultCover.jpg
			if ($findUser->usercover != "defaultCover.jpg") 
			{
				 //Cover upload path & current Cover Name
	             $path = '/uploads/profilecovers/';
	             $currentCoverName = $findUser->usercover;
	             //Combines the $path & $currentCoverName and deletes the file
	             File::Delete(public_path( $path . $currentCoverName) );
	 
	        }
	        	//Saves the filename to the user in the database.
	           	$user = $findUser;
	    		$user->usercover = $filename;
	    		$user->save();
	 
		}	
		//Returns the user back to their Profile.
		$siteRole = Roles::findOrFail($findUser->siteRole);
	    $guildRank = Guildranks::findOrFail($findUser->guildRank);


	    //https://laravel.com/docs/5.3/responses#redirecting-named-routes
	    //http://stackoverflow.com/a/30019884
	    //Takes the named route showProfile and adds the $id so it makes profile/{id}
	    return redirect()->route('showProfile', ['id' => $id])->with(array('user' => $findUser, 'siteRole' => $siteRole, 'guildRank' => $guildRank));

	}


}

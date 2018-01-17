<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

use App\Http\Requests;
use App\Applyquestions;
use App\Applications;
use App\Applystat;
use App\User;
use App\Roles;
use App\GuildRanks;
use App\Maincharacters;
use App\Classes;
use App\Classspecs;
use App\Classroles;
use App\Characterraces;
use App\Userprofiles;
use App\Characters;

class ApplyController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    /****
    Check of de user wel Admin/Officer/Leader is en haalt dan alle applications op en laat ze zijn in een lijst
    ****/
    public function index()
    {
    	if(Auth::user()->siteRole == "5" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "7"){
            $allApplications = Applications::orderBy('id', 'DESC')->paginate(10);
    		$allClasses = Classes::select('id', 'className', 'classColor')->get();
    		$allSpecs = Classspecs::select('id', 'spec')->get();
    		$allStatus = Applystat::all();
    		return view("applications/index", array('allApplications' => $allApplications,
    			                                    'allClasses' => $allClasses,
    			                                    'allSpecs' => $allSpecs,
    			                                    'allStatus' => $allStatus));
    	}else{
    		return redirect()->route('home');
    	}
    }

    /****
    Nadat iemand net geregisteerd heeft moet hij een application maken.
    Eerst worde alle applications opgehaald en gecontroleerd of de user al een application heeft gemaakt, zo ja word hij geredirect naar zijn application om deze te bekijken.

    Zo nee worde alle vragen, classes roles en specs opgehaald uit de database en aan de user laten zien
    ****/
    public function creating()
    {
    	$allApplys = Applications::select('idUser','id')->get();

    	   foreach($allApplys as $apply){
    		if($apply->idUser == Auth::user()->id){
    		  return redirect()->route('showApply', ['id' => $apply->id]);
    		}
    	}

    	$allQuestions = Applyquestions::all();
    	$allClasses = Classes::select('id', 'className', 'classColor')->get();
		$allSpecs = Classspecs::select()->get();
		$allRoles = Classroles::select('id', 'classRole')->get();

    	return view("applications/create", array('allQuestions' => $allQuestions,
                                            	 'allClasses' => $allClasses,
                                        		 'allSpecs' => $allSpecs,
                                        		 'allRoles' => $allRoles));
    }

    /****
    Krijgt alle antwoorde op de vragen binnen.
    (Vraag geplaatst op laracast)
    https://laracasts.com/discuss/channels/laravel/special-characters-in-request

    urldecode voor characterName en armoryLink voor characters met speciale letters in hun character naam.
    Bijvoorbeeld Mísato de í veranderd in %C3_ , urldecode veranderd deze terug.

    Er word een nieuwe application aangemaakt met alle antwoorden er in met de status 1 (Pending), 2(Accepted), 3(Declined)

    Het character die mee gegeven is word in de database opgeslagen als mainCharacter en gelinkt aan de user.

    En de user zijn siteRole word naar 1 gezet (Applicant)
    ****/
    public function create(Request $request)
    {
    	$this->validate($request, [
            'Realname' => 'required|max:100',
            'Age' => 'required|max:2',
            'Class' => 'required',
            'Spec' => 'required',
            'CharName' => 'required|max:30',
            'ArmoryLink' => 'max:255',
            'Battletag' => 'required|max:50',
            'Rank' => 'required',
            'RaidDays' => 'required',
            'DaysPlayed' => 'required|max:255',
            'Raidxp' => 'required|min:10',
            'Playtimes' => 'required|max:255',
            'PrevGuilds' => 'required|max:255',
            'ReaLeave' => 'required|max:255',
            'WhyJoin' => 'required|max:255',
            'WhyYou' => 'required|max:255',
            'Vouch' => 'max:255',
            'Hear' => 'required|max:255',
            'Tellus' => 'required|min:10',
            ]);

    	$appStatus = 1;
    	$decodedName = urldecode($request->CharName);
    	$decodedLink = urldecode($request->ArmoryLink);

		$newApply = new Applications;
		$newApply->questionOne = $request->Realname;
		$newApply->questionTwo = $request->Age;
		$newApply->questionThree = $request->Class;
		$newApply->questionFour = $request->Spec;
		$newApply->questionFive = $decodedName;
		$newApply->questionSix = $decodedLink;
		$newApply->questionSeven = $request->Battletag;
		$newApply->questionEight = $request->Rank;
		$newApply->questionNine = $request->RaidDays;
		$newApply->questionTen = $request->DaysPlayed;
		$newApply->questionEleven = $request->Raidxp;
		$newApply->questionTwelve = $request->Playtimes;
		$newApply->questionThirteen = $request->PrevGuilds;
		$newApply->questionFourteen = $request->ReaLeave;
		$newApply->questionFifteen = "warcraftlogs.com";
		$newApply->questionSixteen = $request->WhyJoin;
		$newApply->questionSeventeen = $request->WhyYou;
		$newApply->questionEighteen = $request->Vouch;
		$newApply->questionNineteen = $request->Hear;
		$newApply->questionTwenty = $request->Tellus;
		$newApply->idUser = Auth::user()->id;
		$newApply->status = $appStatus;
		$newApply->created_at = Carbon::now();
		$newApply->updated_at = Carbon::now();
		$newApply->save();

		$classRole = 3;
		//Check of Tank Spec
		$checkTankArray = array(1, 4, 16, 28, 33, 36);
		$checkHealArray = array(6, 13, 14, 21, 29, 34);
		if(in_array($request->Spec, $checkTankArray)){
		    $classRole = 1;
		}
		//Check of Heal Spec
		elseif(in_array($request->Spec, $checkHealArray)){
		$classRole = 2;
		}

		$newChar = new Maincharacters;
		$newChar->charactername = $decodedName;
		$newChar->armoryLink = $decodedLink;
		$newChar->classID = $request->Class;
		$newChar->classSpecID = $request->Spec;
		$newChar->classRoleID = $classRole;
		$newChar->created_at = Carbon::now();
		$newChar->updated_at = Carbon::now();
		$newChar->save();

		$newMainCharID = $newChar->id;

	    $applyingUser = User::findOrFail(Auth::user()->id);
    	$applyingUser->mainCharacter = $newMainCharID;
        $applyingUser->siteRole = 1;
    	$applyingUser->updated_at = Carbon::now();
    	$applyingUser->save();

    	return redirect()->route('home');

    }

    /****
     haalt de application op met de mee gegeven id en laat deze zien.
    ****/
    public function showApply($id)
    {
    	$applyToShow = Applications::findOrFail($id);
        $allQuestions = Applyquestions::all();
    	if($applyToShow->idUser == Auth::user()->id || Auth::user()->siteRole == "5" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "7"){
    		return view("applications/showapply", array("applyToShow" => $applyToShow, "allQuestions" => $allQuestions));
    	}else{
    		if(Auth::user()->siteRole == "1"){
    		  return redirect()->route('applycreate');
    		}else{
			  return redirect()->route('home');
    		}
    		
    	}
    }
    /****
    Als er door een Admin/Officer/Leader op Accept gedrukt word, word de application geaccept moet worden opgehaald.
    ****/
    public function acceptApply($applyID){
     if(Auth::check())
        {
            if(Auth::user()->siteRole == "5" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "7")
            {
               $applyToAccept = Applications::select('id', 'idUser', 'status')->where('id', $applyID)->get();
               $userID = $applyToAccept[0]->idUser;
               $usersName = User::select('id', 'username')->where('id', $userID)->get();

                return view("applications/acceptapply" ,array("applyToAccept" => $applyToAccept,
                     "usersName" => $usersName));
            }else{
                return redirect('/home');
            }
        }else{
            return redirect('/login');
        }
    }
    /****
    Als er door een Admin/Officer/Leader op Decline gedrukt word, word de application gedeclined moet worden opgehaald.
    ****/
    public function declineApply($applyID){
        if(Auth::check())
        {
            if(Auth::user()->siteRole == "5" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "7")
            {
               $applytoDecline = Applications::select('id', 'idUser', 'status')->where('id', $applyID)->get();
               $userID = $applytoDecline[0]->idUser;
               $usersName = User::select('id', 'username')->where('id', $userID)->get();

                return view("applications/declineapply" ,array("applytoDecline" => $applytoDecline,
                     "usersName" => $usersName));
            }else{
                return redirect('/home');
            }
        }else{
            return redirect('/login');
        }
    }

    /****
    Er is op Accept Confirm gedrukt en de Applicant en application zijn status word in de database veranderd naar 2 (Trial) en opgeslagen.
    ****/
    public function acceptingApply($applyID, Request $request){
        $acceptingApply = Applications::select('id', 'idUser', 'status', 'updated_at')->where('id', $applyID)->get();
        $userID = $acceptingApply[0]->idUser;
        $userToPromote = User::select('id', 'siteRole')->where('id', $userID)->get();


        $acceptingApply[0]->status = 2;
        $acceptingApply[0]->updated_at = Carbon::now();
        $acceptingApply[0]->save();
        $userToPromote[0]->siteRole = 2;
        $userToPromote[0]->save();

        return redirect('/applications');
    }

    /****
    Er is op Delcine Confirm gedrukt en de Applicant en application zijn status word in de database veranderd naar 3 (Declined) en opgeslagen.
    ****/
    public function decliningApply($applyID, Request $request){
        $decliningApply = Applications::select('id', 'idUser', 'status', 'updated_at')->where('id', $applyID)->get();
        $userID = $decliningApply[0]->idUser;
        $userToDemote = User::select('id', 'siteRole')->where('id', $userID)->get();


        $decliningApply[0]->status = 3;
        $decliningApply[0]->updated_at = Carbon::now();
        $decliningApply[0]->save();
        $userToDemote[0]->siteRole = 8;
        $userToDemote[0]->save();

        return redirect('/applications');
    }


}

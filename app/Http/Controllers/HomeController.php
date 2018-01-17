<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

use App\User;
use App\Roles;
use App\GuildRanks;
use App\Maincharacters;
use App\Classes;
use App\Classspecs;
use App\Classroles;
use App\Homecarousels;
use App\Newsarticles;
use App\Newscategories;
use App\Applications;
use App\Applystat;

//require_once base_path('vendor\logansua\blizzard-api-client\src\BlizzardClient.php');

class HomeController extends Controller
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
    Checked de user zijn role om te zien wat voor frontpage er weergegeven moet worden, of de user geredirect moet worden naar de application pagina.
    ****/
    public function index()
     {
        if(Auth::user()->siteRole !== "1" && Auth::user()->siteRole !== "8" && Auth::user()->siteRole !== "9")
        {
        $carousels = Homecarousels::all();
        $latestNews = Newsarticles::orderBy("created_at", "desc")->take(6)->get();

            $TheApplication = Applications::where(
                    'idUser', '=', Auth::user()->id)->get();
                $allStatus = Applystat::all();

                $acceptdate = $TheApplication[0]->updated_at;

                $messagedate = Carbon::parse($acceptdate)->addDays(4);

                if(Carbon::now() <= $messagedate){
                    $acceptMsgOne = "Your Application has been accepted!";
                    $acceptMsgTwo = "An Officer will be in contact soon!";
                    return view("home", array("carouselInfo" 
                                              => $carousels,
                                                "latestNews" 
                                              => $latestNews,
                                                "acceptMsgOne"
                                              => $acceptMsgOne,
                                                "acceptMsgTwo"
                                              => $acceptMsgTwo));
                }
                else{
                    return view("home", array("carouselInfo" 
                                            => $carousels,
                                              "latestNews" 
                                            => $latestNews,
                                              "acceptMsg"
                                            => NULL,
                                              "acceptMsgOne"
                                            => NULL,
                                              "acceptMsgTwo"
                                            => NULL
                                            ));
                }//END ifelse messagedate
        }else{
            if(Auth::user()->siteRole == "8")
            {
                $TheApplication = Applications::where(
                    'idUser', '=', Auth::user()->id)->get();
                  if($TheApplication->count() != NULL)
                  {
                    $allStatus = Applystat::all();
                    $counting = $TheApplication->count();
                    return view("home", array("TheApplication" => 
                                $TheApplication,
                                "allStatus" =>
                                 $allStatus,
                                 "counting" => $counting));
                  }else{
                    return redirect("/apply");
                  }

            }
            if(Auth::user()->siteRole == "9")
            {
              return view("errors/banned");
            }
            if(Auth::user()->siteRole == "1")
            {
                $TheApplication = Applications::where(
                    'idUser', '=', Auth::user()->id)->get();
                  if($TheApplication->count() != NULL)
                  {
                    $allStatus = Applystat::all();
                    $counting = $TheApplication->count();
                    return view("home", array("TheApplication" => 
                                $TheApplication,
                                "allStatus" =>
                                 $allStatus,
                                 "counting" => $counting));
                  }else{
                    return redirect("/apply");
                  }
            }
        }

    }
}

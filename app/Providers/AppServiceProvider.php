<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use View;
use Auth;
use App\User;
use App\Roles;
use App\GuildRanks;
use App\Maincharacters;
use App\Classes;
use App\Classspecs;
use App\Classroles;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
  //  // $siteRole = Roles::findOrFail(Auth::user()->siteRole);
  //  // $guildRank = GuildRanks::findOrFail(Auth::user()->guildRank);
  //  // $mainCharacter = Maincharacters::findOrFail(Auth::user()->mainCharacter);
  //  // $characterClass = Classes::findOrFail($mainCharacter['classID']);
  //  // $characterSpec = Classspecs::findOrFail($mainCharacter['classSpecID']);
  //  // $characterRole = Classroles::findOrFail($mainCharacter['classRoleID']);

  //  // View::share('data', array('menuUser' => Auth::user(),
  //  //                         'menuSiteRole' => $siteRole,
  //  //                         'menuGuildRank' => $guildRank,
   // //                         'mainCharacter' => $mainCharacter,
   // //                         'characterClass' => $characterClass,
  //  //                         'characterSpec' => $characterSpec,
   // //                         'characterRole' => $characterRole));

    view()->composer('layouts.app', function($view) {

   // $siteRole = Roles::findOrFail(Auth::user()->siteRole);
   // $guildRank = GuildRanks::findOrFail(Auth::user()->guildRank);
    ////$mainCharacter = Maincharacters::findOrFail(Auth::user()->mainCharacter);
    ////$characterClass = Classes::findOrFail($mainCharacter['classID']);
    ////$characterSpec = Classspecs::findOrFail($mainCharacter['classSpecID']);
    ////$characterRole = Classroles::findOrFail($mainCharacter['classRoleID']);

    // try {
    //   $mainCharacter = Maincharacters::findOrFail(Auth::user()->mainCharacter);
    //   $characterClass = Classes::findOrFail($mainCharacter['classID']);
    //   $characterSpec = Classspecs::findOrFail($mainCharacter['classSpecID']);
    //   $characterRole = Classroles::findOrFail($mainCharacter['classRoleID']);

    //   $view->with('data', array('menuUser' => Auth::user(),
    //                           'menuSiteRole' => $siteRole,
    //                           'menuGuildRank' => $guildRank,
    //                           'mainCharacter' => $mainCharacter,
    //                           'characterClass' => $characterClass,
    //                           'characterSpec' => $characterSpec,
    //                           'characterRole' => $characterRole));

    // } catch (ModelNotFoundException $ex) {
    //     $mainCharacter = NULL;
    //     $characterClass = NULL;
    //     $characterSpec = NULL;
    //     $characterRole = NULL;

    //       $view->with('data', array('menuUser' => Auth::user(),
    //                           'menuSiteRole' => $siteRole,
    //                           'menuGuildRank' => $guildRank,
    //                           'mainCharacter' => $mainCharacter,
    //                           'characterClass' => $characterClass,
    //                           'characterSpec' => $characterSpec,
    //                           'characterRole' => $characterRole));
    // }



    // $view->with('data', array('menuUser' => Auth::user(),
    //                           'menuSiteRole' => $siteRole,
    //                           'menuGuildRank' => $guildRank,
    //                           'mainCharacter' => $mainCharacter,
    //                           'characterClass' => $characterClass,
    //                           'characterSpec' => $characterSpec,
    //                           'characterRole' => $characterRole));
        });

    }//END BOOT

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

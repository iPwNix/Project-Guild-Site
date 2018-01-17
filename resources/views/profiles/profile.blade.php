@extends('layouts.app')

@section('content')
    <!-- wrapper -->
    <div id="wrapper">  
        <section class="hero cover" style="background-image: url('/uploads/profilecovers/{{ $user->usercover }}');">
            <div class="hero-bg"></div>
            <div class="container relative">
                <div class="page-header">
                    <div class="page-title hidden-xs">{{ $user->username }}
            @if($user->id === Auth::user()->id || 
                  Auth::user()->siteRole == "5" ||
                  Auth::user()->siteRole == "6" ||
                  Auth::user()->siteRole == "7")
            @if(Auth::user()->siteRole !== "1" && Auth::user()->siteRole !== "8" && Auth::user()->siteRole !== "9")
                                            <a href="/edit/profile/{{ $user->id }}" class="btn btn-circle btn-editProf" data-toggle="tooltip" title="Edit User">
                                            <i class="fa fa-cog circle-btn-fa-heading"></i>
                                            </a>
                @endif
            @endif
                    </div>
                @if($user->id == Auth::user()->id || Auth::user()->siteRole == "7")
                    <div class="profile-avatar">
                        <div class="thumbnail" data-toggle="tooltip" 
                        title="Change Avatar">
                            <a href="/edit/profile/avatar/{{ $user->id }}">
                                <img src="/uploads/avatars/{{ $user->useravatar }}">
                            </a>
                        </div>
                    </div>
                @else
                <div class="profile-avatar">
                    <div class="thumbnail">           
                            <img src="/uploads/avatars/{{ $user->useravatar }}">            
                    </div>
                </div>
                @endif
                </div>
            </div>
        </section>
        
        <section class="profile-nav profile-sep-bar height-50">
            <div class="tab-select sticky">
            </div>
        </section>
        
        <section class="padding-top-60 padding-top-sm-30">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4 profile-info-col">
                        <div class="widget widget-prof-info">
                            <div class="panel panel-default widget-prof-info-panel">
                                <div class="panel-heading widget-prof-info-heading hidden-xs">Info</div>
                                <div class="panel-heading widget-prof-info-heading panel-headname hidden-sm hidden-md hidden-md hidden-lg">
                                {{ $user->username }}
                                </div>
                                <div class="panel-body panel-profileinfo">
                                    <ul class="panel-list">
                                        <li><i class="fa fa-clock-o"></i>
                                        <span>Joined {{ $user->created_at }}</span>
                                        </li>
                                        <li>
                                        <i class="fa fa-user-circle-o"></i>
                                        <span>Guild Rank: {{ $guildRank->rank }}</span>
                                        </li>
                                        <li>
                                        <i class="fa fa-user-circle"></i>
                                        <span>Site Rank: {{ $siteRole->role }}</span>
                                        </li>  

                                        @if($profileInfo != NULL && $profileInfo->motto != NULL)
                                        <li>
                                        <i class="fa fa-address-book"></i>
                                            <span>Motto: {{$profileInfo->motto}}</span>
                                        </li>
                                        @endif

                                        @if($profileInfo != NULL && $profileInfo->about != NULL)
                                        <li>
                                        <i class="fa fa-address-book-o"></i>
                                            <span>About: {{$profileInfo->about}}</span>
                                        </li>
                                        @endif

                                        @if($user->id === Auth::user()->id || Auth::user()->siteRole == "7")
                                        @if(Auth::user()->siteRole !== "1" && Auth::user()->siteRole !== "8" && Auth::user()->siteRole !== "9")
                                        <li class="hidden-sm hidden-md hidden-md hidden-lg">
                                            
                                            <a href="/edit/profile/{{ $user->id }}" class="btn btn-circle btn-editProf" data-toggle="tooltip" title="Edit User">
                                            <i class="fa fa-cog circle-btn-fa-widget"></i>
                                            </a>

                                        </li>
                                        @endif
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-md-9 col-sm-8 allCharacters-div">
                    @if ($mainCharacter !== NULL && $mainCharNotFound === NULL)
                    <div class="characterMasterDiv">
                    <div class="mainCharacterDiv" style="color: {{ $mainCharacter->getClassColor() }} !important;">
                        <div class="panel panel-default panel-post panel-profileTitleDiv">
                            <div class="panel-body">
                                <div class="post char-profileTitleDiv">
                                <h3 class="char-profileTitle" style="color: {{ $mainCharacter->getClassColor() }} !important;">
                                {{ $mainCharacter->charactername }}
                                </h3>
                                </div>
                            </div>
                            <div class="charHeaderBorder"></div>
                        </div>

                        <div class="panel panel-default panel-post panel-character">
                            <div class="panel-body panel-character-body">
                                <div class="post charPost"  style="background-image: 
                                url('/images/ProfileCharBktrans.png');">
                                    <div class="prof-data hidden-xs hidden-sm">

                                <div class="prof-classBanner" style="background-image: 
                                url('/images/profileClassBanners/{{$mainCharacter->getVertiClassBanner()}}');
                                background-color: rgba(
                                    {{ $mainCharacter->getClassRGBAColorOne() }},
                                    {{ $mainCharacter->getClassRGBAColorTwo() }},
                                    {{ $mainCharacter->getClassRGBAColorThree() }}, 0.3);">
                                    
                                </div>

                                    <div class="prof-charAvatar">
                                    <div class="prof-charAvatarBorderLeft"></div>
                                        <img src="http://eu.battle.net/static-render/eu/{{ $wowAPIArray['thumbnail'] }}" alt="" class="prof-char-avatar">
                                    <div class="prof-charAvatarBorderRight"></div>
                                    </div>

                                    <div class="prof-charInfo">
                                     <div class="characters-allLevel">
                                        Level: {{ $wowAPIArray['level'] }}
                                     </div>
                                     <div class="characters-allRace">
                                         {{ $mainCharacter->name }}
                                     </div>
                                     <div class="characters-allRace">
                                         {{ $characterRace->name }}
                                     </div>
                                     <div class="characters-allSpec">
                                         {{ $mainCharacter->getSpec() }}
                                     </div>
                                     <div class="characters-allClass">
                                         {{ $mainCharacter->getClass() }}
                                     </div>
                                     <div class="prof-charInfoBorderRight"></div>
                                    </div>
                                    <div class="prof-charRole" style="background-image: 
                                url('/images/profileRoleBanners/{{$mainCharacter->getVertiRoleBanner()}}');
                                background-color: rgba(
                                    {{ $mainCharacter->getRoleRGBAColorOne() }},
                                    {{ $mainCharacter->getRoleRGBAColorTwo() }},
                                    {{ $mainCharacter->getRoleRGBAColorThree() }}, 0.3);"> 
                                    </div>

                                    </div>

                                    <!-- MOBILE CHARACTER -->
                                    <div class="prof-data-sm hidden-md hidden-lg">

                                    <div class="prof-char-data-sm">
                                        <div class="prof-charAvatar-sm">
                                            <img src="http://eu.battle.net/static-render/eu/{{ $wowAPIArray['thumbnail'] }}" alt="" 
                                            class="prof-char-avatar-sm">
                                        </div>

                                    <div class="prof-charInfo-sm">
                                    <div class="thinVertiSep"></div>
                                     <div class="characters-allLevel-sm">
                                        Level: {{ $wowAPIArray['level'] }}
                                     </div>
                                     <div class="characters-allRace-sm">
                                         {{ $mainCharacter->name }}
                                     </div>
                                     <div class="characters-allRace-sm">
                                         {{ $characterRace->name }}
                                     </div>
                                     <div class="characters-allSpec-sm">
                                         {{ $mainCharacter->getSpec() }}
                                     </div>
                                     <div class="characters-allClass-sm">
                                         {{ $mainCharacter->getClass() }}
                                     </div>
                                    </div>
                                </div>

                                    <div class="prof-char-banners-sm">
                                    <div class="thinHoriSep"></div>
                                    <div class="prof-charRoleBanner-sm" style="
                                    background-image:url('/images/profileRoleBanners/{{$mainCharacter->getHoriRoleBanner()}}');
                                    background-color: rgba(
                                    {{ $mainCharacter->getRoleRGBAColorOne() }},
                                    {{ $mainCharacter->getRoleRGBAColorTwo() }},
                                    {{ $mainCharacter->getRoleRGBAColorThree() }}, 0.3);"></div>
                                    <div class="thinHoriSep"></div>
                                    <div class="prof-classBanner-sm" style="
                                    background-image: url('/images/profileClassBanners/{{$mainCharacter->getHoriClassBanner()}}');
                                    background-color: rgba(
                                    {{ $mainCharacter->getClassRGBAColorOne() }},
                                    {{ $mainCharacter->getClassRGBAColorTwo() }},
                                    {{ $mainCharacter->getClassRGBAColorThree() }}, 0.3);">
                                    </div>
                                    </div>

                                    </div>
                                    <!-- MOBILE CHARACTER -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    @endif

                @if($mainCharNotFound !== NULL)
                 <div class="characterMasterDiv">
                    <div class="mainCharacterDiv">
                        <div class="panel panel-default panel-post panel-profileTitleDiv">
                            <div class="panel-body">
                                <div class="post char-profileTitleDiv">
                                <h3 class="char-profileTitle" style="color: red;">
                                    Character Not Found!
                                </h3>
                                </div>
                            </div>
                            <div class="charHeaderBorder"></div>
                        </div>

                        <div class="panel panel-default panel-post panel-character">
                            <div class="panel-body panel-character-body">
                                <div class="post charPost"  style="background-image: 
                                url('/images/ProfileCharBktrans.png');">
                                    <div class="prof-data hidden-xs hidden-sm">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($allCharacters !== NULL)
                        <div class="panel panel-default panel-post panel-altsTitleDiv">
                            <div class="panel-body">
                                <div class="post char-profileTitleDiv">
                                <h3 class="char-profileTitle char-profileTitleAlts">
                                Alts
                                </h3>
                                </div>
                            </div>
                        </div>

                @for ($i = 0; $i < count($allCharacters); $i++)
                @if($allCharAPIArray[$i] !== "Character Not Found")
                     <div class="characterMasterDiv">
                    <div class="mainCharacterDiv" style="color: {{ $allCharacters[$i]->getClassColor() }} !important;">
                        <div class="panel panel-default panel-post panel-profileTitleDiv">
                            <div class="panel-body">
                                <div class="post char-profileTitleDiv">
                                <h3 class="char-profileTitle" style="color: {{ $allCharacters[$i]->getClassColor() }} !important;">
                                {{ $allCharacters[$i]->charactername }}
                                </h3>
                                </div>
                            </div>
                            <div class="charHeaderBorder"></div>
                        </div>

                        <div class="panel panel-default panel-post panel-character">
                            <div class="panel-body panel-character-body">
                                <div class="post charPost"  style="background-image: 
                                url('/images/ProfileCharBktrans.png');">
                                    <div class="prof-data hidden-xs hidden-sm">

                                <div class="prof-classBanner" style="background-image: 
                                url('/images/profileClassBanners/{{$allCharacters[$i]->getVertiClassBanner()}}');
                                background-color: rgba(
                                    {{ $allCharacters[$i]->getClassRGBAColorOne() }},
                                    {{ $allCharacters[$i]->getClassRGBAColorTwo() }},
                                    {{ $allCharacters[$i]->getClassRGBAColorThree() }}, 0.3);">
                                    
                                </div>

                                    <div class="prof-charAvatar">
                                    <div class="prof-charAvatarBorderLeft"></div>
                                        <img src="http://eu.battle.net/static-render/eu/{{ $allCharAPIArray[$i]['thumbnail'] }}" alt="" class="prof-char-avatar">
                                    <div class="prof-charAvatarBorderRight"></div>
                                    </div>

                                    <div class="prof-charInfo">
                                     <div class="characters-allLevel">
                                        Level: {{ $allCharAPIArray[$i]['level'] }}
                                     </div>
                                     <div class="characters-allRace">
                                         {{ $allCharacters[$i]->name }}
                                     </div>
                                     <div class="characters-allRace">
                                         {{ $allCharRaces[$i]->name }}
                                     </div>
                                     <div class="characters-allSpec">
                                         {{ $allCharacters[$i]->getSpec() }}
                                     </div>
                                     <div class="characters-allClass">
                                         {{ $allCharacters[$i]->getClass() }}
                                     </div>
                                     <div class="prof-charInfoBorderRight"></div>
                                    </div>
                                    <div class="prof-charRole" style="background-image: 
                                url('/images/profileRoleBanners/{{$allCharacters[$i]->getVertiRoleBanner()}}');
                                background-color: rgba(
                                    {{ $allCharacters[$i]->getRoleRGBAColorOne() }},
                                    {{ $allCharacters[$i]->getRoleRGBAColorTwo() }},
                                    {{ $allCharacters[$i]->getRoleRGBAColorThree() }}, 0.3);"> 
                                    </div>

                                    </div>


                                                                        <!-- MOBILE CHARACTER -->
                                    <div class="prof-data-sm hidden-md hidden-lg">

                                    <div class="prof-char-data-sm">
                                        <div class="prof-charAvatar-sm">
                                            <img src="http://eu.battle.net/static-render/eu/{{ $allCharAPIArray[$i]['thumbnail'] }}" alt="" 
                                            class="prof-char-avatar-sm">
                                        </div>

                                    <div class="prof-charInfo-sm">
                                    <div class="thinVertiSep"></div>
                                     <div class="characters-allLevel-sm">
                                        Level: {{ $allCharAPIArray[$i]['level'] }}
                                     </div>
                                     <div class="characters-allRace-sm">
                                         {{ $allCharacters[$i]->name }}
                                     </div>
                                     <div class="characters-allRace-sm">
                                         {{ $allCharRaces[$i]->name }}
                                     </div>
                                     <div class="characters-allSpec-sm">
                                         {{ $allCharacters[$i]->getSpec() }}
                                     </div>
                                     <div class="characters-allClass-sm">
                                         {{ $allCharacters[$i]->getClass() }}
                                     </div>
                                    </div>
                                </div>

                                    <div class="prof-char-banners-sm">
                                    <div class="thinHoriSep"></div>
                                    <div class="prof-charRoleBanner-sm" style="
                                    background-image:url('/images/profileRoleBanners/{{$allCharacters[$i]->getHoriRoleBanner()}}');
                                    background-color: rgba(
                                    {{ $allCharacters[$i]->getRoleRGBAColorOne() }},
                                    {{ $allCharacters[$i]->getRoleRGBAColorTwo() }},
                                    {{ $allCharacters[$i]->getRoleRGBAColorThree() }}, 0.3);"></div>
                                    <div class="thinHoriSep"></div>
                                    <div class="prof-classBanner-sm" style="
                                    background-image: url('/images/profileClassBanners/{{$allCharacters[$i]->getHoriClassBanner()}}');
                                    background-color: rgba(
                                    {{ $allCharacters[$i]->getClassRGBAColorOne() }},
                                    {{ $allCharacters[$i]->getClassRGBAColorTwo() }},
                                    {{ $allCharacters[$i]->getClassRGBAColorThree() }}, 0.3);">
                                    </div>
                                    </div>

                                    </div>
                                    <!-- MOBILE CHARACTER -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    @else
 
                <div class="characterMasterDiv">
                    <div class="mainCharacterDiv">
                        <div class="panel panel-default panel-post panel-profileTitleDiv">
                            <div class="panel-body">
                                <div class="post char-profileTitleDiv">
                                <h3 class="char-profileTitle" style="color: red;">
                                    Character "{{$altsNameArray[$i]}}" Not Found!
                                </h3>
                                </div>
                            </div>
                            <div class="charHeaderBorder"></div>
                        </div>

                        <div class="panel panel-default panel-post panel-character">
                            <div class="panel-body panel-character-body">
                                <div class="post charPost"  style="background-image: 
                                url('/images/ProfileCharBktrans.png');">
                                    <div class="prof-data hidden-xs hidden-sm">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endfor
        @endif
                    
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /#wrapper -->
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Aegis of Envy - Silvermoon</title>


    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    
    <!-- FAVICON -->
     <link rel="shortcut icon" href="images/favicon.ico">
    
    <!-- CORE CSS -->
    <link href="/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'> 
    
    <!-- PLUGINS -->
    <link href="/plugins/animate/animate.min.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="/plugins/summernote/summernote.css" rel="stylesheet">

    <!-- THEME CSS -->
    @yield('css')
    <link href="/css/theme.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <link rel="stylesheet" type="text/css" href="/css/mainlayout.css">
    <link rel="stylesheet" type="text/css" href="/css/profilelayout.css?v=1.1">

    <script src="/plugins/jquery/jquery-3.1.0.min.js"></script>
</head>
<body class="fixed-header">
    <header>
        <div class="container">
            <span class="bar hide"></span>
            <a href="/home" class="logo"><img src="/images/AELogoSM.png" alt=""></a>
            <nav class="topmenu-full">
                <div class="nav-control">
                    <ul>
                    @if(Auth::user()->siteRole !== "1" && Auth::user()->siteRole !== "8" && Auth::user()->siteRole !== "9")
                        <li><a href="/home">Home</a></li>
                        <li><a href="/forums">Forums</a></li>
                        <li><a href="/news">News</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/userlist">Users</a></li>
                        @if(Auth::user()->siteRole == "5" ||
                            Auth::user()->siteRole == "6" ||
                            Auth::user()->siteRole == "7")
                            <div class="officermenulinks">
                        <li><a href="/applications">Applications</a></li>
                            @if(Auth::user()->siteRole == "7")
                            <li><a href="/adminpanel">Admin Panel</a></li>
                            @endif
                        </div>
                        @endif
                    @else
                    <li><a href="/home">Home</a></li>
                    <li><a href="/rules">Rules</a></li>
                    @endif
                    </ul>
                </div>
            </nav>
            <div class="nav-right">
                <div class="nav-profile dropdown">
                    <a href="/profile/{{ Auth::user()->id }}" class="dropdown-toggle" data-toggle="dropdown"><img src="/uploads/avatars/{{ Auth::user()->useravatar }}" alt=""> <span>{{ Auth::user()->username }}</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/profile/{{ Auth::user()->id }}"><i class="fa fa-user"></i> Profile</a></li>
                        @if(Auth::user()->siteRole !== "1" && Auth::user()->siteRole !== "8")
                        <li><a href="/edit/profile/{{ Auth::user()->id }}"><i class="fa fa-gear"></i> Settings</a></li>
                        @endif
                        <li class="divider"></li>
                        <li>
                            <a href="{{ url('/logout') }}"">
                            <i class="fa fa-power-off"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            
            </div>
        </div>
    </header>
    <!-- /header -->

        @yield('content')
    </div>
    <!-- footer -->
    <footer>
        <div class="container">
            <div class="widget row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <h4 class="title"><img src="/images/AELogoMD.png" alt="" 
                    class="footer-bnetlogo"> About Aegis of Envy</h4>
                    <p>Dedication, Commitment, Loyalty. Just a few words which sums up Aegis of Envy. <br>
                    With roots spanning back from 2008 we have splintered from the ‘old ways’ and re-rolled on Silvermoon Alliance to forge new friendships.
                    We are looking for the same values in new members as the values of the guild.
                    You can be a new player to the game, or not quite started with the rest and looking to see the fresh challenges ahead with a guild which will be dedicated to you.
                    If we sound right for you, why not drop us a line or visit our application form to apply online.</p>
                </div>
                    
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <h4 class="title"><img src="/images/bneticonwhite.png" alt="" class="footer-bnetlogo"> Officers</h4>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
                            <ul class="nav footer-nav">
                                <li><span class="footer-officername">Holybrewski: </span>
                                <span class="footer-officerbtag">iPwNix#2992</span>
                                </li>
                                <li><span class="footer-officername">Cretori: </span>
                                <span class="footer-officerbtag">Aka#2248</span>
                                </li>
                                <li><span class="footer-officername"></span>
                                <span class="footer-officerbtag"></span>
                                </li>
                                <li><span class="footer-officername"></span>
                                <span class="footer-officerbtag"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
        
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="title"><img src="/images/bneticonblackwborder.png" alt="" 
                    class="footer-bnetlogo"> Contact an Officer</h4>
                    <p>If you are in need of anything or need help be it with your application or maybe one of your friends want to join the guild, please feel free to contact an officer.
                    All Officers are listed on the bottom of each page, directly to the left of this text, or above if you are viewing this on a smartphone.</p>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container"> 
                <ul class="list-inline">
                    <li><a href="https://twitter.com/AegisOfEnvy" class="btn btn-circle btn-social-icon" data-toggle="tooltip" title="Follow us on Twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://www.facebook.com/aegisofenvy" class="btn btn-circle btn-social-icon" data-toggle="tooltip" title="Follow us on Facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://plus.google.com/communities/107532078082443348386" class="btn btn-circle btn-social-icon" data-toggle="tooltip" title="Follow us on Google"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="http://steamcommunity.com/groups/AegisOfEnvy" class="btn btn-circle btn-social-icon" data-toggle="tooltip" title="Follow us on Steam"><i class="fa fa-steam"></i></a></li>
                </ul>
                &copy; 2016 Orions Spark. All rights reserved.
            </div>
        </div>
    </footer>   
    <!-- /.footer -->

<!-- Javascript -->   
    <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/core.min.js"></script>
    <script src="/plugins/owl-carousel/owl.carousel.min.js"></script>
    @yield('js')
    <script src="/js/mainscript.js"></script>
    <script>
    (function($) {
    "use strict";
        var owl = $(".owl-carousel");
             
        owl.owlCarousel({
            items : 4, //4 items above 1000px browser width
            itemsDesktop : [1000,3], //3 items between 1000px and 0
            itemsTablet: [600,1], //1 items between 600 and 0
            itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
        });
             
        $(".next").click(function(){
            owl.trigger('owl.next');
            return false;
        })
        $(".prev").click(function(){
            owl.trigger('owl.prev');
            return false;
        })
    })(jQuery);
    </script>
    <!-- <script src="/js/app.js"></script> -->

<script src="/plugins/summernote/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
          $('.text-editor').summernote({
            height: 250,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['picture', ['picture', 'video']],
              ]
            });
          $('.rules-title-bk').css({"left":"0"});
        });
</script>



</body>
</html>

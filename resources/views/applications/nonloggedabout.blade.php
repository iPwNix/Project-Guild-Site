<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aegis of Envy - Silvermoon EU</title>
    
    <!-- FAVICON -->
    <link rel="shortcut icon" href="images/favicon.ico">
    
    <!-- CORE CSS -->
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700' rel='stylesheet' type='text/css'> 
    
    <!-- PLUGINS -->
    <link href="plugins/animate/animate.min.css" rel="stylesheet">
    <link href="plugins/owl-carousel/owl.carousel.css" rel="stylesheet">

    <!-- THEME CSS -->
    <link href="css/theme.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/nonlogabout.css">
</head>

<!-- <body class="fixed-header">
<header class="invis-header">
</header> -->
<body>
  <div class="container fill">
    <div id="wrap">
    <div class="row row-pre-rules-title">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-pre-rules-title">
      <div class="rules-title-bk">
        <h1>About Us</h1>
      </div>
      </div>
    </div>
    
        <div class="row pre-rules-row">
          <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default pre-rules-panel">
                <div class="panel-body pre-rules-panelbody">
                  <div class="row">
                    <div class="paraf-title paraf-title-first">
                      <h2>Progress</h2>
                    </div>
                    <div class="paraf-text">
                    <div class="row progress-row">
                    <div class="col-xs-12 progress-col-1">
                      <div class="progress-title">
                        Emerald Nightmare
                      </div>

                      <div class="progress-col-1-nm">
                        <span>7/7 N</span>
                      </div>
                      <div class="progress-col-1-hc">
                        <span>7/7 H</span>
                      </div>
                      <div class="progress-col-1-myth">
                        <span>1/7 M</span>
                      </div>

                    </div>
                    </div>

                    <div class="row progress-row">
                    <div class="col-xs-12 progress-col-2">
                      <div class="progress-title">
                        Trial of Valor
                      </div> 

                      <div class="progress-col-2-nm">
                        <span>3/3 N</span>
                      </div>
                      <div class="progress-col-2-hc">
                        <span>0/3 H</span>
                      </div>
                      <div class="progress-col-2-myth">
                        <span>0/7 M</span>
                      </div>

                    </div>
                    </div>

                    <div class="row progress-row">
                    <div class="col-xs-12 progress-col-3">
                      <div class="progress-title">
                        Nighthold
                      </div>

                      <div class="progress-col-3-nm">
                        <span>0/10 N</span>
                      </div>
                      <div class="progress-col-3-hc">
                        <span>0/10 H</span>
                      </div>
                      <div class="progress-col-3-myth">
                        <span>0/10 M</span>
                      </div>


                    </div>
                    </div>

                    </div>
                  </div>

              <div class="row">
                  <div class="paraf-title">
                    <h2>In Short</h2>
                  </div>
                  <div class="paraf-text">
                    <p>Dedication, Commitment, Loyalty. Just a few words which sums up Aegis of Envy. 
                    <br>
                    With roots spanning back from 2008 we have splintered from the ‘old ways’ and re-rolled on Silvermoon Alliance to forge new friendships. 
                    <br>
                     We are looking for the same values in new members as the values of the guild. 
                     <br>
                     You can be a new player to the game, or not quite started with the rest and looking to see the fresh challenges ahead with a guild which will be dedicated to you. 
                     <br>
                     If we sound right for you, why not drop us a line or visit our application form to apply online.</p>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>

</div>

</div> <!-- This one wants to be 100% height -->
    <!-- Javascript -->
    <script src="plugins/jquery/jquery-3.1.0.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/core.min.js"></script>
    <script src="plugins/twitter/twitter.js"></script>
    <script>
      $(function() {
      $('.rules-title-bk').css({"left":"0"});

      /*** Total Raid Bosses***/
      var raidOneTotal = 7;
      var raidTwoTotal = 3;
      var raidThreeTotal = 10;
      /*** Raid One Progress ***/
      var raidOneProgNM = 7;
      var raidOneProgHC = 7;
      var raidOneProgMY = 1;
      /*** Raid Two Progress ***/
      var raidTwoProgNM = 3;
      var raidTwoProgHC = 0;
      var raidTwoProgMY = 0;
      /*** Raid Three Progress ***/
      var raidThreeProgNM = 0;
      var raidThreeProgHC = 0;
      var raidThreeProgMY = 0;
      /*** Raid One Procents ***/
      var raidOneNMPrec = Math.floor((raidOneProgNM / raidOneTotal) * 100)+"%";
      var raidOneHCPrec = Math.floor((raidOneProgHC / raidOneTotal) * 100)+"%";
      var raidOneMYPrec = Math.floor((raidOneProgMY / raidOneTotal) * 100)+"%";
      /*** Raid One Procents Animations***/
      $('.progress-col-1-nm').css({"width": raidOneNMPrec});
      $('.progress-col-1-hc').css({"width": raidOneHCPrec});
      $('.progress-col-1-myth').css({"width": raidOneMYPrec});

      /*** Raid Two Procents ***/
      var raidTwoNMPrec = Math.floor((raidTwoProgNM / raidTwoTotal) * 100)+"%";
      var raidTwoHCPrec = Math.floor((raidTwoProgHC / raidTwoTotal) * 100)+"%";
      var raidTwoMYPrec = Math.floor((raidTwoProgMY / raidTwoTotal) * 100)+"%";
      /*** Raid Two Procents Animations***/
      $('.progress-col-2-nm').css({"width": raidTwoNMPrec});
      $('.progress-col-2-hc').css({"width": raidTwoHCPrec});
      $('.progress-col-2-myth').css({"width": raidTwoMYPrec});

      /*** Raid Three Procents ***/
      var raidThreeNMPrec = Math.floor((raidThreeProgNM / raidThreeTotal) * 100)+"%";
      var raidThreeHCPrec = Math.floor((raidThreeProgHC / raidThreeTotal) * 100)+"%";
      var raidThreeMYPrec = Math.floor((raidThreeProgMY / raidThreeTotal) * 100)+"%";
      /*** Raid Three Procents Animations***/
      $('.progress-col-3-nm').css({"width": raidThreeNMPrec});
      $('.progress-col-3-hc').css({"width": raidThreeHCPrec});
      $('.progress-col-3-myth').css({"width": raidThreeMYPrec});
      });
    </script>
</body>
</html>
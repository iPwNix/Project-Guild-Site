@extends('layouts.app')

@section('content')
    <!-- wrapper --> 
    <div id="wrapper">
    @if(Auth::user()->siteRole !== "1" && Auth::user()->siteRole !== "8" && Auth::user()->siteRole !== "9")
    @if($acceptMsgOne != NULL)
    <div class="acceptMessage">
        <div class="messageLineOne">{{$acceptMsgOne}}</div>
        <div class="messageLineTwo">{{$acceptMsgTwo}}</div>
        <div class="messageLineThree"><p>This message will disappear 4 days after acceptance</p></div>
    </div>
    @endif
    
        <div id="full-carousel" class="ken-burns carousel slide full-carousel carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#full-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#full-carousel" data-slide-to="1"></li>
                <li data-target="#full-carousel" data-slide-to="2"></li>
                <li data-target="#full-carousel" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active inactiveUntilOnLoad">
                    <img src="uploads/carousel/{{ $carouselInfo[0]->imagePath }}" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1 data-animation="animated animate1 bounceInDown">
                            {{ $carouselInfo[0]->title }}</h1>

                                @if($carouselInfo[0]->description != NULL)
                                <p data-animation="animated animate7 fadeIn">
                                    {{ $carouselInfo[0]->description }}
                                </p>
                                @endif
                                
                                @if($carouselInfo[0]->link != NULL && $carouselInfo[0]->linkName != NULL)
                                <p data-animation="animated animate7 fadeIn">
                                    <a href="{{ $carouselInfo[0]->link }}" target="_blank" data-toggle="modal" class="btn btn-success btn-lg btn-rounded" data-animation="animated animate10 fadeIn">
                                    {{ $carouselInfo[0]->linkName }}</a>
                                </p>
                                @endif

                            @if (Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
                            <a href="/edit/homecarousel/{{ $carouselInfo[0]->id }}" data-toggle="modal" class="btn btn-editSlide btn-lg btn-rounded" data-animation="animated animate10 fadeIn">Edit Slide</a>
                            @endif
                        </div>      
                    </div>
                </div>
                
                <div class="item">
                    <img src="uploads/carousel/{{ $carouselInfo[1]->imagePath }}" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1 data-animation="animated animate1 fadeInDown">
                            {{ $carouselInfo[1]->title }}</h1>
                            
                                @if($carouselInfo[1]->description != NULL)
                                <p data-animation="animated animate7 fadeIn">
                                    {{ $carouselInfo[1]->description }}
                                </p>
                                @endif

                                @if($carouselInfo[1]->link != NULL && $carouselInfo[1]->linkName != NULL)
                                <p data-animation="animated animate7 fadeIn">
                                    <a href="{{ $carouselInfo[1]->link }}" target="_blank" data-toggle="modal" class="btn btn-success btn-lg btn-rounded" data-animation="animated animate10 fadeIn">
                                    {{ $carouselInfo[1]->linkName }}</a>
                                </p>
                                @endif

                            @if (Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
                            <a href="/edit/homecarousel/{{ $carouselInfo[1]->id }}" data-toggle="modal" class="btn btn-editSlide btn-lg btn-rounded" data-animation="animated animate10 fadeIn">Edit Slide</a>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="item">
                    <img src="uploads/carousel/{{ $carouselInfo[2]->imagePath }}" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1 data-animation="animated animate1 fadeIn">
                            {{ $carouselInfo[2]->title }}</h1>

                            @if($carouselInfo[2]->description != NULL)
                            <p data-animation="animated animate7 fadeIn">
                                    {{ $carouselInfo[2]->description }}
                            </p>
                            @endif
                            
                                @if($carouselInfo[2]->link != NULL && $carouselInfo[2]->linkName != NULL)
                                <p data-animation="animated animate7 fadeIn">
                                    <a href="{{ $carouselInfo[2]->link }}" target="_blank" data-toggle="modal" class="btn btn-success btn-lg btn-rounded" data-animation="animated animate10 fadeIn">
                                    {{ $carouselInfo[2]->linkName }}</a>
                                </p>
                                @endif


                            @if (Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
                            <a href="/edit/homecarousel/{{ $carouselInfo[2]->id }}" data-toggle="modal" class="btn btn-editSlide btn-lg btn-rounded" data-animation="animated animate10 fadeIn">Edit Slide</a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="item">
                    <img src="uploads/carousel/{{ $carouselInfo[3]->imagePath }}" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1 data-animation="animated animate1 fadeIn">
                            {{ $carouselInfo[3]->title }}</h1>
                            
                                @if($carouselInfo[3]->description != NULL)
                                <p data-animation="animated animate7 fadeIn">
                                    {{ $carouselInfo[3]->description }}
                                </p>
                                @endif
                                
                                @if($carouselInfo[3]->link != NULL && $carouselInfo[3]->linkName != NULL)
                                <p data-animation="animated animate7 fadeIn">
                                    <a href="{{ $carouselInfo[3]->link }}" target="_blank" data-toggle="modal" class="btn btn-success btn-lg btn-rounded" data-animation="animated animate10 fadeIn">
                                    {{ $carouselInfo[3]->linkName }}</a>
                                </p>
                                @endif


                            @if (Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
                            <a href="/edit/homecarousel/{{ $carouselInfo[3]->id }}" data-toggle="modal" class="btn btn-editSlide btn-lg btn-rounded" data-animation="animated animate10 fadeIn">Edit Slide</a>
                            @endif
                        </div>
                    </div>
                </div>
                            
                <a class="left carousel-control" href="#full-carousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                </a>
                <a class="right carousel-control" href="#full-carousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        <section class="bg-grey-50 news-section border-top-1 border-bottom-1 border-grey-200 relative">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="title outline">
                            <h4 style="color: #f6f5fb"><i class="fa fa-file-text"></i> Recent News </h4>
                            @if(Auth::user()->siteRole == "7" || Auth::user()->siteRole == "6" || Auth::user()->siteRole == "5")
                            <p>
                             <a href="/news/create" class="btn btn-full btn-postnews" data-toggle="tooltip" title="Post News">
                             <i class="fa fa-newspaper-o"></i>
                             </a>
                            </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">

                @foreach($latestNews as $latestNew)
                    
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="card card-hover">
                            <div class="card-img">
                                <img src="uploads/articles/imgnewssmallimages/{{ $latestNew->newsSmallImage }}" alt="">
                                <div class="category"><span class="label label-warning front-label-catagory">
                                    {{ $latestNew->getCatagory() }}
                                </span></div>
                            </div>
                            <div class="caption front-news-caption">
                                <h3 class="card-title">
                                <a href="news/{{ $latestNew->id }}">
                                {{ $latestNew->title }}</a></h3>
                                <ul>
                                    <li>{{ $latestNew->created_at }}</li>
                                </ul>
<!--                                 <p>
                                {!! str_limit($latestNew->content, 64) !!}
                                </p> -->
                            </div>
                        </div>
                    </div>


                @endforeach
    
                <div class="text-center"><a href="/news" class="btn btn-full btn-newsmore">More <i class="fa fa-angle-right"></i></a></div>
            </div>
        </section>

 @else


<div class="row homeapply-row">
          <div class="col-md-8 col-md-offset-2 homeapply-col">
            <div class="panel panel-default homeapply-panel">
                <div class="panel-body homeapply-panelbody">
                  <div class="row home-panel-row">
                    <div class="homeapply-title">
                      <h2>Thank u for your application!</h2>
                    </div>
                    </div>

                    <div class="row home-panel-row">
                    <div class="homeapply-text">
                      <h3>Your Application Status: 
                      <span style="color:
                      {{$TheApplication[0]->getStatusColor()}};">
                      {{$TheApplication[0]->getStatus()}}    
                      </span>
                      </h3>
                    </div>
                    </div>

                    <div class="row home-panel-row-last">
                    <div class="homeapply-text">
                      @if($TheApplication[0]->status == "1")
                        <p>If you have anything to add please contact an officer</p>
                      @endif
                      @if($TheApplication[0]->status == "3")
                        <p>
                        Thank u for your interest in joining but sadly your Application was Declined
                        </p>
                      @endif
                    </div>
                    </div>

                  <div class="row buttonviewapply-row home-panel-row">
                    <div class="confirm-button">
                      <a href="/apply" class="btn btn-info btn-viewapply" role="button">
                      View Application</a>
                    </div>
                  </div>

                </div>
            </div>
        </div>
    </div>






 @endif               
    </div>
    <!-- /#wrapper --> 
    <script>
      $(function() {
      $('.acceptMessage').css({"left":"0"});

      var counter = 0;
        var interval = setInterval(function() {
            counter++;
            // Display 'counter' wherever you want to display it.
            if (counter == 5) {
                $('.acceptMessage').fadeOut();
                clearInterval(interval);
            }
        }, 1000);
      });

    </script>
@endsection

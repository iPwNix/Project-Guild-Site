@extends('layouts.app')

@section('content')
   <div id="wrapper">  
        <section class="padding-bottom-60">
            <div class="container">
                <div class="headline edit-profile-headline">
                    <h4 class="no-padding-top">Viewing <a href="/profile/{{$applyToShow->getUserID()}}">{{$applyToShow->getUserName()}}'s</a> Application
                    </h4>
                </div>

                <div class="panel panel-default margin-bottom-30 edit-profile-panel">
                    <div class="panel-body">
	                    <div class="leQuestion">
	                    	<div class="applyQuestion">
	                    		<span>{{$allQuestions[0]->applyQuestion}}</span>
	                    	</div>
	                    	<div class="applyAnswer">
	                    		<span>{{$applyToShow->questionOne}}</span>
	                    	</div>
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[1]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{{$applyToShow->questionTwo}}</span>
						</div>
							 
							
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[2]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{{$applyToShow->getClass()}} </span>
						</div>
							 
							
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[3]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{{$applyToShow->getSpec()}}</span>
						</div>
							 
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[4]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{{$applyToShow->questionFive}}</span>
						</div>
							 
							
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[5]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{{$applyToShow->questionSix}}</span>
						</div>
							 
							
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[6]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{{$applyToShow->questionSeven}}</span>
						</div>
							 
							
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[7]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{{$applyToShow->questionEight}}</span>
						</div>
							 
							
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[8]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{{$applyToShow->questionNine}}</span>
						</div>
							 
							
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[9]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{{$applyToShow->questionTen}}</span>
						</div>
							 
							
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[10]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{!!$applyToShow->questionEleven!!}</span>
						</div>
							 
							
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[11]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{{$applyToShow->questionTwelve}}</span>
						</div>
							 
							
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[12]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{{$applyToShow->questionThirdteen}}</span>
						</div>
							 
							
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[13]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{{$applyToShow->questionFourteen}}</span>
						</div>
							 
							
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[14]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span><a href="http://{{$applyToShow->questionFifteen}}">{{$applyToShow->questionFifteen}}</a></span>
						</div>
							 
							
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[15]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{{$applyToShow->questionSixteen}}</span>
						</div>
							 
							
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[16]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{{$applyToShow->questionSeventeen}}</span>
						</div>
							 
							
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[17]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{{$applyToShow->questionEighteen}}</span>
						</div>
							 
							
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[18]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{{$applyToShow->questionNineteen}}</span>
						</div>
							 
							
						</div>
						<div class="leQuestion">
						<div class="applyQuestion">
							<span>{{$allQuestions[19]->applyQuestion}}</span>
						</div>
						<div class="applyAnswer">
							<span>{!!$applyToShow->questionTwenty!!}</span>
						</div>
							 
							
						</div>                   

                    </div>
                    @if(Auth::user()->siteRole == "5" ||
                        Auth::user()->siteRole == "6" ||
                        Auth::user()->siteRole == "7")
                    <div class="applyButtons">
                    
					<a href="/application/{{$applyToShow->id}}/accept" class="btn btn-rankchange btn-banUser applyaccdec-btn">
						Accept
					</a>

					<a href="/application/{{$applyToShow->id}}/decline" class="btn btnDeleteChar btn-banUser applyaccdec-btn">
						Decline
					</a>
                    </div>
                    @endif()
                </div>
            </div>
        </section>
    </div>
@endsection
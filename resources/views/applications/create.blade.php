@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="/css/apply.css">
    <div id="wrapper">  
        <section class="section-50 padding-bottom-60">
            <div class="container apply-container">

                <div class="headerline">
                    <div class="datpadding">
                    <h4>Making Application</h4>
                    </div>
                </div>

                <div class="panel panel-default margin-bottom-30 applying-panel">
                    <div class="panel-body applying-panelbody">

                    <div class="row" style="
                    color: #d3290f; 
                    text-decoration: underline;
                    font-family: BatmanFaRegular !important;
                    text-align: center;
                    font-size: 25px;
                    -webkit-text-stroke: 1px #1c7fb6;
                    ">
                        <p>
                        WARNING: due to problems with our servers profanity filter the page might refresh after sending the application, be careful what words to use.<br>
                        Just in case, backup any large texts before sending in your application!<br>
                        If this happends please contact an officer listed below.
                        </p>
                    </div>

                    {!!Form::open(array('url' => '/apply', 'method'=>'POST', 'files'=>true, 'role'=>'form', 'id'=>'applyForm'))!!}
                    {{ csrf_field() }}

                        <div class="form-group">
                            <label for="Realname" class="col-md-12 control-label">{{$allQuestions[0]->applyQuestion}}</label>
                                {!!Form::text('Realname',null, array('placeholder'=>'Please enter your Real Name.',
                                'maxlength' => 100, 'class'=>'form-control'))!!}

                                @if ($errors->has('Realname'))
                                    <span class="help-block">
                                        <strong>No Name Entered!</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="Age" class="col-md-12 control-label">{{$allQuestions[1]->applyQuestion}}</label>

                                <select class="form-control" id="Age" name="Age">
                                      @for($x = 16; $x <= 100; $x++)
                                        <option value="{{$x}}">{{$x}}</option>
                                      @endfor
                                </select>

                                @if ($errors->has('Age'))
                                    <span class="help-block">
                                        <strong>No Age Entered!</strong>
                                    </span>
                                @endif
                        </div>

                           <div class="form-group">
                            <label for="Class" class="col-md-12 control-label">{{$allQuestions[2]->applyQuestion}}
                            </label>
                                <select class="form-control" id="Class" name="Class">
                                      @foreach($allClasses as $Class)
                                        <option value="{{$Class->id}}">{{$Class->className}}</option>
                                      @endforeach
                                </select>
                                @if ($errors->has('Class'))
                                    <span class="help-block">
                                        <strong>Problem with the Class!</strong>
                                    </span>
                                @endif
                            </div>

                        <div class="form-group">
                            <label for="Spec" class="col-md-12 control-label">{{$allQuestions[3]->applyQuestion}}</label>
                                <select class="form-control" id="Spec" name="Spec">
                                     @foreach($allSpecs as $Spec)
                                        <option value="{{$Spec->id}}">{{$Spec->spec}}</option>
                                      @endforeach
                                </select>
                                @if ($errors->has('Spec'))
                                    <span class="help-block">
                                        <strong>Problem with the Spec!</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="CharName" class="col-md-12 control-label">{{$allQuestions[4]->applyQuestion}}</label>
                                {!!Form::text('CharName',null, array('placeholder'=>'Please enter your Character name.','maxlength' => 100,'class'=>'form-control'))!!}

                                @if ($errors->has('CharName'))
                                    <span class="help-block">
                                        <strong>No Character Name Entered!</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="ArmoryLink" class="col-md-12 control-label">{{$allQuestions[5]->applyQuestion}}</label>
                                {!!Form::text('ArmoryLink',null, array('placeholder'=>'Please enter the Armory link of your Character.','maxlength' => 100,'class'=>'form-control'))!!}

                                @if ($errors->has('ArmoryLink'))
                                    <span class="help-block">
                                        <strong>No ArmoryLink Entered!</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="Battletag" class="col-md-12 control-label">{{$allQuestions[6]->applyQuestion}}</label>
                                {!!Form::text('Battletag',null, array('placeholder'=>'Please enter your Battletag.','maxlength' => 50,'class'=>'form-control'))!!}

                                @if ($errors->has('Battletag'))
                                    <span class="help-block">
                                        <strong>No Battletag Entered!</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="Rank" class="col-md-12 control-label">{{$allQuestions[7]->applyQuestion}}</label>
                                <select class="form-control" id="Rank" name="Rank">
                                        <option value="Raider">Raider</option>
                                        <option value="Social">Social</option>
                                </select>

                                @if ($errors->has('Rank'))
                                    <span class="help-block">
                                        <strong>Problem with the Rank!</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group form-radio-group">
                            <label for="RaidDays" class="col-md-12 control-label">{{$allQuestions[8]->applyQuestion}}</label>
                            <div class="radio RaidDays col-md-12">
                                <select class="form-control" id="RaidDays" name="RaidDays">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                </select>

                                @if ($errors->has('RaidDays'))
                                    <span class="help-block">
                                        <strong>Problem with the RaidDays!</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="DaysPlayed" class="col-md-12 control-label">{{$allQuestions[9]->applyQuestion}}</label>
                                {!!Form::text('DaysPlayed',null, array('placeholder'=>'Please enter how many days you played on your main.', 'maxlength' => 255,'class'=>'form-control'))!!}

                                @if ($errors->has('DaysPlayed'))
                                    <span class="help-block">
                                        <strong>Days Played not Entered!</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                        <div class="row">
                            <label for="Raidxp" class="col-md-12 control-label">{{$allQuestions[10]->applyQuestion}}</label>
                        </div>

                    <div class="forum-post no-margin no-shadow" 
                                    id="Raidxp" name="Raidxp">
                                       <textarea name="Raidxp" id="Raidxp" cols="30" rows="10" style="width: 100%; height: 100%; resize: none; text-align: center;"></textarea>
                                    </div>

                                @if ($errors->has('Raidxp'))
                                <div class="row">
                                    <span class="help-block">
                                        <strong>Raiding Experience not Entered!</strong>
                                    </span>
                                </div>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="Playtimes" class="col-md-12 control-label">{{$allQuestions[11]->applyQuestion}}</label>
                                {!!Form::text('Playtimes',null, array('placeholder'=>'Please tell us your playing times','maxlength' => 255,'class'=>'form-control'))!!}

                                @if ($errors->has('Playtimes'))
                                    <span class="help-block">
                                        <strong>Playing Times not Entered!</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="PrevGuilds" class="col-md-12 control-label">{{$allQuestions[12]->applyQuestion}}</label>
                                {!!Form::text('PrevGuilds',null, array('placeholder'=>'Please tell us your previous Guilds','maxlength' => 255,'class'=>'form-control'))!!}

                                @if ($errors->has('PrevGuilds'))
                                    <span class="help-block">
                                        <strong>Previous Guilds not Entered!</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="ReaLeave" class="col-md-12 control-label">{{$allQuestions[13]->applyQuestion}}</label>
                                {!!Form::text('ReaLeave',null, array('placeholder'=>'Please tell us the reason you left your previous Guilds','maxlength' => 255,'class'=>'form-control'))!!}

                                @if ($errors->has('ReaLeave'))
                                    <span class="help-block">
                                        <strong>No Leave Reason(s) Entered!</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="WhyJoin" class="col-md-12 control-label">{{$allQuestions[15]->applyQuestion}}</label>
                                {!!Form::text('WhyJoin',null, array('placeholder'=>'Tell us why you would like to join', 'maxlength' => 50, 'class'=>'form-control'))!!}

                                @if ($errors->has('WhyJoin'))
                                    <span class="help-block">
                                        <strong>No Reasons Entered!</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="WhyYou" class="col-md-12 control-label">{{$allQuestions[16]->applyQuestion}}</label>
                                {!!Form::text('WhyYou',null, array('placeholder'=>'Tell us why we should choose you', 'maxlength' => 255, 'class'=>'form-control'))!!}

                                @if ($errors->has('WhyYou'))
                                    <span class="help-block">
                                        <strong>No Reasons Entered!</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="Vouch" class="col-md-12 control-label">{{$allQuestions[17]->applyQuestion}}</label>
                                {!!Form::text('Vouch',null, array('placeholder'=>'Anyone who can vouch?', 'maxlength' => 255,'class'=>'form-control'))!!}

                                @if ($errors->has('Vouch'))
                                    <span class="help-block">
                                        <strong>No Voucher Entered!</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="Hear" class="col-md-12 control-label">{{$allQuestions[18]->applyQuestion}}</label>
                                {!!Form::text('Hear',null, array('placeholder'=>'How did you find us?', 'maxlength' => 255,'class'=>'form-control'))!!}

                                @if ($errors->has('Hear'))
                                    <span class="help-block">
                                        <strong>You found us nowhere, how interesting!</strong>
                                    </span>
                                @endif
                        </div>

                    <div class="form-group">
                        <div class="row">
                            <label for="Tellus" class="col-md-12 control-label">{{$allQuestions[19]->applyQuestion}}</label>
                        </div>

                    <div class="forum-post no-margin no-shadow" 
                                    id="Tellus" name="Tellus">
                            <textarea name="Tellus" id="Tellus" cols="30" rows="10" style="width: 100%; height: 100%; resize: none; text-align: center;"></textarea>
                                    </div>
                                    </div>

                                @if ($errors->has('Tellus'))
                                <div class="row">
                                    <span class="help-block">
                                        <strong>Nothing to say? Come on you can think of something!</strong>
                                    </span>
                                </div>
                                @endif
                        </div>



                          <div class="row form-group-row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info btn-acceptrules">
                                    <i class="fa fa-btn fa-sign-in"></i> Apply
                                </button>
                            </div>
                        </div>
                    </div
{!!Form::close()!!}

                    </div>
                </div>
                
            </div>
        </section>
    </div>
    <!-- footer -->

<!-- Javascript -->   
    <script>
    $(function() {
        $('#Class').change(function(){
            var changedClass = this.value;
            var specArray = <?php echo json_encode($allSpecs); ?>;
            //console.log(specArray);
            //console.log(specArray.length);
            //console.log(specArray[0]);
             var specbox = $('#Spec');
             specbox.empty();
             var list = '';
             for (var j = 0; j < specArray.length; j++){
               if (specArray[j].classID == changedClass) {
                console.log(specArray[j].spec);
                list += "<option value='" +specArray[j].id+ "'>" +specArray[j].spec+ "</option>";
               }
             }
             specbox.html(list);
        });
        $("select#Class").val(1).trigger('change');
    });
    </script>
@endsection
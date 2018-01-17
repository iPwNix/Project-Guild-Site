<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Aegis of Envy - Silvermoon EU</title>
    <link rel="shortcut icon" href="images/favicon.ico">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <link rel="stylesheet" href="/css/register.css">

    <style>
        .g-recaptcha div:first-child{
            width: 100% !important;
        }

        @media screen and (max-width: 370px){
        #rc-imageselect, .g-recaptcha {transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;}
        }
    </style>
</head>
<body>

<div class="container fill">
<div id="wrap">

    <div class="row row-pre-rules-title">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-pre-rules-title">
      <div class="rules-title-bk">
        <h1>Register</h1>
      </div>
      </div>
    </div>

    <div class="row pre-rules-row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default registering-panel">
                <div class="panel-body registering-panelbody">

                    {!!Form::open(array('url' => '/register', 'method'=>'POST', 'files'=>false, 'role'=>'form', 'id'=>'registerForm'))!!}

                        {{ csrf_field() }}

                    <div class="row form-group-row">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!!Form::label('name', 'Realname', ['class' => 'col-md-12 control-label'])!!}

                            <div class="col-md-12">
                                {!!Form::text('name',null, array('placeholder'=>'Enter your Realname','class'=>'form-control'))!!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row form-group-row">
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            {!!Form::label('username', 'Username', ['class' => 'col-md-12 control-label'])!!}

                            <div class="col-md-12">
                                {!!Form::text('username',null, array('placeholder'=>'Enter a Username','class'=>'form-control'))!!}

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row form-group-row">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!!Form::label('email', 'Email', ['class' => 'col-md-12 control-label'])!!}

                            <div class="col-md-12">
                                {!!Form::text('email',null, array('placeholder'=>'Enter your Email','class'=>'form-control'))!!}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row form-group-row">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {!!Form::label('password', 'Password', ['class' => 'col-md-12 control-label'])!!}

                            <div class="col-md-12">
                                {!!Form::password('password', array('placeholder'=>'Enter a Password','class'=>'form-control'))!!}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row form-group-row">
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            {!!Form::label('password-confirm', 'Password Confirm', ['class' => 'col-md-12 control-label'])!!}

                            <div class="col-md-12">
                                {!!Form::password('password_confirmation', array('placeholder'=>'Confirm your Password', 'id'=>'password-confirm','class'=>'form-control'))!!}

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row form-group-row">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! app('captcha')->display()!!}
                                {!! $errors->first('g-recaptcha-response','<p class="alert alert-danger">Captcha is Required</p>')!!}
                            </div>
                        </div>
                    </div>

                    <div class="row form-group-row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info btn-acceptrules">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                    </div>

{!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script>
      $(function() {
      $('.rules-title-bk').css({"left":"0"});
      });
    </script>

</body>
</html>


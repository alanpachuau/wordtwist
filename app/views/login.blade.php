<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Twist :: Login</title>
    <link rel="stylesheet" type="text/css" href="/libraries/bs3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/login.css">
</head>
<body>
    <div class="container">
        {{Form::open(array('url'=>'/login', 'method'=>'post', 'class'=>'form-signin'))}}
            <h1 class="text-center form-singin-heading">identify yourself</h1>
            <hr>
            @if(Session::has('logout'))
            <p class="text-primary text-center"><span class="glyphicon glyphicon-ok-circle"></span> {{Session::get('logout')}}</p>
            @endif

            @if($errors->has('loginFailed'))
            <p class="text-danger text-center">{{$errors->first('loginFailed')}}</p>
            @endif

            <div class="form-group col-lg-12 col-md-12 col-sm-12 {{$errors->has('username')?'has-error':''}}">
                {{Form::label('username','Username',array('class'=>'sr-only'))}}
                {{Form::text("username", "", array('placeholder'=>'Username', 'class'=>'form-control input-lg'))}}
            </div>
            <div class="form-group col-lg-12 col-md-12 col-sm-12 {{$errors->has('password')?'has-error':''}}">
                {{Form::label('password','Password',array('class'=>'sr-only'))}}
                {{Form::password("password", array('placeholder'=>'Password', 'class'=>'form-control input-lg'))}}
            </div>
            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                {{Form::submit('LOGIN', array('class'=>'btn btn-success btn-lg col-lg-12 col-md-12 col-sm-12 col-xs-12'))}}
            </div>
        {{Form::close()}}
    </div>

    <script type="text/javascript" src="/libraries/jquery.js"></script>
    <script type="text/javascript" src="/libraries/bs3/js/bootstrap.min.js"></script>
</body>
</html>

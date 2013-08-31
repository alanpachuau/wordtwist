<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Twist :: Admin</title>
    <link rel="stylesheet" type="text/css" href="/libraries/bs3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/admin.css">
</head>
<body>
	@section('sidebar')
		<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Word Twist <span class="glyphicon glyphicon-random"></span></a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="/">Home</a></li>
              <li><a href="/game/create">Add Game</a></li>
              <li><a href="/game">Games</a></li>
              <li><a href="/user/create">Add User</a></li>
              <li><a href="/user">Users</a></li>
              <li><a href="/scoreboard" target="_blank">Score Board</a></li>
              <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </nav>
	@show
	<div class="container">
    @if(Session::has('successMessage'))
    <div class="alert alert-success">{{Session::get('successMessage')}}</div>
    @endif
    @if(Session::has('errorMessage'))
    <div class="alert alert-danger">{{Session::get('errorMessage')}}</div>
    @endif
		@yield('content')
	</div>
    <div id="footer">
        <hr>
        <p class="text-muted text-center">&copy; {{date('Y')}} Word Twist</p>
    </div>
    <script type="text/javascript" src="/libraries/jquery.js"></script>
    <script type="text/javascript" src="/libraries/bs3/js/bootstrap.min.js"></script>

    @section('script')
    @show
</body>
</html>
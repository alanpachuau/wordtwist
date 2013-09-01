<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Twist :: Player</title>
    <link rel="stylesheet" type="text/css" href="/libraries/bs3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/player.css">
</head>
<body>
	@section('sidebar')
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
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
          <li><a href="/">Play</a></li>
          <li><a href="/result">Results</a></li>
          <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </nav>
	@show

  <div class="container" style="margin-bottom:40px;">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
    <h3 class="text-center text-info">{{Auth::user()->username}}</h3>
    </div>
    <div class="col-lg-4"></div>
  </div>
	<div class="container">

		@yield('content')
	</div>

    <script type="text/javascript" src="/libraries/jquery.js"></script>
    <script type="text/javascript" src="/libraries/bs3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/player.js"></script>
    
    @section('script')
    @show
</body>
</html>
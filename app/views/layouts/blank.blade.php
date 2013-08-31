<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Twist :: Player</title>
    <link rel="stylesheet" type="text/css" href="/libraries/bs3/css/bootstrap.min.css">
    <style type="text/css">
    body {padding: 50px 0 0;}
    .blank {width:200px;margin: 0 auto;}
    .blank p.options {margin:40px 0 0;}
    .blank p.options a {font-size: 30px;}
    </style>
</head>
<body>
    <div class="container">
        <div class="blank">
            <h2 class="text-center text-danger">are you lost</h2>
            <hr>
            <p class="options text-center"><a href="/" title="Go Home" data-placement="bottom" data-toggle="tooltip" data-trigger="hover" class=""><span class="glyphicon glyphicon-home"></span></a>&nbsp;&nbsp;&nbsp;<a href="/login" title="Login" data-placement="bottom" data-toggle="tooltip" data-trigger="hover"><span class="glyphicon glyphicon-log-in"></span></a></p>
        </div>
    </div>
    <script type="text/javascript" src="/libraries/jquery.js"></script>
    <script type="text/javascript" src="/libraries/bs3/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(function(){
        $('.options a').tooltip();
    });
    </script>
</body>
</html>
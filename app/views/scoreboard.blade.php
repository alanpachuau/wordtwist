<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Twist :: Score Board</title>
    <link rel="stylesheet" type="text/css" href="/libraries/bs3/css/bootstrap.min.css">
    <style type="text/css">
    body {padding: 10px 0 0;}
    .blank {width:200px;margin: 0 auto;}
    .blank p.options {margin:40px 0 0;}
    .blank p.options a {font-size: 30px;}
    </style>
</head>
<body>
    <div class="container">
        <div class="col-lg-12">
            @if($game)
            <h3 class="text-center tex">SCORE BOARD</h3>
            <h1 class="text-center text-success" style="font-family:monospace;font-size:5em;">{{strtoupper($game->word)}}</h1>
            @else
            <h1 class="text-center tex">SCORE BOARD</h1>
            @endif
            <table class="table score-table">
                <tr>
                    <td align="bottom" style="vertical-align:bottom;" class='col-lg-3'>
                        <div id="red" style="width:100%;min-height:1px;background: rgb(218, 54, 54);position:relative;"></div>
                        <h2 class="text-center text-">RED HOUSE</h2>
                        <span style="display:block;width:100%;font-size:30px;font-weight:bold;font-family:Verdana;text-transform:uppercase;text-align:center;color:black;">{{$r}}<br>Word{{($r>1)?'s':''}}</span>
                    </td>
                    <td align="bottom" style="vertical-align:bottom;" class='col-lg-3'>
                        <div id="green" style="width:100%;min-height:1px;background: rgb(55, 185, 55);position:relative;"></div>
                        <h2 class="text-center text-">GREEN HOUSE</h2>
                        <span style="display:block;width:100%;font-size:30px;font-weight:bold;font-family:Verdana;text-transform:uppercase;text-align:center;color:black;">{{$g}}<br>Word{{($g>1)?'s':''}}</span>
                    </td>
                    <td align="bottom" style="vertical-align:bottom;" class='col-lg-3'>
                        <div id="blue" style="width:100%;min-height:1px;background: rgb(16, 120, 233);position:relative;"></div>
                        <h2 class="text-center text-">BLUE HOUSE</h2>
                        <span style="display:block;width:100%;font-size:30px;font-weight:bold;font-family:Verdana;text-transform:uppercase;text-align:center;color:black;">{{$b}}<br>Word{{($b>1)?'s':''}}</span>
                    </td>
                    <td align="bottom" style="vertical-align:bottom;" class='col-lg-3'>
                        <div id="yellow" style="width:100%;min-height:1px;background: rgb(219, 204, 40);position:relative;"></div>
                        <h2 class="text-center text-">YELLOW HOUSE</h2>
                        <span style="display:block;width:100%;font-size:30px;font-weight:bold;font-family:Verdana;text-transform:uppercase;text-align:center;color:black;">{{$y}}<br>Word{{($y>1)?'s':''}}</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/javascript" src="/libraries/jquery.js"></script>
    <script type="text/javascript" src="/libraries/bs3/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(function(){
        var h = window.innerHeight - 380;
        $(".score-table td div").css("height", h);
        // $(".score-table td").height(h-350);

        var r = {{$r?$r:0}};
        var g = {{$g?$g:0}};
        var b = {{$b?$b:0}};
        var y = {{$y?$y:0}};
        var highest = {{$highest?$highest:0}};

        var rp = 0;
        if(r > 0)
            rp = (r/highest)*100;

        var gp = 0;
        if(g > 0)
            gp = (g/highest)*100;

        var bp = 0;
        if(b > 0)
            bp = (b/highest)*100;

        var yp = 0;
        if(y > 0)
            yp = (y/highest)*100;

        var rh = 0;
        if(rp > 0)
            rh = (rp/100) * h;

        var gh = 0;
        if(gp > 0)
            gh = (gp/100) * h;

        var bh = 0;
        if(bp > 0)
            bh = (bp/100) * h;

        var yh = 0;
        if(yp > 0)
            yh = (yp/100) * h;
// console.log(rp);
// console.log(gp);
// console.log(bp);
// console.log(yp);
// console.log(h);
// console.log(rh);
// console.log(gh);
// console.log(bh);
// console.log(yh);
        $("#red").css("height", rh);
        $("#green").css("height", gh);
        $("#blue").css("height", bh);
        $("#yellow").css("height", yh);
    });
    var intvl;
    clearInterval(intvl);
    intvl = setInterval("window.location.reload()", 3000);
    </script>
</body>
</html>
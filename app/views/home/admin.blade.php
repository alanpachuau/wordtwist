@section('content')
<fieldset>
	<legend>Monitoring</legend>
	<div class="row gamereport">
		<div class="col-lg-9">
			<h4 class="chart-title">Game Chart</h4>
			<div class="chart">
				<div id="team_red" class="team">
					<label>RED HOUSE - {{$r}} words</label>
					<div class="score text-right"><div class="bar"></div></div>
				</div>
				<div id="team_green" class="team">
					<label>GREEN HOUSE - {{$g}} words</label>
					<div class="score text-right"><div class="bar"></div></div>
				</div>
				<div id="team_blue" class="team">
					<label>BLUE HOUSE 3 - {{$b}} words</label>
					<div class="score text-right"><div class="bar"></div></div>
				</div>
				<div id="team_yellow" class="team">
					<label>YELLOW HOUSE 4 - {{$y}} words</label>
					<div class="score text-right"><div class="bar"></div></div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			@foreach($rounds as $rnd)
			<div class="round-report active-round">
				<h4>{{Game::find($rnd->game_id)->name}}</h4>
				<ol>
					<?php
					$rs = GameData::where('user_id','=',3)->where('game_id','=',$rnd->game_id)->first();
					$rs = ($rs->point)?$rs->point:0;
					$gs = GameData::where('user_id','=',1)->where('game_id','=',$rnd->game_id)->first();
					$gs = ($gs->point)?$gs->point:0;
					$bs = GameData::where('user_id','=',2)->where('game_id','=',$rnd->game_id)->first();
					$bs = ($bs->point)?$bs->point:0;
					$ys = GameData::where('user_id','=',4)->where('game_id','=',$rnd->game_id)->first();
					$ys = ($ys->point)?$ys->point:0;
					?>
					<li>Red House: {{$rs}}</li>
					<li>Green House: {{$gs}}</li>
					<li>Blue House: {{$bs}}</li>
					<li>Yellow House: {{$ys}}</li>
				</ol>
			</div>
			<hr>
			@endforeach
		</div>
	</div>
</fieldset>
@stop

@section('script')
<script type="text/javascript">
var interval;
clearInterval(interval);
interval = setInterval('window.location.reload()', 3000);

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

$("#team_red .score .bar").css('width', rp+'%');
$("#team_green .score .bar").css('width', gp+'%');
$("#team_blue .score .bar").css('width', bp+'%');
$("#team_yellow .score .bar").css('width', yp+'%');

// var interval;
// clearInterval(interval);
// $(function() {
// 	interval = setInterval('getGameReport(3)', 1000);
// });

// function getGameReport(gameid)
// {
// 	$.ajax({
// 		url: '/gamereport/'+gameid,
// 		dataType: 'json',
// 		beforeSend: function(){
// 		}
// 	}).success(function(result){
// 		console.log(result);
// 		$.each(result.scores, function(key, data){
// 			var percent = (data.point/result.maxPoint) * 100;
// 			$("#team"+data.user_id+" label").text("Team "+data.user_id+" - "+data.point+" words");
// 			$("#team"+data.user_id+" .score .bar").css('width', percent+'%');
// 		});
// 	});
// }
</script>
@stop
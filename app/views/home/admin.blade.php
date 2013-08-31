@section('content')
<fieldset>
	<legend>Monitoring</legend>
	<div class="row gamereport">
		<div class="col-lg-9">
			<h4 class="chart-title">Game Chart</h4>
			<div class="chart">
				<div id="team1" class="team">
					<label>Team 1 - 0 words</label>
					<div class="score text-right"><div class="bar"></div></div>
				</div>
				<div id="team2" class="team">
					<label>Team 2 - 0 words</label>
					<div class="score text-right"><div class="bar"></div></div>
				</div>
				<div id="team3" class="team">
					<label>Team 3 - 0 words</label>
					<div class="score text-right"><div class="bar"></div></div>
				</div>
				<div id="team4" class="team">
					<label>Team 4 - 0 words</label>
					<div class="score text-right"><div class="bar"></div></div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="round-report active-round">
				<h4>Word 1</h4>
				<ol>
					<li>Team 1: 200 points</li>
					<li>Team 2: 200 points</li>
					<li>Team 3: 200 points</li>
					<li>Team 4: 200 points</li>
				</ol>
				<hr>
			</div>
			<div class="round-report">
				<h4>Word</h4>
				<ol>
					<li>Team 1: 200 words</li>
					<li>Team 2: 200 words</li>
					<li>Team 3: 200 words</li>
					<li>Team 4: 200 words</li>
				</ol>
			</div>
		</div>
	</div>
</fieldset>
@stop

@section('script')
<script type="text/javascript">
var interval;
clearInterval(interval);
$(function() {
	interval = setInterval('getGameReport(1)', 1000);
});

function getGameReport(gameid)
{
	$.ajax({
		url: '/gamereport/'+gameid,
		dataType: 'json',
		beforeSend: function(){
		}
	}).success(function(result){
		console.log(result);
		$.each(result.scores, function(key, data){
			var percent = (data.point/result.maxPoint) * 100;
			$("#team"+data.user_id+" label").text("Team "+data.user_id+" - "+data.point+" words");
			$("#team"+data.user_id+" .score .bar").css('width', percent+'%');
		});
	});
}
</script>
@stop
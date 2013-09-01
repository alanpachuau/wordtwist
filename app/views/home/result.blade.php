@section('content')
<div class="col-lg-3"></div>
<div class="col-lg-6">
	<div class="panel panel-info">
	  	<div class="panel-heading">
	    	<h3 class="panel-title">Game Result</h3>
	  	</div>
	  	<div class="panel-body">

	  		@if($game_data->count())
	  		<table class="table table-hover">
	  			<tr>
	  				<th>#</th>
	  				<th>Round</th>
	  				<th>Score</th>
	  			</tr>
	  			<?php
	  			$total = 0;
	  			foreach($game_data as $key=>$gd) :
	  				$game = Game::find($gd->game_id);
	  				$total += $gd->point;
	  			?>
	  			<tr>
	  				<td>{{$key+1}}</td>
	  				<td>{{$game->name}}</td>
	  				<td><b>{{$gd->point}}</b></td>
	  			</tr>
	  			<?php endforeach; ?>
	  			<tr>
	  				<td></td>
	  				<td>Total Score</td>
	  				<td><b>{{$total}}</b></td>
	  			</tr>
	  		</table>
	  		@else
	  		<p>There's no game result to display yet.</p>
	  		@endif
	  	</div>
	</div>
</div>
<div class="col-lg-3"></div>
@stop

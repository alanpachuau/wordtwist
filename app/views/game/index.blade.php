@section('content')
<fieldset>
	<legend>Games</legend>
	{{$active}}
	<p class="help-block">We can have only one game active at one time.</p>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Words</th>
				<th>Duration</th>
				<th>Minimum Letter</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($games as $game)
			<tr>
				<td>{{$game->id}}</td>
				<td>{{$game->name}}</td>
				<td><?php
				$words = explode("\r\n",$game->word);
				foreach($words as $key=>$w)
					echo ($key+1).". ".$w."<br>";
				?></td>
				<td>{{$game->duration}} Seconds</td>
				<td>{{$game->minimum_letter}}</td>
				<td>
					{{Form::open(array('url'=>'/game/'.$game->id, 'method'=>'delete', 'class'=>'form form-inline'))}}
					
					@if($game->status == 'completed')
						<span class="btn btn-sm btn-success">{{strtoupper($game->status)}}</span>
					@elseif($game->status == 'active')
						<a href="javascript:void(0)" class="btn btn-sm btn-primary">{{strtoupper($game->status)}}</a>

					@elseif($active > 0)
						<a href="javascript:void(0)" class="btn disabled btn-sm btn-info">START</a>
					@else
						<a href="/game/{{$game->id}}/start" class="btn btn-sm btn-info">START</a>
					@endif

					<a href="/game/{{$game->id}}/edit" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>

					@if($game->status != 'completed')
					<button onclick="return confirm('Are you sure you want to delete this game?')" type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button>
					@endif
					{{Form::close()}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{$games->links()}}
</fieldset>
@stop
@section('content')
<fieldset>
	<legend>Games</legend>
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
				<td>{{nl2br($game->word)}}</td>
				<td>{{$game->duration}}</td>
				<td>{{$game->minimum_letter}}</td>
				<td>
					{{Form::open(array('url'=>'/game/'.$game->id, 'method'=>'delete', 'class'=>'form form-inline'))}}
					<a href="/game/start" class="disabled btn btn-sm btn-info">START</a>
					<a href="/game/{{$game->id}}/edit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
					<button onclick="return confirm('Are you sure you want to delete this game?')" type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button>
					{{Form::close()}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{$games->links()}}
</fieldset>
@stop
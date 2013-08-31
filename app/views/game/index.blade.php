@section('content')
<fieldset>
	<legend>Games</legend>
	<div class="row">
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
						<a href="/game/start">Start Game</a>
						<a href="/game/{{$game->id}}/edit">Edit</a>
						<a href="">Delete</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="row">{{$games->links()}}</div>
</fieldset>
@stop
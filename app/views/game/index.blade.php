@section('content')
<fieldset>
	<legend>Games</legend>

	<p class="help-block">We can have only one game active at one time.</p>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Word</th>
				<th>Name</th>
				<th>Duration</th>
				<th>Minimum Letter</th>
				<th>Players</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($games as $game)
			<tr>
				<td>{{$game->id}}</td>
				<td>{{strtoupper($game->word)}}</td>
				<td>{{$game->name}}</td>
				<td>{{$game->duration}} seconds</td>
				<td>{{$game->minimum_letter}}</td>
				<td>
					<a data-toggle="modal" href="#model_{{$game->id}}">{{sizeof(explode(',',$game->players))}} players</a>
					
					<div class="modal fade" id="model_{{$game->id}}" tabindex="-1" role="dialog" aria-labelledby="{{$game->name}}" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">{{$game->name}} - Players</h4>
								</div>
								<div class="modal-body">
									<table class="table">
										<tr>
											<th>Position</th>
											<th>Name</th>
											<th>Point</th>
										</tr>
										@foreach(GameData::standings($game->id) as $key=>$d)
										<tr>
											<td>{{++$key}}</td>
											<td>{{User::find($d->user_id)->username}}</td>
											<td>{{$d->point}}</td>
										</tr>
										@endforeach
									</table>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
				</td>
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

					@if($game->status != 'completed')
					<a href="/game/{{$game->id}}/edit" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
					@endif

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
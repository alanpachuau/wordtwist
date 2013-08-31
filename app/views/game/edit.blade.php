@section('content')
<fieldset>
	<legend>Edit Game</legend>
	<div class="row">
		{{Form::open(array('url'=>'/game/'.$game->id, 'method'=>'put', 'class'=>'form form-horizontal'))}}

		<div class="form-group">
			<label for="name" class="col-lg-3 control-label">Name</label>
			<div class="col-lg-6">
				{{ Form::text('name', $game->name, array('placeholder'=>'Ex: My Game', 'id'=>'name', 'class'=>'form-control')) }}
			</div>
		</div>

		<div class="form-group {{$errors->has('duration')?'has-error':''}}">
			<label for="duration" class="col-lg-3 control-label">Duration</label>
			<div class="col-lg-6">
				{{ Form::text('duration', $game->duration, array('placeholder'=>'Ex: 120', 'id'=>'duration', 'class'=>'form-control')) }}
				<p class="help-block">Please enter game duration in seconds.</p>
			</div>
		</div>
		
		<div class="form-group {{$errors->has('players')?'has-error':''}}">
			<label for="players" class="col-lg-3 control-label">Players</label>
			<div class="col-lg-6">
				{{ Form::select('players[]', $players, explode(",", $game->players), array('multiple'=>'yes', 'id'=>'players', 'class'=>'form-control')) }}
				<p class="help-block">Select players for this game. Press and hold CTRL to select players.</p>
			</div>
		</div>

		<div class="form-group {{$errors->has('minimum_letter')?'has-error':''}}">
			<label for="minimum_letter" class="col-lg-3 control-label">Minimum Letter</label>
			<div class="col-lg-6">
				{{ Form::text('minimum_letter', $game->minimum_letter, array('placeholder'=>'Ex: 2', 'id'=>'minimum_letter', 'class'=>'form-control')) }}
				<p class="help-block">Minimum letter count allowed.</p>
			</div>
		</div>
		
		<div class="form-group {{$errors->has('words')?'has-error':''}}">
			<label for="word" class="col-lg-3 control-label">Words List</label>
			<div class="col-lg-6">
				{{ Form::textarea('word', $game->word, array('rows'=>"5", 'style'=>'resize:vertical', 'id'=>'word', 'class'=>'form-control')) }}
				<p class="help-block">Enter one word per one line.</p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-lg-offset-3 col-lg-6">
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
		</div>		
		{{Form::close()}}
	</div>

</fieldset>
@stop
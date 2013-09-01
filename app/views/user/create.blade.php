@section('content')
<fieldset>
	<legend>Add User</legend>
	<div class="row">
		{{Form::open(array('url'=>'/user', 'method'=>'post', 'class'=>'form form-horizontal'))}}

		<div class="form-group">
			<label for="name" class="col-lg-3 control-label">Username</label>
			<div class="col-lg-6">
				{{ Form::text('username', '', array( 'id'=>'username', 'class'=>'form-control')) }}
			</div>
		</div>
		
		<div class="form-group">
			<label for="name" class="col-lg-3 control-label">Password</label>
			<div class="col-lg-6">
				{{ Form::text('password', '', array( 'id'=>'password', 'class'=>'form-control')) }}
			</div>
		</div>
		
		<div class="form-group {{$errors->has('users')?'has-error':''}}">
			<label for="types" class="col-lg-3 control-label">Type</label>
			<div class="col-lg-6">
				{{ Form::select('types[]', $types, 'player', array('id'=>'types', 'class'=>'form-control')) }}
				
			</div>
		</div>

		

		<div class="form-group">
			<div class="col-lg-offset-3 col-lg-6">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>		
		{{Form::close()}}
	</div>

</fieldset>
@stop
@section('content')
<fieldset>
	<legend>Users</legend>
	
	<p class="help-block">{{$useractive}} -> Existing Players in this games</p>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Username</th>
				<th>Password</th>
				<th>Type</th>
				<th>Status</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
			<tr>
				<td>{{$user->id}}</td>
				<td>{{$user->username}}</td>
				<td>{{$user->password}}</td>
				<td>{{$user->type}}</td>
				<td>{{$user->status}}</td>
				<td>
					{{Form::open(array('url'=>'/user/'.$user->id, 'method'=>'delete', 'class'=>'form form-inline'))}}
					<button onclick="return confirm('Are you sure you want to delete this User?')" type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button>
					{{Form::close()}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{$users->links()}}
</fieldset>
@stop
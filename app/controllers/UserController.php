<?php

class UserController extends \BaseController {
	public function __construct()
	{
		$this->beforeFilter('auth');
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$useractive = User::where('status','=','active')->count();
		$this->layout->content = View::make('user.index', array('users' => User::paginate(10), 'useractive'=>$useractive));
		//return View::make('user.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$types = array('admin'=>'Administrator','player'=>'Player');

		$this->layout->content = View::make('user.create', array('types'=>$types));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = new User;
		$user->username = Input::get('username');
		$user->password = Hash::make(Input::get('password'));
		$user->type = implode(",",Input::get('types'));
		$user->status = 'active';
		$user->save();
		
		return Redirect::to("/user")->with(array('successMessage'=>'User create successfully.'));	
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		dd(Input::all());
		if($id != null)
		{
			$user = User::find($id);
			if($user)
			{
				$user->delete();

				return Redirect::to("/user")->with(array('successMessage'=>'User deleted successfully.'));
			}
			else
				return Redirect::to("/user")->with(array('errorMessage'=>'Invalid user id!'));
		}
		else
			return Redirect::to("/user")->with(array('errorMessage'=>'Invalid user id!'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
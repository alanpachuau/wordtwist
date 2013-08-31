<?php

class GameController extends \BaseController {
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
		$this->layout->content = View::make('game.index', array('games' => Game::paginate(10)));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$users = User::all();
		$players = array();
		foreach($users as $user)
			$players[$user->id] = $user->username;

		$this->layout->content = View::make('game.create', array('players'=>$players));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name'				=> 'alpha_num',
			'duration'			=> 'numeric|required',
			'players'			=> 'required',
			'minimum_letter'	=> 'required',
			'word'				=> 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails())
			return Redirect::to("/game/create")->withErrors($validator)->withInput();
		else
		{
			// dd(Input::all());
			$game = new Game;
			$game->name = (Input::get('name') != '')?Input::get('name'):'My Game';
			$game->duration = Input::get('duration');
			$game->players = implode(",",Input::get('players'));
			$game->minimum_letter = Input::get('minimum_letter');
			$game->word = Input::get('word');
			$game->save();

			return Redirect::to("/game/create")->with(array('successMessage'=>'Game create successfully.'));
		}
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
		if($id != null)
		{
			$game = Game::find($id);
			if($game)
			{
				$users = User::all();
				$players = array();
				foreach($users as $user)
					$players[$user->id] = $user->username;

				$this->layout->content = View::make('game.edit', array('game'=>$game, 'players'=>$players));
			}
			else
				return Redirect::to("/game")->with(array('errorMessage'=>'Invalid game id!'));
		}
		else
			return Redirect::to("/game")->with(array('errorMessage'=>'Invalid game id!'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if($id != null)
		{
			$game = Game::find($id);
			if($game)
			{
				$game->name = (Input::get('name') != '')?Input::get('name'):'My Game';
				$game->duration = Input::get('duration');
				$game->players = implode(",",Input::get('players'));
				$game->minimum_letter = Input::get('minimum_letter');
				$game->word = Input::get('word');
				$game->save();

				return Redirect::to("/game/".$id."/edit/")->with(array('successMessage'=>'Game updated successfully.'));
			}
			else
				return Redirect::to("/game")->with(array('errorMessage'=>'Invalid game id!'));
		}
		else
			return Redirect::to("/game")->with(array('errorMessage'=>'Invalid game id!'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if($id != null)
		{
			$game = Game::find($id);
			if($game)
			{
				$game->delete();

				return Redirect::to("/game")->with(array('successMessage'=>'Game deleted successfully.'));
			}
			else
				return Redirect::to("/game")->with(array('errorMessage'=>'Invalid game id!'));
		}
		else
			return Redirect::to("/game")->with(array('errorMessage'=>'Invalid game id!'));
	}

}
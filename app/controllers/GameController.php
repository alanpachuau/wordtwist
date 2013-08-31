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
		$users = array(1=>'Alan', 2=>'Pachuau');
		$this->layout->content = View::make('game.create', array('players'=>$users));
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
		//
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
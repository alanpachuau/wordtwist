<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function welcome()
	{
		if(Auth::check() && Auth::user()->type == 'admin')
		{
			$greenhouse = GameData::where("user_id","=",1)->get(array(DB::raw('SUM(point) as point')));
			$greenhouse = $greenhouse->toArray();
			$bluehouse = GameData::where("user_id","=",2)->get(array(DB::raw('SUM(point) as point')));
			$bluehouse = $bluehouse->toArray();
			$redhouse = GameData::where("user_id","=",3)->get(array(DB::raw('SUM(point) as point')));
			$redhouse = $redhouse->toArray();
			$yellowhouse = GameData::where("user_id","=",4)->get(array(DB::raw('SUM(point) as point')));
			$yellowhouse = $yellowhouse->toArray();

			$highest = GameData::orderby(DB::raw('SUM(point)'), 'desc')->groupby('user_id')->get(array(DB::raw('SUM(point) as point')));
			$highest = $highest->toArray();

			$rounds = GameData::get(array(DB::raw('distinct(game_id) as game_id')));

			$this->layout->content = View::make('home.admin', array(
				'r' => (isset($redhouse)? $redhouse[0]['point']:0),
				'g' => (isset($greenhouse)?$greenhouse[0]['point']:0),
				'b' => (isset($bluehouse)?$bluehouse[0]['point']:0),
				'y' => (isset($yellowhouse)?$yellowhouse[0]['point']:0),
				'highest' => (isset($highest)?$highest[0]['point']:0),
				'rounds' => $rounds
				));
		}
		elseif(Auth::check() && Auth::user()->type == 'player')
		{
			Game::where('status','=','active')->where('finish_at', '<=', DB::raw('NOW()'))->update(array('status'=>'completed'));

			$active_game = Game::where('status','=','active')
				->where('start_at', '<=', DB::raw('NOW()'))
				->where('finish_at', '>=', DB::raw('NOW()'))
				->first();
			
			$active_game_data = null;
			
			if($active_game)
				$active_game_data = GameData::where('game_id', '=', $active_game->id)->where('user_id','=',Auth::user()->id)->first();

			$this->layout->content = View::make('home.player', array('active_game'=>$active_game, 'active_game_data'=>$active_game_data));
		}
		else
			return Redirect::route('login');
	}

	public function store()
	{
		$word = Input::get('word');		
		$score = 0;

		$active_game = Game::where('status','=','active')->first();
		$active_game_data = GameData::where('game_id', '=', $active_game->id)->where('user_id','=',Auth::user()->id)->first();

		if($active_game_data)
		{
			$words = unserialize($active_game_data->words);
			$words[] = $word;

			$score = $point = sizeof($words);

			$active_game_data->words = serialize($words);
			$active_game_data->point = $point;
			$active_game_data->save();
		}
		else
		{
			$data = new GameData;
			$data->game_id = $active_game->id;
			$data->user_id = Auth::user()->id;
			$data->words = serialize(array($word));
			$data->point = 1;
			$data->save();

			$score = 1;
		}

		return Response::json(array(
			'word'=>$word,
			'score'=>$score,
			'success'=>'Word added successfully.'
			));
	}

	public function result()
	{
		Game::where('status','=','active')->where('finish_at', '<=', DB::raw('NOW()'))->update(array('status'=>'completed'));

		$game_data = GameData::where('user_id','=',Auth::user()->id)->orderby('created_at', 'asc')->get();

		$this->layout->content = View::make('home.result', array('game_data'=>$game_data));
	}
}
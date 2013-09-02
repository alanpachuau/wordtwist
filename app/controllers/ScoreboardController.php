<?php

class ScoreboardController extends \BaseController {
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

		$active_game = Game::where('status','=','active')
			->where('start_at', '<=', DB::raw('NOW()'))
			->where('finish_at', '>=', DB::raw('NOW()'))
			->first();

		return View::make('scoreboard', array(
			'r' => (isset($redhouse)? $redhouse[0]['point']:0),
			'g' => (isset($greenhouse)?$greenhouse[0]['point']:0),
			'b' => (isset($bluehouse)?$bluehouse[0]['point']:0),
			'y' => (isset($yellowhouse)?$yellowhouse[0]['point']:0),
			'highest' => (isset($highest)?$highest[0]['point']:0),
			'game' => $active_game
			));
	}
}
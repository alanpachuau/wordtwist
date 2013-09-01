<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@welcome');
Route::get('/result', 'HomeController@result');
Route::post('/', 'HomeController@store');
Route::get('/scoreboard', 'ScoreboardController@index');

Route::get('login', array('as'=>'login', function()
{
	if(Auth::check())
		return Redirect::to('/');
	else
		return View::make('login');
}));

Route::post('login', array('before'=>'csrf', function()
{
	$rules = array(
		'username' 	=> 'required',
		'password'	=> 'required'
		);

	$validator = Validator::make(Input::all(), $rules);

	if($validator->fails())
		return Redirect::to("login")->withErrors($validator)->withInput();

	if(Auth::attempt(array('username'=>Input::get('username'),'password'=>Input::get('password')))) {
		return Redirect::intended('/');
	}
	else
		return Redirect::to("login")->withErrors(array('loginFailed'=>'Sorry! Who are you?'));
}));

Route::get('logout', array('as'=>'logout', function(){
	Auth::logout();
	return Redirect::to('login')->with('logout', 'Logout successfully');
}));

Route::resource('user', 'UserController');
Route::resource('game', 'GameController');

Route::get('/game/{id}/start', 'GameController@start');

Route::get('/gamereport/{id}', function($id){
	$scores = GameData::where('game_id','=',$id)->get(array('user_id','point'));
	$maxPoint = GameData::where('game_id','=',$id)->first(array(DB::raw('MAX(point) as point')));
	return Response::json(array('maxPoint'=>$maxPoint->point, 'scores'=>$scores->toArray()));
});

Route::get('/gamestart', function(){
	$activegame = Game::where('status','=','active')->get(array(DB::raw('name as gamename'), DB::raw('TIME_TO_SEC(TIMEDIFF(`start_at`, NOW())) as timeleft')));
	if($activegame)
	{
		$activegame = $activegame->toArray();
		if(isset($activegame[0]))
			return Response::json($activegame[0]);
		else
			return Response::json(array());
	}
	else
		return Response::json(array());
});

Route::get('/remaining', function(){
	$activegame = Game::where('status','=','active')->get(array(DB::raw('TIME_TO_SEC(TIMEDIFF(`finish_at`, NOW())) as remaining')));
	if($activegame)
	{
		$activegame = $activegame->toArray();
		if(isset($activegame[0]))
			return Response::json($activegame[0]);
		else
			return Response::json(array());
	}
	else
		return Response::json(array());
});

Route::get('/dictionary/{word}', function($word){
	$word = Dictionary::where('word', '=', $word)->count();
	if($word > 0)
		return Response::json(array("valid"));
	else
		return Response::json(array("invalid"));
});

Route::get('/distinctword/{word}', function($word){
	$active_game = Game::where('status','=','active')
		->where('start_at', '<=', DB::raw('NOW()'))
		->where('finish_at', '>=', DB::raw('NOW()'))
		->first();


	$gamedata = GameData::where('game_id', '=', $active_game->id)
		->where('user_id', '=', Auth::user()->id)
		->first();
	if($gamedata)
	{
		$words = unserialize($gamedata->words);

		if(in_array($word, $words))
			return Response::json(array("invalid"));
		else
			return Response::json(array("valid"));
	}
	else
		return Response::json(array("valid"));
});

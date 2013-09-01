<?php
class GameData extends Eloquent {
	protected $table = 'game_data';

	public static function standings($id=null)
	{
		if($id != null)
		{
			$data = GameData::where('game_id','=',$id)->orderby('point', 'desc')->get();
			return $data;
		}
		else return null;
	}
}
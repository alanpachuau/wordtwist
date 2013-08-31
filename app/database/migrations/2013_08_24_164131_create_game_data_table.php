<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('game_data', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('game_id');
			$table->integer('user_id');
			$table->text('words'); // To be stored as serialized data
			$table->integer('point');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('game_data');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('games', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('name')->nullable(); // Name of the game, optional
			$table->string('word');
			$table->integer('duration'); // game duration for each word in seconds
			$table->string('players');
			$table->integer('minimum_letter');
			$table->dateTime('start_at')->nullable();
			$table->dateTime('finish_at')->nullable();
			$table->string('status')->nullable();
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
		Schema::drop('games');
	}

}

<?php

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		DB::table('users')->delete(); 

		User::create(array(
			'username' => 'greenhouse',
			'password' => Hash::make('pass'),
			'type' => 'player',
			'status' => 'active'
			));

		User::create(array(
			'username' => 'bluehouse',
			'password' => Hash::make('pass'),
			'type' => 'player',
			'status' => 'active'
			));

		User::create(array(
			'username' => 'redhouse',
			'password' => Hash::make('pass'),
			'type' => 'player',
			'status' => 'active'
			));

		User::create(array(
			'username' => 'yellowhouse',
			'password' => Hash::make('pass'),
			'type' => 'player',
			'status' => 'active'
			));

		User::create(array(
			'username' => 'admin',
			'password' => Hash::make('pass'),
			'type' => 'admin',
			'status' => 'active'
			));
	}

}
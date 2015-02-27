<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('username')->unique();
			$table->string('password');
			$table->boolean('admin')->default(false);
			$table->boolean('moderator')->default(false);
			$table->string('email')->unique();
			$table->string('remember_token')->nullable();
			$table->timestamps();
			$table->string('oauth_token')->nullable();
			$table->string('oauth_token_secret')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}

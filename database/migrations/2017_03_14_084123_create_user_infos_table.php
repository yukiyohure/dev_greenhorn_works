<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfosTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('slack_user_id')->nullable();
            $table->string('tel')->nullable();
            $table->string('sex')->nullable();
            $table->timestamp('birthday')->nullable();
            $table->timestamp('hire_date')->nullable();
            $table->integer('store_id')->nullable();
            $table->integer('access_right')->nullable();
            $table->integer('position_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_infos');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkSchedulesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('work_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type');
            $table->string('year');
            $table->string('month');
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
		Schema::drop('work_schedules');
	}

}

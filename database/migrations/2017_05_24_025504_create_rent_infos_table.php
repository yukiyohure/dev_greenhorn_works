<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentInfosTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rent_infos', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('item_id');
            $table->integer('admin_user_id');
            $table->timestamp('rental_request_at'); // 貸し出し申請日
            $table->timestamp('scheduled_return_at')->nullable(); // 返却予定日
            $table->timestamp('return_at')->nullable(); // 返却日
            $table->timestamp('rental_at')->nullable(); //　貸し出し日
            $table->timestamp('approved_at')->nullable();
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
		Schema::drop('rent_infos');
	}

}

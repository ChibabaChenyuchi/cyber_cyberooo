<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRadioresponsesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('radioresponses', function(Blueprint $table)
		{
			 $table->engine = "InnoDB";
			$table->increments('id');
			$table->integer('question_id');
			$table->string('response');
			$table->foreign('question_id')->references('id')->on('questions');
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
		Schema::drop('radioresponses');
	}

}

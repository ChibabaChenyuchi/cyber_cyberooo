<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderResponsesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('slider_responses', function(Blueprint $table)
		{
			 $table->engine = "InnoDB";
			$table->increments('id');
			$table->integer('question_id');
			$table->integer('minimum_value');
			$table->integer('maximum_value');
			$table->integer('steps');
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
		Schema::drop('slider_responses');
	}

}

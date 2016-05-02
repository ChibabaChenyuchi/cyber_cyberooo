<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingBarResponsesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rating_bar_responses', function(Blueprint $table)
		{
			 $table->engine = "InnoDB";
			$table->increments('id');
			$table->integer('question_id');
			$table->interger('number_of_stars');
			$table->floatval('steps');
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
		Schema::drop('rating_bar_responses');
	}

}

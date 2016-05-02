<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function(Blueprint $table)
		{
			 $table->engine = "InnoDB";
			$table->increments('id');
			$table->integer('question_number');
			$table->string('question');
			$table->string('response_type');
			$table->integer('client_id');
			$table->integer('response_type_id');
			
			$table->timestamps();

			$table->foreign('response_type_id')->references('id')->on('response_types');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('questions');
	}

}

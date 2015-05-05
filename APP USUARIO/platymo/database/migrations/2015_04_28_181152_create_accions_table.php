<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('acciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('actuador_id')->unsigned();
			$table->foreign('actuador_id')
			      ->references('id')->on('actuadores')
			      ->onDelete('cascade');
			$table->integer('estado');
			$table->time('hora');
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
		Schema::drop('acciones');
	}

}

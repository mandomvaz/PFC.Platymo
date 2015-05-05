<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActuadoresEscenasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('actuadores_escenas', function(Blueprint $table)
		{
			$table->integer('escena_id')->unsigned();
			$table->foreign('escena_id')
			      ->references('id')->on('escenas')
			      ->onDelete('cascade');
			$table->integer('actuador_id')->unsigned();
			$table->foreign('actuador_id')
			      ->references('id')->on('actuadores')
			      ->onDelete('cascade');
			$table->integer('estado');
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
		Schema::drop('actuadores_escenas');
	}

}

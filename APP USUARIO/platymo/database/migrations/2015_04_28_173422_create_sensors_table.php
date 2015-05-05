<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sensores', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('tipo_sensor', ['temp']);
			$table->integer('valor');
			$table->integer('nodo_id')->unsigned();
			$table->foreign('nodo_id')
				  ->references('id')->on('nodos')
				  ->onDelete('cascade');
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
		Schema::drop('sensores');
	}

}

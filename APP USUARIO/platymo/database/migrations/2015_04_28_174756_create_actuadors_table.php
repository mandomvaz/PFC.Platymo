<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActuadorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('actuadores', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 50);
			$table->integer('posicion');
			$table->integer('estado');
			$table->boolean('principal');
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
		Schema::drop('actuadores');
	}

}

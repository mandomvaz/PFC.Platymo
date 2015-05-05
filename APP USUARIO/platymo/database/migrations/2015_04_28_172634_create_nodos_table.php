<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nodos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('my', 2)->unique();
			$table->string('estancia', 50);
			$table->enum('tipo_estancia', ['dormitorio', 'baño', 'zona_paso', 'sala_estar', 'cocina']);
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
		Schema::drop('nodos');
	}

}

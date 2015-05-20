<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccionDiaTabla extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('acciones_dias', function(Blueprint $table)
		{
			$table->enum('dia_sem', [0,1,2,3,4,5,6]);
			$table->integer('accion_id')->unsigned();
			$table->foreign('accion_id')
				  ->references('id')->on('acciones')
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
		//
		
		Schema::drop('acciones_dias');
	}

}

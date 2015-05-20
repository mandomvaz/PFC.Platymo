<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTipoEstanciaNodo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('nodos', function($table){
			$table->dropColumn('tipo_estancia');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('nodos', function($table){
			$table->enum('tipo_estancia', ['dormitorio', 'baño', 'zona_paso', 'sala_estar', 'cocina']);
		});
	}

}

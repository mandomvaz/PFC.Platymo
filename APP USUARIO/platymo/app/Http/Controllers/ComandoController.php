<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Actuador;
use App\Nodo;
use App\Library\PythonComm;

class ComandoController extends Controller {

	public function actuador($id, $valor){
		$datos = array();

		$actuador = Actuador::find($id);

		$nodo = $actuador->nodo()->first();
		$datos['my'] = $nodo->my;
		$datos['funcion'] = '10';
		$datos['posicion'] = $actuador->posicion;
		$datos['valor'] = $valor;

		//PythonComm::envia($datos);


		return redirect()->back();
	}

}

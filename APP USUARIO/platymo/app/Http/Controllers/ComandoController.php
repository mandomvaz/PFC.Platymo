<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Actuador;
use App\Nodo;
use App\Escena;
use App\Library\PythonComm;

class ComandoController extends Controller {

	public function actuador($id, $valor){
		$datos = array();

		$actuador = Actuador::find($id);

		
		$datos['peticion'] = 'actuador';
		
		$datos['id'] = $actuador->id;
		$datos['valor'] = (int)$valor;

		PythonComm::envia($datos);


		return redirect()->back();
	}

	public function escena($id){

		$escena = Escena::find($id);

		$datos = array();

		$datos['peticion'] = 'escena';
		$datos['escena'] = $escena->id;

		PythonComm::envia($datos);

		return redirect()->back();

	}

	public function apagarTodo(){
		$datos['peticion'] = 'apagarTodo';

		PythonComm::envia($datos);

		return redirect()->back();
	}

}

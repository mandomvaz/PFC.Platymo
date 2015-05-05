<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Http\Requests\HabStoreFormRequest;


use App\Nodo;
use App\Actuador;
use App\Sensor;


class HabitacionController extends Controller {

	public function create(){
		//
		
		$actuadores = old('actuador');
		$posiciones = old('posicion');
		
		$nodo = new Nodo;
		return view('config.habitacion')->with(array('nodo' => $nodo,
													 'a' => $actuadores,
													 'p' => $posiciones));
	}

	public function store(HabStoreFormRequest $request){
		//
		
		$nodo = new Nodo;
		$nodo->estancia = $request->get('estancia');
		$nodo->my = $request->get('my');
		$nodo->tipo_estancia = $request->get('tipo_estancia');
		$nodo->save();

		$actuadores = $request->get('actuador');
		$posiciones = $request->get('posicion');
		$checkbox = $request->get('checkbox');

		for($i = 0; $i < count($actuadores); $i++) {
			$actuador = new Actuador;
			$actuador->nombre = $actuadores[$i];
			$actuador->posicion = $posiciones[$i];
			$actuador->estado = 0;
			$actuador->principal = false;
			if(isset($checkbox[$i])){
				$actuador->principal = true;
			}
			$nodo->actuadores()->save($actuador);
		}
		
		

		return "";
	}

	public function edit($id){
		//
		$nodo = Nodo::find($id);
		$actuadores = $nodo->actuadores()->getResults();

		
		return view('config.habitacionEdit')->with(array('nodo' => $nodo,
													 'a' => $actuadores));
		
	}

	public function update(HabStoreFormRequest $request){

		$nodo = Nodo::find($request->get('nodo_id'));
		$nodo->estancia = $request->get('estancia');
		$nodo->my = $request->get('my');
		$nodo->tipo_estancia = $request->get('tipo_estancia');
		$nodo->save();

		$actuadores = $request->get('actuador');
		$posiciones = $request->get('posicion');
		$checkbox = $request->get('checkbox');

		for($i = 0; $i < count($actuadores); $i++) {
			$actuador = new Actuador;
			$actuador->nombre = $actuadores[$i];
			$actuador->posicion = $posiciones[$i];
			$actuador->estado = 0;
			$actuador->principal = false;
			if(isset($checkbox[$i])){
				$actuador->principal = true;
			}
			$nodo->actuadores()->save($actuador);
		}

		return redirect('configuracion/habitacion/'.$nodo->id);


	}

	public function borrarActuador($id, $n_id){
		$actuador = Actuador::find($id);
		$actuador->delete();
		return redirect('configuracion/habitacion/'.$n_id);
	}

	

}

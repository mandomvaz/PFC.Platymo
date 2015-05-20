<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Http\Requests\HabStoreFormRequest;


use App\Nodo;
use App\Actuador;
use App\Sensor;
use \Session;


class HabitacionController extends Controller {

	public function create(){
		//
		
		$actuadores = old('actuador');
		$posiciones = old('posicion');
		
		$nodo = new Nodo;
		return view('config.habitacion')->with(array('nodo' => $nodo,
													 'a' => $actuadores,
													 'p' => $posiciones,
													 'title' => 'Nueva habitación'));
	}

	public function store(HabStoreFormRequest $request){
		//
		
		$nodo = new Nodo;
		$nodo->estancia = $request->get('estancia');
		$nodo->my = $request->get('my');
		$nodo->save();

		$nombre_act = $request->get('actuador');
		$pos_act = $request->get('posicion');
		$ppl_act  = false;
		if($request->exists('principal')){
			$ppl_act = true;
		}

		$actuador = new Actuador;
		$actuador->nombre = $nombre_act;
		$actuador->posicion = $pos_act;
		$actuador->principal = $ppl_act;

		$nodo->actuadores()->save($actuador);

		if($request->exists('addAct')){
			return redirect('configuracion/habitacion/'.$nodo->id);
		}else{
			Session::flash('msg', 'Habitacion añadida.'.$request->get('addAct'));
			return redirect('configuracion');
		}
	}

	public function edit($id){
		//
		$nodo = Nodo::find($id);
		$actuadores = $nodo->actuadores()->getResults();

		
		return view('config.habitacionEdit')->with(array('nodo' => $nodo,
													 'a' => $actuadores,
													 'title' => 'Configuración '.$nodo->estancia));
		
	}

	public function update(HabStoreFormRequest $request){

		$nodo = Nodo::find($request->get('nodo_id'));
		$nodo->estancia = $request->get('estancia');
		$nodo->my = $request->get('my');
		$nodo->save();

		$nombre_act = $request->get('actuador');
		$pos_act = $request->get('posicion');
		$ppl_act  = false;
		if($request->exists('principal')){
			$ppl_act = true;
		}

		$actuador = new Actuador;
		$actuador->nombre = $nombre_act;
		$actuador->posicion = $pos_act;
		$actuador->principal = $ppl_act;

		$nodo->actuadores()->save($actuador);

		if($request->exists('addAct')){
			return HabitacionController::edit($nodo->id);
		}else{

			Session::flash('msg', 'Habitacion modificada.');
			return redirect('configuracion');
		}

	}

	public function delete($id){

		$nodo = Nodo::find($id);
		$nodo->delete();

		Session::flash('msg', 'Habitacion borrada.');
		return redirect('configuracion');
	}

	public function borrarActuador($id, $n_id){
		$actuador = Actuador::find($id);
		$actuador->delete();
		return redirect('configuracion/habitacion/'.$n_id);
	}

	

}

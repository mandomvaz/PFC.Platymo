<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\EscStoreFormRequest;

use Illuminate\Http\Request;

use App\Nodo;
use App\Actuador;
use App\Escena;
use \DB;
use \Session;

class EscenaController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($hab_id)
	{
		//
		$habitacion = Nodo::find($hab_id);
		$actuadores = $habitacion->actuadores()->get();
		return view('config.escena')->with(array('habitacion' => $habitacion,
												 'actuadores' => $actuadores));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(EscStoreFormRequest $request)
	{
		//
		
		$nodo = Nodo::find($request->get('hab_id'));

		$escena = new Escena;
		$escena->nombre = $request->get('nombre');

		$nodo->escenas()->save($escena);

		foreach ($nodo->actuadores()->get() as $actuador) {
			if($request->exists($actuador->id)){
				$escena->actuadores()->attach($actuador->id, ['estado' => 1]);
			}else{
				$escena->actuadores()->attach($actuador->id, ['estado' => 0]);
			}
		}


		Session::flash('msg', 'Escena añadida.');
		return redirect('configuracion');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		$escena = Escena::find($id);

		$habitacion = Nodo::find($escena->nodo()->first()->id);
		$actuadores = $habitacion->actuadores()->get();
		$query = DB::table('actuador_escena')->where('escena_id', $escena->id)->get();
		$act_estado = array();
		$i = 0;
		foreach ($actuadores as $actuador) {
			$act_estado[$i] = array();
			$act_estado[$i]['id_actuador'] = $actuador->id;
			$act_estado[$i]['nombre'] = $actuador->nombre;
			$act_estado[$i]['estado'] = 0;
			
			foreach ($query as $row) {
				
				if($actuador->id == $row->actuador_id){
					$act_estado[$i]['estado'] = $row->estado;
				}
			}
			$i++;
		}

		return view('config.escenaEdit')->with(array('habitacion' => $habitacion,
												 'act_estado' => $act_estado,
												 'escena' => $escena));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EscStoreFormRequest $request)
	{
		
		$escena = Escena::find($request->get('esc_id'));
		$escena->nombre = $request->get('nombre');
		$escena->save();

		$data_sync = array();

		foreach (Nodo::find($escena->nodo_id)->actuadores()->get() as $actuador) {
			if($request->exists($actuador->id)){
				$data_sync[$actuador->id] = ['estado' => 1];
			}else{
				$data_sync[$actuador->id] = ['estado' => 0];
			}
		}

		$escena->actuadores()->sync($data_sync);

		Session::flash('msg', 'Escena modificada.');
		return redirect('configuracion');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		
		$escena = Escena::find($id);
		$escena->delete();

		Session::flash('msg', 'Escena borrada.');
		return redirect('configuracion');
	}

}

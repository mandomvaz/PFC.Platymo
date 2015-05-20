<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Nodo;
use App\Accion;
use App\Actuador;
use \DB;
use App\Library\PythonComm;

class AccionController extends Controller {


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($hab_id)
	{
		$habitacion = Nodo::find($hab_id);
		$actuadores = $habitacion->actuadores()->get();

		return view('config.accion')->with(array( 'habitacion' => $habitacion,
												  'actuadores' => $actuadores,
												  'title' => 'Nueva acción'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
		$accion = new Accion;

		$accion->nombre = $request->get('nombre');
		$accion->hora = $request->get('hora');
		$accion->estado = $request->get('estado');

		$actuador = Actuador::find($request->get('actuador'));
		$actuador->acciones()->save($accion);

		if($request->exists('dia_sem')){
			foreach ($request->get('dia_sem') as $key => $value) {
				DB::table('acciones_dias')->insert(['dia_sem' => $key, 'accion_id' => $accion->id]);
			}
		}

		//PythonComm::envia(['peticion' => 'actualizarTimers']);
		return redirect('configuracion')->with(['msg' => 'Acción creada.']);

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
		$accion = Accion::find($id);

		$actuador = $accion->actuador()->first();

		$habitacion = $actuador->nodo()->first();

		$dia_sem = array();
		$dias = DB::table('acciones_dias')->where('accion_id', $accion->id)->get();

		foreach($dias as $dia){
			$dia_sem[$dia->dia_sem] = 'on';
		}

		return view('config.accionEdit')->with(array( 'habitacion' => $habitacion,
												  'actuador' => $actuador,
												  'accion' => $accion,
												  'dia_sem' => $dia_sem,
												  'title' => $accion->nombre));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		//
		$accion = Accion::find($request->get('acc_id'));

		$accion->nombre = $request->get('nombre');
		$accion->hora = $request->get('hora');
		$accion->estado = $request->get('estado');

		$accion->save();

		DB::table('acciones_dias')->where('accion_id', $accion->id)->delete();

		if($request->exists('dia_sem')){
			foreach ($request->get('dia_sem') as $key => $value) {
				DB::table('acciones_dias')->insert(['dia_sem' => $key, 'accion_id' => $accion->id]);
			}
		}
		//PythonComm::envia(['peticion' => 'actualizarTimers']);
		return redirect('configuracion')->with(['msg' => 'Acción modificada.']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$accion = Accion::find($id);
		$accion->delete();

		return redirect('configuracion')->with(['msg' => 'Acción borrada.']);
	}

}

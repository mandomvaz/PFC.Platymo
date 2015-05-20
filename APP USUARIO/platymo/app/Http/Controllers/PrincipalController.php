<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Nodo;
use App\Actuador;
use \Session;
use App\Accion;
use App\Escena;

class PrincipalController extends Controller {

	public function home(){

		$habitaciones = Nodo::all();
		$array_panel = array();
		$i = 0;
		foreach ($habitaciones as $habitacion) {
			$array_panel[$i] = array();
			$array_panel[$i]['habitacion'] = $habitacion;
			$array_panel[$i]['actuadores'] = array();
			$j = 0;
			foreach ($habitacion->actuadores()->where('principal', 1)->get() as $act) {
				$array_panel[$i]['actuadores'][$j] = $act;
				$j++;
			}
			$i++;
		}
		$escenas = Escena::all();
		$acciones = Accion::all();



		return view('home.principal')->with(array('panel' => $array_panel,
												  'escenas' => $escenas,
												  'acciones' => $acciones,
												  'title' => ''));
	}

	public function configuracion(){

		$habitaciones = Nodo::all();
		$array_panel = array();
		$i = 0;
		foreach ($habitaciones as $habitacion) {
			$array_panel[$i] = array();
			$array_panel[$i]['habitacion'] = $habitacion;
			$array_panel[$i]['escenas'] = array();
			$array_panel[$i]['acciones'] = array();
			$array_panel[$i]['actuadores'] = array();
			$j = 0;
			foreach ($habitacion->escenas()->get() as $escena) {
				$array_panel[$i]['escenas'][$j] = $escena;
				$j++;
			}
			$j = 0;
			$k = 0;
			foreach ($habitacion->actuadores()->get() as $actuador) {
				$array_panel[$i]['actuadores'][$k] = $actuador;
				$k++;
				foreach ($actuador->acciones()->get() as $accion) {
					$array_panel[$i]['acciones'][$j] = $accion;
					$j++;
				}
			}
			$i++;
		}

		Session::reflash();
		return view('config.panelConfiguracion')->with(array('panel' => $array_panel,
															 'title' => 'Configuración'));
	}

	public function vista($id){

		$habitacion = Nodo::find($id);

		$actuadores = $habitacion->actuadores()->get();
		$escenas = $habitacion->escenas()->get();
		$acciones = array();

		$i = 0;
		foreach ($actuadores as $actuador) {
			foreach ($actuador->acciones()->get() as $accion) {
				$acciones[$i] = array();
				$acciones[$i]['accion'] = $accion;
				$acciones[$i]['actuador'] = $actuador->nombre;
				$i++;
			}
		}

		return view('home.vista')->with(['habitacion' => $habitacion, 
										 'escenas' => $escenas, 
										 'acciones' => $acciones, 
										 'actuadores' => $actuadores,
										 'title' => $habitacion->estancia]);
	}

}

<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Nodo;
use App\Actuador;

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



		return view('home.principal')->with(array('panel' => $array_panel));
	}

	public function configuracion(){

		$habitaciones = Nodo::all();
		$array_panel = array();
		$i = 0;
		foreach ($habitaciones as $habitacion) {
			$array_panel[$i] = array();
			$array_panel[$i]['habitacion'] = $habitacion;
			$array_panel[$i]['actuadores'] = array();
			$j = 0;
			foreach ($habitacion->escenas()->get() as $escena) {
				$array_panel[$i]['escenas'][$j] = $escena;
				$j++;
			}
			$j = 0;
			foreach ($habitacion->actuadores()->get() as $actuador) {
				foreach ($actuador->acciones()->get() as $accion) {
					$array_panel[$i]['accion'][$j] = $accion;
					$j++;
				}
			}
			$i++;
		}


		return view('config.panelConfiguracion')->with('panel' => $array_panel);
	}

}

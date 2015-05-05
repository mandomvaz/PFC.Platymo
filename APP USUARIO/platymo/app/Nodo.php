<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Nodo extends Model {

	//

	protected $table = 'nodos';

	public function sensores(){
		return $this->hasMany('App\Sensor');
	}

	public function actuadores(){
		return $this->hasMany('App\Actuador');
	}

	public function escenas(){
		return $this->hasMany('App\Escena');
	}

}

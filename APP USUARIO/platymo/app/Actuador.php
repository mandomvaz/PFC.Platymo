<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Actuador extends Model {

	//
	protected $table = 'actuadores';

	public function nodo(){
		return $this->belongsTo('App\Nodo');
	}

	public function acciones(){
		return $this->hasMany('App\Accion');
	}

	public function escenas(){
		return $this->belongsToMany('App\Escena');
	}

}

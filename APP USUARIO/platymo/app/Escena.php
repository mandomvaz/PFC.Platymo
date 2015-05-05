<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Escena extends Model {

	//

	protected $table = 'escenas';

	public function nodo(){
		return $this->belongsTo('App\Nodo');
	}

	public function actuadores(){
		return $this->belongsToMany('App\Actuador');
	}
}

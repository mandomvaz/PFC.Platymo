<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Accion extends Model {

	//
	
	protected $table = 'acciones';

	public function actuador(){
		return $this->belongsTo('App\Actuador');
	}

}

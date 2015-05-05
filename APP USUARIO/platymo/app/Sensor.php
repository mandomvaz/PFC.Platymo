<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model {

	//

	protected $table = 'sensores';

	public function nodo(){
		return $this->belongsTo('App\Nodo');
	}
}

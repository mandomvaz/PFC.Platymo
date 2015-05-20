<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class HabStoreFormRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = array( 
			'my' => 'required|alpha_num|min:2|max:2',
			'estancia' => 'required|string|max:50',
			'actuador' => 'required|string|max:50',
			'posicion' => 'required|numeric'
		);
		
		

		return $rules;
	}

	public function messages(){

		return [
					'required' => 'El campo :attribute es obligatorio.',
					'alpha_num' => 'Solo se permiten caracteres alfanuméricos en el campo :attribute.',
					'tipo_estancia.in' => 'El campo :attribute solo puede ser uno de los que figuran.',
					'max:50' => 'El campo :attribute puede tener como máximo 50 caracteres.',
					'my.max:2' => 'El campo :attribute puede tener como máximo 2 caracteres.',
					'my.max:2' => 'El campo :attribute debe tener como mínimo 2 caracteres.',
					'numeric' => 'El campo :attribute solo puede contener números.',
				];
	}

}

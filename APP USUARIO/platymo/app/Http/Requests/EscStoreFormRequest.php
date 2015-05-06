<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class EscStoreFormRequest extends Request {

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
			'nombre' => 'required|alpha_num|max:50'
			);

		return $rules;
	}

	public function messages(){

		return [
				'required' => 'El campo :attribute es obligatorio.',
				'alpha_num' => 'Solo se permiten caracteres alfanuméricos en el campo :attribute.',
				'max:50' => 'El campo :attribute puede tener como máximo 50 caracteres.'
				];
	}

}

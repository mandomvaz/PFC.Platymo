function addActuador(){
		var gract = document.getElementById('grupo_actuadores');
		var num_act = document.getElementById('num_act');
		var i = num_act.value;

		var input_nombre = document.createElement('input');
		input_nombre.type = 'text';
		input_nombre.name = 'actuador['+i+']';
		input_nombre.setAttribute('required', '');
		input_nombre.setAttribute('class', 'form-control');

		var label_nombre = document.createElement('label');
		label_nombre.setAttribute('for', input_nombre.name);
		label_nombre.innerHTML = 'Nombre'



		var input_posicion = document.createElement('input');
		input_posicion.type = 'text';
		input_posicion.name = 'posicion['+i+']';
		input_posicion.setAttribute('required', '');
		input_posicion.setAttribute('class', 'form-control');

		var label_posicion = document.createElement('label');
		label_posicion.setAttribute('for', input_posicion.name);
		label_posicion.innerHTML = 'Posicion'

		var div_ch = document.createElement('div');
		div_ch.class = 'checkbox';

		var label_ch = document.createElement('label');
		label_ch.innerHTML = '<input type="checkbox" name="checkbox['+i+']"> Principal';

		gract.insertBefore(label_nombre, document.getElementById('addbtn'));
		gract.insertBefore(input_nombre, document.getElementById('addbtn'));

		gract.insertBefore(label_posicion, document.getElementById('addbtn'));
		gract.insertBefore(input_posicion, document.getElementById('addbtn'));

		
		div_ch.appendChild(label_ch);
		gract.insertBefore(div_ch, document.getElementById('addbtn'));


		


		i++;
		num_act.value = i;

	}
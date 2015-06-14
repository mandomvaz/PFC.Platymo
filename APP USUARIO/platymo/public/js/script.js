function addActuador(){
		var formulario = document.getElementById('form_hab');

		var input_hidden  = document.createElement('input');
		input_hidden.type = 'hidden';
		input_hidden.name = 'addAct';

		formulario.appendChild(input_hidden);

		formulario.submit();
}

function addCampos(){
	var formulario = document.getElementById('form_hab');

	var input_hidden  = document.createElement('input');
	input_hidden.type = 'hidden';
	input_hidden.name = 'addAct';

	formulario.appendChild(input_hidden);

	var formgroup = document.getElementById('form-group-add');

	var label_nombre = document.createElement('label');
	var label_pos = document.createElement('label');
	var label_check = document.createElement('label');

	var input_nombre  = document.createElement('input');
	var input_pos  = document.createElement('input');
	var input_check  = document.createElement('input');

	label_nombre.setAttribute('class', 'control-label');
	label_nombre.setAttribute('for', 'actuador');
	label_nombre.innerHTML = 'Nombre';

	label_pos.setAttribute('class', 'control-label');
	label_pos.setAttribute('for', 'posicion');
	label_pos.innerHTML = 'Posición';

	input_nombre.setAttribute('class', 'form-control');
	input_nombre.setAttribute('type', 'text');
	input_nombre.setAttribute('name', 'actuador');
	input_nombre.setAttribute('maxlength', '50');
	input_nombre.setAttribute('required', '');

	input_pos.setAttribute('class', 'form-control');
	input_pos.setAttribute('type', 'text');
	input_pos.setAttribute('name', 'posicion');
	input_pos.setAttribute('required', '');

	input_check.setAttribute('class', '');
	input_check.setAttribute('type', 'checkbox');
	input_check.setAttribute('name', 'principal');

	label_check.appendChild(input_check);
	var span = document.createElement('span');
	span.innerHTML = 'Añadir a Panel Principal';
	label_check.appendChild(span);

	var div_check = document.createElement('div');
	div_check.setAttribute('class', 'checkbox');
	div_check.appendChild(label_check);

	var btn = document.getElementById('addbtn');
	btn.setAttribute('onclick', 'addActuador()');
	
	var gliph = document.getElementById('gliph-btn');
	gliph.setAttribute('class', 'glyphicon glyphicon-floppy-disk');

	formgroup.removeChild(btn);
	formgroup.appendChild(label_nombre);
	formgroup.appendChild(input_nombre);
	formgroup.appendChild(label_pos);
	formgroup.appendChild(input_pos);
	formgroup.appendChild(div_check);
	formgroup.appendChild(btn);
}

function retConfig(){
	var formulario = document.getElementById('form_hab');

	var input_hidden  = document.createElement('input');
	input_hidden.type = 'hidden';
	input_hidden.name = 'retconfig';

	formulario.appendChild(input_hidden);

	formulario.submit();
}
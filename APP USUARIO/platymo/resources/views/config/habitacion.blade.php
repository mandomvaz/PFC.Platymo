@extends('layout.master')

@section('content')
<div class="row">
<div class="panel panel-default">
	<div class="panel-heading">
		<span class="h4-blanco">Nueva habitación</span>
	</div>
	<div class="panel-body">


@if(count($errors->all()) > 0 )
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
	{!! Form::open(array('url' => 'configuracion/habitacion/store', 'class' => 'form form-horizontal', 'id' => 'form_hab') ) !!}
	<div class="form-group">
		<label class="control-label col-md-2 col-md-offset-2" for="my">MY del nodo:</label>
		<div class="col-md-2">
			<input class="form-control" type="text" name="my" id="my" maxlength="2" required value="{{ old('my') }}"/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2 col-md-offset-2" for="nombre">Nombre de la habitacion</label>
		<div class="col-md-6">
			<input class="form-control" type="text" name="estancia" id="nombre" maxlength="50" required value="{{ old('estancia') }}"/>
		</div>
	</div>
	<label class="control-label col-md-2 col-md-offset-2">Actuadores</label>
	<div class="form-group" id="grupo_actuadores">
		<div class="col-md-6">
			<label for="actuador">Nombre</label>
			<input class="form-control" type="text" name="actuador"  maxlength="50" required value=""/>
			<label for="posicion">Posicion</label>
			<input class="form-control" type="text" name="posicion"  required value=""/>
			<div class="checkbox">
				<label>
						<input type="checkbox" name="principal"> Añadir a Panel Principal
				</label>
			</div>
			<a href="#" class="btn btn-default" onclick="addActuador();" id="addbtn">
				<span class="glyphicon glyphicon-floppy-disk"></span>
			</a>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6 col-md-offset-4">
			{!! Form::submit('Crear', array('class' => 'btn btn-primary')) !!}
			{!! Form::close() !!}
		</div>
	</div>
</div>
</div>
@stop
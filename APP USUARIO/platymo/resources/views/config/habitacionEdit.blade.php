@extends('layout.master')

@section('content')
<div class="row">
	<div class="panel panel-default">
	<div class="panel-heading">
		<span class="h4-blanco">{{ $nodo->estancia }}</span>
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
	{!! Form::open(array('url' => 'configuracion/habitacion/update', 'class' => 'form form-horizontal', 'id' => 'form_hab') ) !!}
	<input type="text" hidden name="nodo_id" value="{{ $nodo->id }}">
	<div class="form-group">
		<label class="control-label col-md-2 col-md-offset-2" for="my">MY del nodo:</label>
		<div class="col-md-2">
			<input class="form-control" type="text" name="my" id="my" maxlength="2" required value="{{ $nodo->my }}"/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2 col-md-offset-2" for="nombre">Nombre de la habitacion</label>
		<div class="col-md-6">
			<input class="form-control" type="text" name="estancia" id="nombre" maxlength="50" required value="{{ $nodo->estancia }}"/>
		</div>
	</div>
	<label class="control-label col-md-2 col-md-offset-2">Actuadores</label>
	<div class="form-group" id="grupo_actuadores">
		<div class="col-md-6">
			@foreach($a as $actuador)
			<div class="input-group">
				<a class="input-group-addon" href="/configuracion/actuador/delete/{{ $actuador->id }}/{{ $nodo->id }}">
				<span class="glyphicon glyphicon-remove-circle"></span>
				</a>
				<input type="text" disabled class="form-control" value="{{ $actuador->nombre }}">
				<span class="input-group-addon">Posicion {{ $actuador->posicion }}</span>
				<span class="input-group-addon">Principal 
				@if($actuador->principal)
					<span class="glyphicon glyphicon-ok"></span>
				@else
					<span class="glyphicon glyphicon-minus"></span>
				@endif
				</span>
			</div>
			@endforeach
			<div class="form-group" id="form-group-add">
				<a href="#" class="btn btn-default" onclick="addCampos()" id="addbtn">
					<span id="gliph-btn" class="glyphicon glyphicon-plus"></span>
				</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6 col-md-offset-4">
			{!! Form::submit('Guardar cambios', array('class' => 'btn btn-primary', 'onclick' => 'retConfig();')) !!}
		</div>
	</div>
	{!! Form::close() !!}
	</div>
</div>
</div>
@stop
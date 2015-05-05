@extends('layout.master')

@section('content')
<div class="row">
	<div class="panel panel-default">
	<div class="panel-heading">
		<h4>{{ $nodo->estancia }}</h4>
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
	{!! Form::open(array('url' => 'configuracion/habitacion/update', 'class' => 'form') ) !!}
	<input type="text" hidden name="nodo_id" value="{{ $nodo->id }}">
	<div class="form-group">
		<label for="my">MY del nodo:</label>
		<input class="form-control" type="text" name="my" id="my" maxlength="2" required value="{{ $nodo->my }}"/>
	</div>
	<div class="form-group">
		<label for="nombre">Nombre de la habitacion</label>
		<input class="form-control" type="text" name="estancia" id="nombre" maxlength="50" required value="{{ $nodo->estancia }}"/>
	</div>
	<div class="form-group">
		<label>Tipo de estancia</label>
		<div class="radio">
			<label>
				<input type="radio" name="tipo_estancia" id="radio_tipo_1" value="dormitorio" {!! ('dormitorio' == $nodo->tipo_estancia? 'checked':'') !!}>Dormitorio.						
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="tipo_estancia" id="radio_tipo_2" value="sala_estar" {!! ('sala_estar' == $nodo->tipo_estancia? 'checked':'') !!}>Sala de estar.						
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="tipo_estancia" id="radio_tipo_3" value="cocina" {!! ('cocina' == $nodo->tipo_estancia? 'checked':'') !!}>Cocina						
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="tipo_estancia" id="radio_tipo_4" value="baño" {!! ('baño' == $nodo->tipo_estancia? 'checked':'') !!}>Baño						
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="tipo_estancia" id="radio_tipo_5" value="zona_paso" {!! ('zona_paso' == $nodo->tipo_estancia? 'checked':'') !!}>Pasillo						
			</label>
		</div>
	</div>
	<div class="form-group" id="grupo_actuadores">
		<label>Actuadores</label>
		<input type="hidden" id="num_act" value="0">

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
		
		<a href="#" class="btn btn-default" onclick="addActuador();" id="addbtn">
			<span class="glyphicon glyphicon-plus"></span>
		</a>
	</div>
	{!! Form::submit('Modificar', array('class' => 'btn btn-primary')) !!}
	{!! Form::close() !!}
	</div>
</div>
</div>
@stop
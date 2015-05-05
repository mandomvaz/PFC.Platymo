@extends('layout.master')

@section('content')
<div class="row">
<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Nueva habitación</h3>
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
	{!! Form::open(array('url' => 'configuracion/habitacion/store', 'class' => 'form') ) !!}
	<div class="form-group">
		<label for="my">MY del nodo:</label>
		<input class="form-control" type="text" name="my" id="my" maxlength="2" required value="{{ old('my') }}"/>
	</div>
	<div class="form-group">
		<label for="nombre">Nombre de la habitacion</label>
		<input class="form-control" type="text" name="estancia" id="nombre" maxlength="50" required value="{{ old('estancia') }}"/>
	</div>
	<div class="form-group">
		<label>Tipo de estancia</label>
		<div class="radio">
			<label>
				<input type="radio" name="tipo_estancia" id="radio_tipo_1" value="dormitorio" {!! ('dormitorio' == old('tipo_estancia')? 'checked':'') !!}>Dormitorio.						
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="tipo_estancia" id="radio_tipo_2" value="sala_estar" {!! ('sala_estar' == old('tipo_estancia')? 'checked':'') !!}>Sala de estar.						
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="tipo_estancia" id="radio_tipo_3" value="cocina" {!! ('cocina' == old('tipo_estancia')? 'checked':'') !!}>Cocina						
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="tipo_estancia" id="radio_tipo_4" value="baño" {!! ('baño' == old('tipo_estancia')? 'checked':'') !!}>Baño						
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="tipo_estancia" id="radio_tipo_5" value="zona_paso" {!! ('zona_paso' == old('tipo_estancia')? 'checked':'') !!}>Pasillo						
			</label>
		</div>
	</div>
	<span>Actuadores</span>
	<div class="form-group" id="grupo_actuadores">
		<input type="hidden" id="num_act" value="{{ count($a) }}">
		@if($a != NULL && $p != NULL)
			@for ($i = 0; $i < count($a); $i++) 
				<label for="actuador[{{ $i }}]">Nombre</label>
				<input class="form-control" type="text" name="actuador[{{ $i }}]"  maxlength="50" required value="{{ $a[$i] }}"/>
				<label for="posicion[{{ $i }}]">Posicion</label>
				<input class="form-control" type="text" name="posicion[{{ $i }}]"  required value="{{ $p[$i] }}"/>
				<div class="checkbox">
    				<label>
      					<input type="checkbox" name="checkbox[{{ $i }}]"> Principal
    				</label>
    			</div>

			@endfor
		@endif
		<a href="#" class="btn btn-default" onclick="addActuador();" id="addbtn">
			<span class="glyphicon glyphicon-plus"></span>
		</a>
	</div>
	{!! Form::submit('Crear', array('class' => 'btn btn-primary')) !!}
	{!! Form::close() !!}
	</div>
</div>
</div>
@stop
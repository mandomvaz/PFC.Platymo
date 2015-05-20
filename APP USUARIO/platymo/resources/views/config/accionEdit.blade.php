@extends('layout.master')
@section('content')
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="h4-blanco">{{ $accion->nombre }} de {{ $actuador->nombre }} en {{ $habitacion->estancia }}</span>
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
				{!! Form::open(array('url' => 'configuracion/accion/update', 'class' => 'form form-horizontal') ) !!}
				<input type="hidden" name="acc_id" value="{{ $accion->id }}">
				<div class="form-group">
					<label class="control-label col-md-2 col-md-offset-2">Nombre</label>
					<div class="col-md-6">
						<input class="form-control" type="text" name="nombre" required maxlength="50" value="{{ $accion->nombre }}"></input>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-md-offset-2">Actuador</label>
					<div class="col-md-6">
						<input class="form-control disabled" disabled value="{{ $actuador->nombre }}"></input>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-md-offset-2">Días de la semana</label>
					<div class="col-md-6">
						<div class="checkbox">
					        <label>
					        	<input type="checkbox" name="dia_sem[0]" {!! (array_key_exists(0, $dia_sem))? "checked" : "" !!}> Lunes
					        </label>
					        <label>
					        	<input type="checkbox" name="dia_sem[1]" {!! (array_key_exists(1, $dia_sem))? "checked" : "" !!}> Martes
					        </label>
					        <label>
					        	<input type="checkbox" name="dia_sem[2]" {!! (array_key_exists(2, $dia_sem))? "checked" : "" !!}> Miercoles
					        </label>
					        <label>
					        	<input type="checkbox" name="dia_sem[3]" {!! (array_key_exists(3, $dia_sem))? "checked" : "" !!}> Jueves
					        </label>
					        <label>
					        	<input type="checkbox" name="dia_sem[4]" {!! (array_key_exists(4, $dia_sem))? "checked" : "" !!}> Viernes
					        </label>
					        <label>
					        	<input type="checkbox" name="dia_sem[5]" {!! (array_key_exists(5, $dia_sem))? "checked" : "" !!}> Sábado
					        </label>
					        <label>
					        	<input type="checkbox" name="dia_sem[6]" {!! (array_key_exists(6, $dia_sem))? "checked" : "" !!}> Domingo
					        </label>
        				</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-md-offset-2">Hora</label>
					<div class="col-md-2">
						<input class="form-control" type="time" name="hora" value="{{ $accion->hora }}"></input>		
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 col-md-offset-2 control-label">Estado</label>
      				<div class="col-md-2">
				        <div class="radio">
				          	<label>
				            	<input type="radio" name="estado"  value="1" {{ ($accion->estado != 0)? 'checked' : '' }}>
				            	Encendido
				        	</label>
				        	<label>
				            	<input type="radio" name="estado" value="0"  {{ ($accion->estado != 0)? '' : 'checked' }}>
				            	Apagado
				          </label>
				        </div>
      				</div>
				</div>
				<div class="form-group">
					<div class="col-md-10 col-md-offset-4">
						{!! Form::submit('Modificar', array('class' => 'btn btn-primary')) !!}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
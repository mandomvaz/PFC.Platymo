@extends('layout.master')
@section('content')
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="h4-blanco">Nueva Acción periódica en {{ $habitacion->estancia }}</span>
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
				{!! Form::open(array('url' => 'configuracion/accion/store', 'class' => 'form form-horizontal') ) !!}
				<input type="hidden" name="hab_id" value="{{ $habitacion->id }}">
				<div class="form-group">
					<label class="control-label col-md-2 col-md-offset-2">Nombre</label>
					<div class="col-md-6">
						<input class="form-control" type="text" name="nombre" required maxlength="50" value=""></input>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-md-offset-2">Actuador</label>
					<div class="col-md-6">
						<select class="form-control" name="actuador">
							@foreach ($actuadores as $actuador) 
								<option value="{{ $actuador->id }}">{{ $actuador->nombre }}</option>
							@endforeach	
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-md-offset-2">Días de la semana</label>
					<div class="col-md-6">
						<div class="checkbox">
					        <label>
					        	<input type="checkbox" name="dia_sem[0]"> Lunes
					        </label>
					        <label>
					        	<input type="checkbox" name="dia_sem[1]"> Martes
					        </label>
					        <label>
					        	<input type="checkbox" name="dia_sem[2]"> Miercoles
					        </label>
					        <label>
					        	<input type="checkbox" name="dia_sem[3]"> Jueves
					        </label>
					        <label>
					        	<input type="checkbox" name="dia_sem[4]"> Viernes
					        </label>
					        <label>
					        	<input type="checkbox" name="dia_sem[5]"> Sábado
					        </label>
					        <label>
					        	<input type="checkbox" name="dia_sem[6]"> Domingo
					        </label>
        				</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-md-offset-2">Hora</label>
					<div class="col-md-2">
						<input class="form-control" type="time" name="hora"></input>		
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 col-md-offset-2 control-label">Estado</label>
      				<div class="col-md-6">
				        <div class="radio">
				          	<label>
				            	<input type="radio" name="estado"  value="1">
				            	Encendido
				        	</label>
				        	<label>
				            	<input type="radio" name="estado" value="0">
				            	Apagado
				          </label>
				        </div>
      				</div>
				</div>
				<div class="form-group">
					<div class="col-md-10 col-md-offset-4">
						{!! Form::submit('Crear', array('class' => 'btn btn-primary')) !!}
						{!! Form::close() !!}
					</div>
				</div>








			</div>
		</div>
	</div>
@stop
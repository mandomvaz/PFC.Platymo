@extends('layout.master')
@section('content')
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3>Nueva Escena en {{ $habitacion->estancia }}</h3>
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
				{!! Form::open(array('url' => 'configuracion/escena/store', 'class' => 'form form-horizontal') ) !!}
				<input type="hidden" name="hab_id" value="{{ $habitacion->id }}">
				<div class="form-group">
					<label class="control-label col-md-2">Nombre</label>
					<div class="col-md-10">
						<input class="form-control" type="text" name="nombre" required maxlength="50" value=""></input>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2">Actuadores</label>
					<div class=" col-md-10">
						@foreach($actuadores as $actuador)
							<div class="checkbox">
			    				<label>
			      					<input type="checkbox" name="{{ $actuador['id_actuador'] }}"> {{ $actuador['nombre'] }}
			    				</label>
	    					</div>
						@endforeach
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-10 col-md-offset-2">
						{!! Form::submit('Crear', array('class' => 'btn btn-primary')) !!}
						{!! Form::close() !!}
					</div>
				</div>








			</div>
		</div>
	</div>





	
@stop
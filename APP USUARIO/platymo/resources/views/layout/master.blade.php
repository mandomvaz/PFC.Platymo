<!DOCTYPE html>
<html>
<head>
	<title>Platy.mo{{ ' - '.$title or '' }}</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.4/paper/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/estilo.css">
</head>
<body>
	<div class="container-fluid banner">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<h1 class="clearfix"><a class="" href="/">Platy.Mo</a> {!! '<small>'.$title.'</small>'!!}</h1>
				</div>
				<div class="col-md-2">
					<a href="/configuracion" class="btn btn-link configuracion">Configuración</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		@yield('content')
	</div>
	<script type="text/javascript" src="{!! URL::asset('js/script.js'); !!}"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>
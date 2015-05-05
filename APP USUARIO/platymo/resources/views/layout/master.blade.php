<!DOCTYPE html>
<html>
<head>
	<title>Platy.mo</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.4/paper/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1>Platy.Mo</h1>
		</div>
	</div>
	<div class="container">
		@yield('content')
	</div>
	<script type="text/javascript" src="{!! URL::asset('js/script.js'); !!}"></script>
</body>
</html>
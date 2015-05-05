<?php namespace App\Library;

class PythonComm{


	public static function envia($data){
		
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		if ($socket === false) {
		    echo "socket_create() falló: razón: " . socket_strerror(socket_last_error()) . "\n";
		}

		$result = socket_connect($socket, 'localhost', '9999');
		if ($result === false) {
		    echo "socket_connect() falló.\nRazón: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
		} 

		
		$json = json_encode($data);
		
		socket_write($socket, $json, strlen($json));
		
		while ($out = socket_read($socket, 2048)) {
		    $out = json_decode($out);

		    echo $out;
		}
		
		
		socket_close($socket);
		
		}
}


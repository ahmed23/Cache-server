<?php
error_reporting(E_ALL);

class cacheServer{

	private $socket = null;
	private int $portNo = null;

	public function connect($ip, int $port){
		$portNo = $port;
		$address = gethostbyaddr($ip);
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

		if($socket === false){
			echo "socket_create() failed: reason: " . socket_strerror(socket_last_error());
		}

		$result = socket_connect($socket, $address, $service_port);
		if ($result === false) {
		    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket));
		} 
	}

	public function disconnect(){
		if(socket != null){
			socket_close($socket);
			$socket = null;
			echo "ok";
		}else{
			echo "Error: Not connected to a server."
		}
	}

	public function get($key){
		if($socket!=null){
			$msg = "get:".$key;
			socket_write($socket, $msg, strlen($msg));
			if($out = socket_read($socket, 4))
				echo $out;
		}
	}

	public function remove($key){
		if($socket!=null){
			removeAsync($key);
			if($out = socket_read($socket, 4))
				echo $out;
		}
	}

	public function removeAsync($key){
		if($socket!=null){
			$msg = "rm:" . $key;
			socket_write($socket, $msg, strlen($msg));
		}
	}

	public function add($object, $key){
		if($socket!=null){
			$msg = "ins:" . strlen($object)+strlen($key);
			socket_write($socket, $msg, strlen(msg));
			if($out = socket_read($socket, 4)){
				if($out != "ok"){
					echo $out; // break ?
				}else{
					$msg = strlen(key) . ":" . $key . ":" . $object;
					socket_write($socket, $msg, strlen($msg));
				}
			}
		}
	}

}


?>
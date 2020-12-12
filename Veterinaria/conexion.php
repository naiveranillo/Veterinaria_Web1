<?php

class conexion{
	
	private $lin;
	
	public function conectar(){
		$this->lin = mysqli_connect("localhost", "anillonaiver", "naiver3753313", "veterinaria");
		return $this->lin;
	}
	public function desconectar(){
		mysqli_close($this->lin);
	}
	
}
	


?>
<?php

class mascota{
	public function agregar($nombre, $raza, $cedula, $lin){
		$sql = "INSERT INTO mascota (nombre, raza, cedula_dueño) "."VALUES ('$nombre', '$raza', '$cedula')";
		$result = $lin->prepare($sql);
		$result->execute();
	}

	public function busqueda($cedula, $lin){
		$sql = "SELECT * FROM usuarios WHERE cedula = '$cedula'";
		$result = $lin->query($sql);
		$arr=array();
		while ($fila = $result->fetch_assoc()) {
			$arr[]=$fila;
		}
			return($arr);
	}

	public function lista($lin){
		$sql = "SELECT * FROM mascota";
		$result = $lin->query($sql);	
		$arr=array();
		while ($fila = $result->fetch_assoc()){
			$arr[]=$fila;
		}
		return($arr);
	}
}
?>
<?php
class usuario{
	public function agregar($n_completo, $cedula, $mail, $direccion, $telefono, $lin){
		$sql = "INSERT INTO usuarios (n_completo, cedula, mail, direccion, telefono) "."VALUES ('$n_completo', '$cedula', '$mail', '$direccion', '$telefono')";
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

	public function busquedamasc($cedula, $lin){
		$sql = "SELECT * FROM mascota WHERE cedula_dueño = '$cedula'";
		$result = $lin->query($sql);
		$arr=array();
		while ($fila = $result->fetch_assoc()) {
			$arr[]=$fila;
		}
			return($arr);
	}
	
	
	//ok
	public function eliminar ($cedula,$lin){
		$sql ="DELETE FROM usuarios WHERE cedula = '$cedula'";
		$result = $lin->prepare($sql);
		$result->execute();
	}
	
	//ok
	public function actualizar($n_completo, $cedula, $mail, $direccion, $telefono, $lin){
		$sql = "UPDATE usuarios SET n_completo = '$n_completo', cedula ='$cedula', mail = '$mail', direccion = '$direccion', telefono = '$telefono'".
			   "WHERE 	cedula = '$cedula'";
		$result = $lin->prepare($sql);
		$result->execute();
	}
	//ok
	public function lista($lin){
		$sql = "SELECT * FROM usuarios";
		$result = $lin->query($sql);	
		$arr=array();
		while ($fila = $result->fetch_assoc()){
			$arr[]=$fila;
		}
		return($arr);
	}
}
?>
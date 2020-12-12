<?php
class admin{

	public function agregar($p_nombre, $s_nombre, $p_apellido, $s_apellido, $cedula, $mail, $pass,$creador,$idcreador, $lin)
	{
		$sql = "INSERT INTO administrador (p_nombre, s_nombre, p_apellido, s_apellido, cedula, mail, password, creador, idcreador) "."VALUES ('$p_nombre', '$s_nombre', '$p_apellido', '$s_apellido', '$cedula', '$mail', '$pass','$creador', '$idcreador')";
		$result = $lin->prepare($sql);
		$result->execute();
	}

	public function busqueda($cedula,$lin)
	{
		$sql = "SELECT * FROM administrador WHERE cedula = '$cedula'";
		$result = $lin->query($sql);
		$arr=array();
		while ($fila = $result->fetch_assoc()) {
			$arr[]=$fila;
		}
			return($arr);
	}

	public function searchmail($mail,$lin)
	{
		$sql = "SELECT * FROM administrador WHERE mail = '$mail'";
		$result = $lin->query($sql);
		$arr=array();
		while ($fila = $result->fetch_assoc()) {
			$arr[]=$fila;
		}
			return($arr);
	}

	public function actualizar($p_nombre, $s_nombre, $p_apellido, $s_apellido, $cedula, $mail, $pass, $lin)
	{
		$sql = "UPDATE administrador SET p_nombre = '$p_nombre', s_nombre='$s_nombre', p_apellido = '$p_apellido', s_apellido = '$s_apellido', mail = '$mail', password = '$pass'".
			   "WHERE 	cedula = '$cedula'";
		$result = $lin->prepare($sql);
		$result->execute();
	}

	public function lista($creador,$cedcreador,$lin){
		$sql = "SELECT * FROM administrador WHERE idcreador = '$cedcreador' AND creador = '$creador'";
		$result = $lin->query($sql);	
		$arr=array();
		while ($fila = $result->fetch_assoc()){
			$arr[]=$fila;
		}
		return($arr);
	}

}



?>
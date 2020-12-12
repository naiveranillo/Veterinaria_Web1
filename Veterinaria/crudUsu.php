<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0"></meta>
</head>
<body>
	<div class="contenedor">
		<div class="contenido"><br>
			<div class="box box-shadow">
				<?php
if(!isset($_SESSION['Reg'])||$_SESSION['Reg']!='ok')header('Location: login.php');


	require_once("conexion.php");
	require_once("usuario.php");

	$con = new conexion();
	$usu = new usuario();

	if(isset($_SESSION['crearusu'])){
		if ($_SESSION['crearusu'] == "True") {
			?>
			<h1><center><b>Crear Usuario</center></h1></b><br>
			<form method="post" action="">
				<b>Nombre Completo: <input type="text" name="n_comp" placeholder="Ingrese nombre completo" class="form-control" required><br>
				Cedula: <input type="text" name="ced" placeholder="Ingrese cedula" class="form-control" required><br>
				Email: <input type="text" name="email" placeholder="Ingrese email" class="form-control" required><br>
				Direccion: <input type="text" name="dirr" placeholder="Ingrese direccion" class="form-control" required><br>
				Telefono: <input type="text" name="tel" placeholder="Ingrese telefono" class="form-control"required><br>
				<center><input type="submit" class="btn btn-dark" name="crearusu" value="Agregar Usuario"></center>
				<input type="hidden" name="mensaje" value="0">
			</form>
			<?php
			$_SESSION['crearusu'] = "False";
			$_SESSION['modusu'] = "False";
			$_SESSION['eliusu'] = "False";
			
		}
		
	}

	if (isset($_POST['crearusu'])) {
		$usu->agregar($_POST['n_comp'], $_POST['ced'], $_POST['email'], $_POST['dirr'], $_POST['tel'], $con->conectar());
		$con->desconectar();
		?>
		<br>
		<div  style="color: #24800E; border: 2px solid #24800E; border-radius: 10px; padding: 12px" class="alert alert-success" role="alert">
 			<b>Usuario Registrado Correctamente
		</div>
		<?php
	}

	if (isset($_SESSION['listusu'])) {
		if ($_SESSION['listusu'] == "True") {
			$arr=$usu->lista($con->conectar());
			$con->desconectar();
			if (empty($arr)) {
				?>
				<h1><center><b>Lista de Usuarios</center></h1></b><br>
					<br>
					<div class="alert alert-warning" style="color: #ADA226; border: 2px solid #ADA226; border-radius: 10px; padding: 12px" role="alert">
		  					<b>No hay Registros.
					</div>
				<?php
			}else{
				?>
				<link rel="stylesheet" type="text/css" href="style.css">
				<h1><center><b>Lista de Usuarios</center></h1></b><br>
					<center><table>
						<tr style="background: #8996E0;">
							<th><b>Nombre Completo</th><th><b>Cedula</th><th><b>Email</th><th><b>Direccion</th><th><b>Telefono</th>   
						</tr>
						<?php
						for ($i=0; $i <count($arr) ; $i++) { 
						?>
						<tr>
							<td>
								<?php echo $arr[$i]['n_completo']?>
							</td>
							<td>
								<?php echo $arr[$i]['cedula']?>
							</td>
							<td>
								<?php echo $arr[$i]['mail']?>
							</td>
							<td>
								<?php echo $arr[$i]['direccion']?>
							</td>
							<td>
								<?php echo $arr[$i]['telefono']?>
							</td>
						</tr>					
				<?php
			}
			?>
			</table></center><?php
			}		
			$_SESSION['listusu'] = "False";
			$_SESSION['modusu'] = "False";
			$_SESSION['eliusu'] = "False";
		}
	}

	if (isset($_POST['busqusu'])) {
		$arr2=$usu->busqueda($_POST['ced'],$con->conectar());

		if (!empty($arr2)) {
			$_SESSION['modusu'] = "False";
		}
		
	}

	if (isset($_SESSION['modusu'])) {
		if ($_SESSION['modusu'] == "True") { 
			?>
			<h1><center><b>Busqueda</center></h1></b><br>
				<form action="" method="post">
					<b>Cedula:<input type="text" name="ced" placeholder="Ingrese Cedula" class="form-control" required><br>
					<center><input type="submit" name="busqusu" class="btn btn-dark" value="Buscar"></center>
				</form>
			<?php
		}

			if (isset($arr2)) {
				if (empty($arr2)) {
					?>
						<br>
						<div class="alert alert-warning" style="color: #ADA226; border: 2px solid #ADA226; border-radius: 10px; padding: 12px" role="alert">
		  					<b>Esta cedula no existe, intente de nuevo.
						</div>
					<?php
				}
			}
	}


	if (!empty($arr2)) {
		?>
		<h1><center><b>Modificar/Eliminar Usuario</center></h1></b><br>
		<form method="post" action="">
				<b>Nombre Completo: <input type="text" name="n_comp" value="<?php echo $arr2[0]['n_completo'] ?>" class="form-control" required><br>
				Cedula: <input type="text" name="ced" readonly value="<?php echo $arr2[0]['cedula'] ?>" class="form-control" required><br>
				Email: <input type="text" name="email" value="<?php echo $arr2[0]['mail'] ?>" class="form-control" required><br>
				Direccion: <input type="text" name="dirr" value="<?php echo $arr2[0]['direccion'] ?>" class="form-control" required><br>
				Telefono: <input type="text" name="tel" value="<?php echo $arr2[0]['telefono'] ?>" class="form-control" required><br>
				<center><input type="submit" class="btn btn-dark" name="usumod" value="Modificar">
				<input type="submit" class="btn btn-dark" name="usueli" value="Eliminar"></center>
			</form>
		<?php

	}

	if (isset($_POST['usumod'])) {
		$usu->actualizar($_POST['n_comp'], $_POST['ced'], $_POST['email'], $_POST['dirr'], $_POST['tel'], $con->conectar());
		$con->desconectar();
		?>
		<br>
		<div  style="color: #24800E; border: 2px solid #24800E; border-radius: 10px; padding: 12px" class="alert alert-success" role="alert">
 			<b>El Registro ha sido Modificado
		</div>
		<?php
	}

	if (isset($_POST['usueli'])) {
		$arr3=$usu->busquedamasc($_POST['ced'],$con->conectar());

		if (empty($arr3)) {
			$usu->eliminar($_POST['ced'], $con->conectar());
			$con->desconectar();
			?>	
				<div class="alert alert-danger" style="color: #711414; border: 2px solid #711414; border-radius: 10px; padding: 12px" role="alert">
		 			<b>El Registro ha sido Eliminado.
				</div>
			<?php
		}else{
			?>
				<br>
				<div class="alert alert-warning" style="color: #ADA226; border: 2px solid #ADA226; border-radius: 10px; padding: 12px" role="alert">
  					<b>Registro no eliminado. Este usuario tiene mascotas registradas.
				</div>
			<?php
			$con->desconectar();
		}		
	}
?>
			</div>
		</div>
	</div>
</body>
</html>

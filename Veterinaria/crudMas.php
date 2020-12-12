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
	require_once("mascota.php");
	require_once("usuario.php");

	$con = new conexion();
	$mas = new mascota();
	$usu = new usuario();

	if(isset($_SESSION['crearmasc'])){
		if ($_SESSION['crearmasc'] == "True") {
			?>
			<h1><center><b>Crear Mascota</center></h1></b><br>
			<form method="post" action="">
				<b>Nombre: <input type="text" name="nombre" placeholder="Ingrese nombre" class="form-control" required><br>
				Raza: <input type="text" name="raza" placeholder="Ingrese raza" class="form-control" required><br>
				Cedula del Dueño: <input type="text" name="ced" placeholder="Ingrese cedula" class="form-control" required><br>
				<center><input type="submit" class="btn btn-dark" name="crearmasc" value="Agregar Mascota"></center>
			</form>
			<?php
			$_SESSION['crearmasc'] = "False";	
		}
	}

	if (isset($_POST['crearmasc'])) {

		$arr=$mas->busqueda($_POST['ced'],$con->conectar());
		
		if (!empty($arr)) {
			$mas->agregar($_POST['nombre'], $_POST['raza'], $_POST['ced'], $con->conectar());
			$con->desconectar();
			?>
				<br>
				<div  style="color: #24800E; border: 2px solid #24800E; border-radius: 10px; padding: 12px" class="alert alert-success" role="alert">
		 			<b>Mascota Registrada Correctamente
				</div>
			<?php
		}else{
			?>
				<br>
				<div class="alert alert-warning" style="color: #ADA226; border: 2px solid #ADA226; border-radius: 10px; padding: 12px" role="alert">
		  				<b>Registro cancelado, la cedula del dueño no esta registrado.
					</div>
			<?php
			$con->desconectar();
		}
	}

	if (isset($_SESSION['listmasc'])) {
		if ($_SESSION['listmasc'] == "True") {
			$arr2=$mas->lista($con->conectar());
			$con->desconectar();
			if (empty($arr2)) {
				?>
					<h1><center><b>Lista de Mascotas</center></h1></b><br>
					<br>
					<div class="alert alert-warning" style="color: #ADA226; border: 2px solid #ADA226; border-radius: 10px; padding: 12px" role="alert">
			  				<b>No hay Registros.
					</div>
				<?php
			}else{
				?>
				<link rel="stylesheet" type="text/css" href="style.css">
				<h1><center><b>Lista de Mascotas</center></h1></b><br>
					<center><table>
						<tr style="background: #8996E0;">
								<th><b>Nombre</th><th><b>Raza</th><th><b>Cedula del Dueño</th><th><b>Id</th>  
						</tr>
						<?php
						for ($i=0; $i <count($arr2) ; $i++) {
						?>
						<tr>
							<td>
								<?php echo $arr2[$i]['nombre']?>
							</td>
							<td>
								<?php echo $arr2[$i]['raza']?>
							</td>
							<td>
								<?php echo $arr2[$i]['cedula_dueño']?>
							</td>
							<td>
								<?php echo $arr2[$i]['id']?>
							</td>
						</tr>
					
				<?php
			}
			?>
			</table></center>
			<?php
			}
				
			$_SESSION['listmasc'] = "False";
		}
	}

	if (isset($_SESSION['listdueño'])) {
		if ($_SESSION['listdueño'] == "True") { 
			?>
				<h1><center><b>Busqueda</center></h1></b><br>
				<form action="" method="post">
					<b>Cedula:<input type="text" name="ced" class="form-control" placeholder="Ingrese Cedula" required><br>
					<center><input type="submit" name="busqusu" class="btn btn-dark" value="Buscar"></center>
				</form>
			<?php
			$_SESSION['listdueño'] = "False";
		}
	}

	if (isset($_POST['busqusu'])) {
		$arr3=$usu->busquedamasc($_POST['ced'],$con->conectar());

		if (!empty($arr3)) {
			?>
			<br><center><h1>Mascotas Encontradas</center></h1>
				<link rel="stylesheet" type="text/css" href="style.css">
					<center><table>
						<tr style="background: #8996E0;">
								<th>Nombre</th><th>Raza</th><th>Cedula del Dueño</th><th>Id</th>  
						</tr>
						<?php
						for ($i=0; $i <(count($arr3)) ; $i++) { 
						?>
						<tr>
							<td><?php echo $arr3[$i]['nombre'];?></td><td><?php echo $arr3[$i]['raza'];?></td><td><?php echo $arr3[$i]['cedula_dueño'];?></td><td><?php echo $arr3[$i]['id'];?></td>
						</tr>
					
				<?php
			}
			?>
			</table></center>
			<?php
		}else{
			?>
				<br>
				<div class="alert alert-warning" style="color: #ADA226; border: 2px solid #ADA226; border-radius: 10px; padding: 12px" role="alert">
		  				<b>Esta cedula no existe/El usuario no tiene mascotas registradas.
					</div>
			<?php
		}
		$con->desconectar();
		$_SESSION['listdueño'] = "False";
	}
?>

			</div>
		</div>
	</div>
</body>
</html>

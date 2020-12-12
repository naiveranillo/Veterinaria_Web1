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
?>
<?php
	require_once("conexion.php");
	require_once("admin.php");
	
	$con = new conexion();
	$admin = new admin();	
	
	if(isset($_SESSION['crearadmin'])){
		if ($_SESSION['crearadmin'] == "True") {
			?>
			<h1><center><b>Crear Administrador</center></h1></b><br>
			<form method="post" action="">
				<b>Primer Nombre: <input type="text" name="p_nom" placeholder="Ingrese primer nombre" class="form-control" required><br>
				Segundo Nombre: <input type="text" name="s_nom" placeholder="Ingrese segundo nombre" class="form-control" required><br>
				Primer Apellido: <input type="text" name="p_ape" placeholder="Ingrese primer apellido" class="form-control" required><br>
				Segundo Apellido: <input type="text" name="s_ape" placeholder="Ingrese segundo apellido" class="form-control" required><br>
				Cedula: <input type="text" name="ced" placeholder="Ingrese cedula" class="form-control" required><br>
				Email: <input type="text" name="email" placeholder="Ingrese Email" class="form-control" required><br>
				Contraseña: <input type="text" name="pass" placeholder="Ingrese Contraseña" class="form-control" required><br>
				<center><input type="submit" class="btn btn-dark" name="crearadmin" value="Agregar Administrador"></center>
			</form>
			<?php
			$_SESSION['crearadmin'] = "False";
			$_SESSION['modadmin'] = "False";
			
		}
		
	}

	if (isset($_POST['crearadmin'])) {
		$admin->agregar($_POST["p_nom"],$_POST["s_nom"], $_POST["p_ape"], $_POST["s_ape"], $_POST["ced"], $_POST["email"], $_POST["pass"],$_SESSION['nomlogin'],$_SESSION['cedlogin'],$con->conectar());
		$con->desconectar();
		?>
		<br>
		<div  style="color: #24800E; border: 2px solid #24800E; border-radius: 10px; padding: 12px" class="alert alert-success" role="alert">
 			<b>Administrador Registrado Correctamente
		</div>
		<?php
	}

	if (isset($_SESSION['listadmin'])) {
		if ($_SESSION['listadmin'] == "True") {
			$arr=$admin->lista($_SESSION['nomlogin'],$_SESSION['cedlogin'],$con->conectar());
			$con->desconectar();
			if (empty($arr)) {
				?>
					<h1><center><b>Lista de Administradores</center></h1></b><br>
					<br>
					<div class="alert alert-warning" style="color: #ADA226; border: 2px solid #ADA226; border-radius: 10px; padding: 12px" role="alert">
			  				<b>No hay Registros.
					</div>
				<?php
				//print_r($_SESSION);
			}else{
				?>
				<link rel="stylesheet" type="text/css" href="style.css">
				<h1><center><b>Lista de Administradores</center></h1></b><br>
					<center><table>
						<tr style="background: #8996E0;">
								<th><b>Nombres</th><th><b>Apellidos</th><th><b>Cedula</th><th><b>Email</th><th><b>Contraseña</th>
						</tr>
						<?php
						for ($i=0; $i <count($arr) ; $i++) { 
						?>
						<tr>
							<td>
								<?php echo $arr[$i]['p_nombre']."  ".$arr[$i]['s_nombre']?>
							</td>
							
							<td>
								<?php echo $arr[$i]['p_apellido']."  ".$arr[$i]['s_apellido']?>
							</td>
							<td>
								<?php echo $arr[$i]['cedula']?>
							</td>
							<td>
								<?php echo $arr[$i]['mail']?>
							</td>
							<td>
								<?php echo $arr[$i]['password']?>
							</td>
						</tr>
					
				<?php
				}
			?></table></center><?php
			}
				
			$_SESSION['listadmin'] = "False";
			$_SESSION['modadmin'] = "False";
		}
	}

	if (isset($_POST['busqadmin'])) {
		$arr2=$admin->busqueda($_POST['ced'],$con->conectar());

		if (!empty($arr2)) {
			$_SESSION['modadmin'] = "False";
		}
		
	}

	if (isset($_SESSION['modadmin'])) {
		if ($_SESSION['modadmin'] == "True") { 
			?>
				<h1><center><b>Busqueda</center></h1></b><br>
				<form action="" method="post">
					<b>Cedula:<input type="text" name="ced" class="form-control" placeholder="Ingrese Cedula" required><br>
					<center><input type="submit" name="busqadmin" class="btn btn-dark" value="Buscar"></center>
				</form>
			<?php

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
	}

	if (!empty($arr2)) {
		?>
		<h1><center><b>Modificar Administrador</center></h1></b><br>
		<form action="" method="post">
			<b>Primer Nombre: <input type="text" name="p_nom" value="<?php echo $arr2[0]['p_nombre']?>" class="form-control" required><br>
			Segundo Nombre: <input type="text" name="s_nom" value="<?php echo $arr2[0]['s_nombre']?>" class="form-control" required><br>
			Primer Apellido: <input type="text" name="p_ape" value="<?php echo $arr2[0]['p_apellido']?>" class="form-control" required><br>
			Segundo Apellido: <input type="text" name="s_ape" value="<?php echo $arr2[0]['s_apellido']?>" class="form-control" required><br>
			Cedula: <input type="text" name="ced" readonly value="<?php echo $arr2[0]['cedula']?>" class="form-control" required><br>
			Email: <input type="text" name="email" value="<?php echo $arr2[0]['mail']?>" class="form-control" required><br>
			Contraseña: <input type="password" name="pass" value="<?php echo $arr2[0]['password']?>" class="form-control" required><br>
			<center><input type="submit" class="btn btn-dark" name="adminmod" value="Modificar"></center>
		</form>
		<?php

	}

	if (isset($_POST['adminmod'])) {
		$admin->actualizar($_POST["p_nom"],$_POST["s_nom"], $_POST["p_ape"], $_POST["s_ape"], $_POST["ced"], $_POST["email"], $_POST["pass"],$con->conectar());
		$con->desconectar();
		?>
			<br>
			<div  style="color: #24800E; border: 2px solid #24800E; border-radius: 10px; padding: 12px" class="alert alert-success" role="alert">
		 		<b>Modificacion Exitosa.
			</div>
		<?php
	}
?>
			</div>
		</div>
	</div>
</body>
</html>


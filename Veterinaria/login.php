<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login - Veterinaria</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
	<body style="background-image: url(fondologin.jpg); background-size: 105%;">
				<div class="navegador-login"><img src="iconodog.png" width="60" height="55"><label><h4 style="-webkit-text-stroke: 1px black;">Veterinaria</h4></label></div><br><br><br><br><br>
				<div class="box-login box-shadow">
						<center><h1>Iniciar Sesion</h1></center><br>
		<form  action="" method="post">
			<b>Email: <input type="text" name="Mail" class="form-control"><br>
			Contraseña: <input type="password" name="Password" class="form-control"><br>
			<center><input type="submit" class="btn btn-dark" name="login" value="Iniciar Sesion"></center>
		</form>
		

<?PHP	
if(isset($_POST['login'])){
	
	require_once("conexion.php");
	require_once("admin.php");
	
	$con = new conexion();
	$admin = new admin();	

	$link = new mysqli('localhost','anillonaiver','naiver3753313','veterinaria');
	
	if ($link->connect_errno) {
			echo "Falló la conexión a MySQL: (" . $link->connect_errno . ") " . $link->connect_error;
		}else{
			$mail = $_POST['Mail'];
			$password = $_POST['Password'];
			$sql ="SELECT password FROM administrador WHERE mail = '$mail' and password = '$password'";

			$result = $link->query($sql);
			if($result->fetch_assoc()){
				session_start();
				$arr=$admin->searchmail($mail,$con->conectar());
				$_SESSION['nomlogin'] = $arr[0]['p_nombre'];
				$_SESSION['cedlogin'] = $arr[0]['cedula'];
				$_SESSION['apelogin'] = $arr[0]['p_apellido'];
				$_SESSION['activar'] = "on";
				$_SESSION['Reg']='ok';
				?>
				<?php
				header('Location: index.php');
			}else{
				$_SESSION['Reg']='fail';
				?>
				<br>
				<div class="alert alert-danger" style="color: #711414; border: 2px solid #711414; border-radius: 10px; padding: 12px" role="alert">
		 			<b>Usuario o Contraseña Incorrecto.
				</div>
			<?php
			}
		}
	mysqli_close($link);
}
?>	
		</div>
	</body>
</html>

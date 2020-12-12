<?php
session_start();
if(!isset($_SESSION['Reg'])){
	
	header('Location: login.php');

}else{

	if($_SESSION['Reg']!='ok'){
		header('Location: login.php');
	}else{
		include("index.php");
		if(isset($_GET['a'])){
			if($_GET['a']=='adm')include("menuadm.php");
			if($_GET['a']=='usu')include("menusuario.php");
			if($_GET['a']=='mas')include("menumascota.php");
		}
		if (isset($_GET['a2'])) {
			if ($_GET['a2']=='crear'){
				$_SESSION['crearadmin'] = "True";
				include("menuadm.php");
				include("crudAdm.php");
			}
			if ($_GET['a2']=='mod'){
				$_SESSION['modadmin'] = "True";
				include("menuadm.php");
				include("crudAdm.php");
			}
			if ($_GET['a2']=='list'){
				$_SESSION['listadmin'] = "True";
				include("menuadm.php");
				include("crudAdm.php");
			}
		}
		if (isset($_GET['u'])) {
			if ($_GET['u']=='crear') {
				$_SESSION['crearusu'] = "True";
				include("menusuario.php");
				include("crudUsu.php");
			}
			if ($_GET['u']=='mod') {
				$_SESSION['modusu'] = "True";
				include("menusuario.php");
				include("crudUsu.php");
			}
			if ($_GET['u']=='list') {
				$_SESSION['listusu'] = "True";
				include("menusuario.php");
				include("crudUsu.php");
			}

		}

		if (isset($_GET['m'])) {
			if ($_GET['m']=='crear'){
				$_SESSION['crearmasc'] = "True";
				include("menumascota.php");
				include("crudMas.php");
			}
			if ($_GET['m']=='listdueño'){
				$_SESSION['listdueño'] = "True";
				include("menumascota.php");
				include("crudMas.php");
			}
			if ($_GET['m']=='list'){
				$_SESSION['listmasc'] = "True";
				include("menumascota.php");
				include("crudMas.php");
			}
		}
		if(isset($_GET['b'])){
			session_destroy();
			header('Location: login.php');
		}
	}

}		

?>

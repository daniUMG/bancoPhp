<?php
// borrar datos de la session
if(isset($_POST['cerrarSesion'])) {
	echo "cerrar sesion";
	session_destroy();
	unset($_SESSION['idusuario']);
	header('Location: ../index.php');
	exit;
}
?>
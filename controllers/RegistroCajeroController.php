<?php
  	include('../db/conection.php');

  	if(isset($_POST['enviar'])) {
	  $nombre = $_POST['nombre']; 
	  $email = $_POST['email']; 
	  $password = $_POST['password']; 
	  $sql = "INSERT INTO `cajero`(`nombre`, `usuario`, `clave`, `estado`) VALUES ('$nombre','$email','$password',1)";

	  if($resultado = $conexion->query($sql)) {
	    if($resultado >= 1) { 
		    echo "<script>alert('Cajero Registrado de manera Exitosa!');</script>";
		} else {
			echo "<script>alert('Error: Se produjo un error al intentar guardar los datos, revise que haya ingresado todo correctamente.');</script>";
		}
	  } else{
	    printf("Error: %s\n", $sql->error);
	  }
	}
?>
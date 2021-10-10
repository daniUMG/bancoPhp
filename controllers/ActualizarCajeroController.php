<?php
  	include('../db/conection.php');

  	if(isset($_POST['idcajero'])) {
	  $estado = $_POST['estado']; 
      $idcajero = $_POST['idcajero']; 
	  $sql = "UPDATE `cajero` set estado = $estado where idcajero = $idcajero";

	  if($resultado = $conexion->query($sql)) {
	    if($resultado >= 1) { 
		    echo "<script>alert('Cajero actualizado de manera Exitosa!');</script>";
		} else {
			echo "<script>alert('Error: Se produjo un error al intentar guardar los datos.');</script>";
		}
	  } else{
	    printf("Error: %s\n", $sql->error);
	  }
	}
?>
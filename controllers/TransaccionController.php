<?php
  include('../db/conection.php');

  if(isset($_POST['btn-transaccion'])) {
    $fecha = $_POST['fecha']; 
    $cuenta = $_POST['cuenta']; 
    $monto = $_POST['monto']; 
    $transaccion = $_POST['transaccion-tipo']; 
    $idcajero = $_POST['idCajero']; 
    $idtercero = $_POST['idTercero']; 
    
    $fecha = $_POST['fecha']; 
    $cuenta = $_POST['cuenta']; 
    $monto = $_POST['monto']; 
    $transaccion = $_POST['transaccion-tipo']; 
    $idcajero = $_POST['idCajero']; 
    $idtercero = $_POST['idTercero']; 
    $sql = "INSERT INTO `operacion`(`fecha`, `NoCuenta`, `monto`, `tipo_transaccion`, `tipo_operacion`, `id_cajero`, `id_tercero`) VALUES ('$fecha','$cuenta',$monto,$transaccion,1,$idcajero,$idtercero)";

    if($resultado = $conexion->query($sql)) {
      if($resultado >= 1) { 
        echo "<script>alert('Transaccion realizada de manera Exitosa!');</script>";
      } else {
        echo "<script>alert('Error: Se produjo un error al realizar la transacción, por lo tanto no se pudo realizar, revise que haya ingresado todo correctamente.');</script>";
      }
    } else {
      printf("Error: %s\n", $sql->error);
    }
  }
?>
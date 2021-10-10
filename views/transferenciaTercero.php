<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mysqli = new mysqli('localhost', 'desarrollo_web', 'desarrollo', 'banco');
        if ($mysqli -> connect_errno) {
            // La conexión falló
            echo "Lo sentimos, este sitio web está experimentando problemas.";
            echo "Errno: " . $mysqli -> connect_errno . "\n";
            exit;
        }
        $origen = $_POST['origen'];
        $cuenta = $_POST['cuenta'];
        $monto = $_POST['monto'];
        $sql = "UPDATE cuenta_usuario set monto = monto - $monto where nocuenta = $origen";
  
        if ($mysqli->query($sql) === TRUE) {
            // Insertar operación
            $sql2 = "INSERT INTO operacion (fecha, NoCuenta, monto, tipo_transaccion, tipo_operacion, id_tercero)
            VALUES (NOW(), $origen, $monto, 1, 2, '$cuenta')";
            $mysqli->query($sql2);
            // Actualizar número de transferencias realizadas
            $sql3 = "UPDATE usuario_tercero set transferencias = transferencias + 1 where iddestino = $cuenta and idorigen = $origen";
            $mysqli->query($sql3);
            // Sumar monto a destino
            $sql4 = "UPDATE cuenta_usuario set monto = monto + $monto where nocuenta = $cuenta";
            $mysqli->query($sql4);
        } else {
          echo "Error: " . $sql . "<br>" . $mysqli -> error;
        }  
  
        $mysqli->close();
      }
?>

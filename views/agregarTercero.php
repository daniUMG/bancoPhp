<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mysqli = new mysqli('localhost', 'root', '', 'banco');
        if ($mysqli -> connect_errno) {
            // La conexión falló
            echo "Lo sentimos, este sitio web está experimentando problemas.";
            echo "Errno: " . $mysqli -> connect_errno . "\n";
            exit;
        }
        $origen = $_SESSION['idusuario']; // Cambiar por usuario conectado
        $cuenta = $_POST['cuenta'];
        $alias = $_POST['alias'];
        $monto = $_POST['monto'];
        $cantidad = $_POST['cantidad'];
        $sql = "INSERT INTO usuario_tercero (idorigen, iddestino, alias, monto_max, cantidad_max, transferencias)
        VALUES ($origen, $cuenta, '$alias', '$monto', '$cantidad', 0)";
  
        if ($mysqli->query($sql) === TRUE) {
          echo "Cuenta agregada";
        } else {
          echo "Error: " . $sql . "<br>" . $mysqli -> error;
        }  
  
        $mysqli->close();
      }
?>
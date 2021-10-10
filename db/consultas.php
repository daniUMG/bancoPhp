<?php
    // Devuelve la consulta en formato JSON
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $mysqli = new mysqli('localhost', 'root', '', 'banco');
        if ($mysqli -> connect_errno) {
            // La conexión falló
            echo "Lo sentimos, este sitio web está experimentando problemas.";
            echo "Errno: " . $mysqli -> connect_errno . "\n";
            exit;
        }
        $tabla = $_GET['tabla'];
        $condiciones = "";
        $columnas = "*";
        if(isset($_GET['condiciones'])) {
            $condiciones = "where " . $_GET['condiciones'];
        }
        if(isset($_GET['columnas'])) {
            $columnas = $_GET['columnas'];
        }
        $filas = array();
        $sql = $mysqli -> query("SELECT $columnas from $tabla $condiciones");
        while($obj = $sql -> fetch_object()) {
            $filas[] = $obj;
        }
        echo json_encode($filas);
        $mysqli->close();
      }
?>
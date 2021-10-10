<?php
$conexion = new mysqli('localhost', 'desarrollo_web', 'desarrollo', 'banco');
if ($conexion->connect_errno) {
    echo "ERROR al conectar con la DB.";
    exit;
}
?>
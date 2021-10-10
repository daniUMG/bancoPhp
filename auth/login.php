<?php
 
include('./db/conection.php');
session_start();

if(isset($_POST['login'])) {
    $user = $_POST['email'];
    $pass = MD5($_POST['password']);

    if($user == "" || $_POST['password'] == null){
        echo "<script>alert('Error: usuario y/o contraseña vacios!!');</script>";
    } else {

        $sql = "SELECT * FROM usuario WHERE email = '$user' AND password = '$pass'";

        if($resultado = $conexion->query($sql)){

            if($resultado->num_rows == 0) {
                echo "<script>alert('Error: usuario y/o contraseña incorrectos!!');</script>";
            } else {
                $result = $resultado->fetch_object();
                
                if($result->estado === '0') {
                    echo "<script>alert('La cuenta no ha sido verificada ó a sido desactivada');</script>";
                } else if($result->estado === '1') {
                    print_r($result->estado);
                    $_SESSION['idusuario'] = $result->idusuario;
                    $_SESSION['nombre'] = $result->nombre;
                    $_SESSION['apellido'] = $result->apellido;
                    $_SESSION['email'] = $result->email;
                    $_SESSION['isadmin'] = $result->isadmin;
                    if($result->isadmin) {
                        header('location: ./views/administrador.php');
                    } else {
                        header('location: ./views/panelUsuario.php');
                    }
                }
            }

        } else {
            printf("Error: %s\n", $sql->error); 
        }
    }
}
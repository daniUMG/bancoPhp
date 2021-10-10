<?php
// obtener URL
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
$pagina_buscada = '/index.php';
$pagina_buscada2 = '/registrarUsuario.php';
$pagina_isadmin = '/administrador.php';
$filter_index = strpos($url, $pagina_buscada);
$filter_registrar = strpos($url, $pagina_buscada2);
$filter_isadmin = strpos($url, $pagina_isadmin);
if(!$filter_index) {
   session_start();
}

// verificar la url a la que está trantando de acceder (un usuario deslogueado)
if(!isset($_SESSION['idusuario'])) {
    // redireccionar a index.php si trata a una url que no sea la de registrar e index
    if(!$filter_index) {
        if(!$filter_registrar) {
            header('Location: ../index.php');
            exit;
        }
    }
} else {
    // verificar la url a la que está trantando de acceder (un usuario logueado)
    if(!$filter_index && !$filter_registrar) {
        // que hacer si la url puede ser accedida
        if($filter_isadmin) {
            // verificar que el que trata acceder a una url admin sea administrador
            if($_SESSION['isadmin'] === null) {
                header('location: ./panelUsuario.php');
            }
        }
    } else {
        // que hacer si intenta ver la pagina de index o registrar
        if(!$filter_registrar) {
            header('location: ./views/panelUsuario.php');
            exit;
        } else {
            header('location: ./panelUsuario.php');
            exit;
        }
    }
}
?>
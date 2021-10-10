<?php
    include('../auth/cerrarSesion.php');
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.2/css/bootstrap.min.css" integrity="sha512-SCpMC7NhtrwHpzwKlE1l6ks0rS+GbMJJpoQw/A742VaxdGcQKqVD8F/y/m9WLOfIPppy7mWIs/kS0bKgSI0Bfw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" integrity="sha512-xnP2tOaCJnzp2d2IqKFcxuOiVCbuessxM6wuiolT9eeEJCyy0Vhcwa4zQvdrZNVqlqaxXhHqsSV1Ww7T2jSCUQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-dark d-flex sticky-top">
    <div class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-white">
        <a href="panelUsuario.php" class="d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5"><span class="d-none d-sm-inline">Banca en Linea</span></span>
        </a>
        <ul class="nav nav-pills flex-sm-column flex-row flex-nowrap flex-shrink-1 flex-sm-grow-0 flex-grow-1 mb-sm-auto mb-0 justify-content-center align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
                <a href="panelUsuario.php" class="nav-link px-sm-0 px-2 text-white">
                    <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline">Tablero</span>
                </a>
            </li>
            <?php
                if($_SESSION['isadmin'] !== null){
                    printf('<li>
                        <a href="administrador.php" class="nav-link px-sm-0 px-2 text-white">
                                <i class="fs-5 bi-speedometer2"></i><span class="ms-1 d-none d-sm-inline">Administrador</span> </a>
                        </li>');
                }
            ?>
            <li>
                <a href="cajero.php" class="nav-link px-sm-0 px-2 text-white">
                    <i class="fs-5 bi-table"></i><span class="ms-1 d-none d-sm-inline">Cajero</span></a>
            </li>
            <!-- <li>
                <a href="#" class="nav-link px-sm-0 px-2 text-white">
                    <i class="fs-5 bi-grid"></i><span class="ms-1 d-none d-sm-inline">Usuario</span></a>
            </li> -->
        </ul>
        <div class="dropdown py-sm-4 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://active-role-works.com/avatar.png" alt="hugenerd" width="28" height="28" class="rounded-circle">
                <span class="d-none d-sm-inline mx-1"><?php echo $_SESSION['nombre'] ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li>
                    <form method="POST" action="">
                        <input type="submit" name="cerrarSesion" class="dropdown-item" value="Cerrar Sesión">
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" integrity="sha512-nnzkI2u2Dy6HMnzMIkh7CPd1KX445z38XIu4jG1jGw7x5tSL3VBjE44dY4ihMU1ijAQV930SPM12cCFrB18sVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.2/js/bootstrap.min.js" integrity="sha512-HSNvqjhsAxRPvbSBEdXWlkR9uYmJtUvXEyfAvUzlA0uS5SyFZMZdczgz8oPWTz2NUEBaXkIYL4kdrBJkP66jYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
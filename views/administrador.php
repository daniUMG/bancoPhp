<?php
  include('../config/urlsession.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">

    <link rel="stylesheet" href="../css/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <title>Banca en Linea/Administrador</title>
</head>
<body>
  <div class="container-fluid overflow-hidden">
    <div class="row vh-100 overflow-auto">
      <?php require("../components/sidebar.php"); ?>
        <div class="col d-flex flex-column h-sm-100">
          <main class="row overflow-auto">
            <div class="col pt-4">
              <div class="row">
                <div class="col">
                  <h2>Panel de administración de <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></h2>
                </div>
              </div>
              <div class="mb-3">
                <h2 class="titulo-2">Gestión de Usuarios Cajeros</h2>
                <?php include('../components/UsuariosCajeros.php'); ?>
              </div>
              <div class="mb-2">
                <h2 class="titulo-2">Registro de Cajero:</h2>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <div class="input-group mb-3">
                        <span class="input-group-text txtinput"
                            id="inputGroup-sizing-default">Nombre:</span>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default" name="nombre">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text txtinput"
                            id="inputGroup-sizing-default">Usuario</span>
                        <input type="email" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default" name="email">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text txtinput"
                            id="inputGroup-sizing-default">Contraseña:</span>
                        <input type="password" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default" name="password">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text txtinput" id="inputGroup-sizing-default">Repetir
                            Contraseña:</span>
                        <input type="password" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default" name="rpassword">
                    </div>
                    <button type="submit" class="btn btn-primary" name="enviarCajero">Enviar</button>
                </form>
            </div>
            <div class="mb-2">
              <h2>Registro de usuario:</h2>
              <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                  <div class="input-group mb-3">
                      <span class="input-group-text txtinput"
                          id="inputGroup-sizing-default">Nombre:</span>
                      <input type="text" class="form-control" aria-label="Sizing example input"
                          aria-describedby="inputGroup-sizing-default" name="nombre">
                  </div>
                  <div class="input-group mb-3">
                      <span class="input-group-text txtinput"
                          id="inputGroup-sizing-default">Apellido:</span>
                      <input type="text" class="form-control" aria-label="Sizing example input"
                          aria-describedby="inputGroup-sizing-default" name="apellido">
                  </div>
                  <div class="input-group mb-3">
                      <span class="input-group-text txtinput" id="inputGroup-sizing-default">Email</span>
                      <input type="email" class="form-control" aria-label="Sizing example input"
                          aria-describedby="inputGroup-sizing-default" name="email">
                  </div>
                  <div class="input-group mb-3">
                      <span class="input-group-text txtinput"
                          id="inputGroup-sizing-default">Telefono:</span>
                      <input type="tel" class="form-control" aria-label="Sizing example input"
                          aria-describedby="inputGroup-sizing-default" name="telefono">
                  </div>
                  <div class="input-group mb-3">
                      <span class="input-group-text txtinput" id="inputGroup-sizing-default">DPI:</span>
                      <input type="text" class="form-control" aria-label="Sizing example input"
                          aria-describedby="inputGroup-sizing-default" name="dpi">
                  </div>
                  <div class="input-group mb-3">
                      <span class="input-group-text txtinput"
                          id="inputGroup-sizing-default">Contraseña:</span>
                      <input type="password" class="form-control" aria-label="Sizing example input"
                          aria-describedby="inputGroup-sizing-default" name="password">
                  </div>
                  <div class="input-group mb-3">
                      <span class="input-group-text txtinput" id="inputGroup-sizing-default">Repetir
                          Contraseña:</span>
                      <input type="password" class="form-control" aria-label="Sizing example input"
                          aria-describedby="inputGroup-sizing-default" name="rpassword">
                  </div>
                  <div class="form-check mb-3">
                      <input type="checkbox" class="form-check-input" name="isadmin" id="isadmin">
                      <label class="form-check-label" for="isadmin">Administrador</label>
                  </div>
                  <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
              </form>
            </div>
          </main>
        </div>
    </div>
  </div>
  
  <?php
    include('../controllers/RegistroCajeroController.php');
    $db_host = 'localhost';
    $db_user = 'desarrollo_web';
    $db_password = 'desarrollo';
    $db_db = 'banco';
  
    $mysqli = @new mysqli(
      $db_host,
      $db_user,
      $db_password,
      $db_db
    );
    
    if ($mysqli->connect_error) {
      // echo 'Errno: '.$mysqli->connect_errno;
      // echo '<br>';
      echo 'Error: '.$mysqli->connect_error;
      exit();
    }
    // echo 'Success: A proper connection to MySQL was made.';
    // echo '<br>';
    // echo 'Host information: '.$mysqli->host_info;
    // echo '<br>';
    // echo 'Protocol version: '.$mysqli->protocol_version;
    // echo '<br>';
    if(isset($_POST['enviar'])){
      insertar($mysqli); 
    }
    function insertar($mysqli){
      // echo 'si reconocio boton'; 
      $nombre = $_POST['nombre']; 
      $apellido = $_POST['apellido']; 
      $email = $_POST['email']; 
      $telefono = $_POST['telefono']; 
      $dpi = $_POST['dpi']; 
      $password = $_POST['password'];
      $isadmin = null;
      if (isset($_POST['isadmin'])) {
        $isadmin = 1;
      }
      $hash = md5(rand(0,1000));
      $consulta = "INSERT INTO `usuario`(`nombre`, `apellido`, `email`, `telefono`, `password`, `estado`, `dpi`, `isadmin`, `hash`) VALUES ('$nombre','$apellido','$email','$telefono','$password',1,'$dpi','$isadmin','$hash')";
      mysqli_query($mysqli,$consulta); 
      // echo "datos guardados ";
    }
    $mysqli->close();

  ?>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script>
    $(function() {
      $('.EstadoCajero').each(function() {
        const estado = Number($(this).attr('data-estado'));
        const idCajero = $(this).parent().children('.td-idcajero').text();
        $(this).html(estado ? `Activo (<a class="text-danger cambiar-estado" href="#" data-cajero="${idCajero}" data-estado="${estado}">Bloquear</a>)` 
        : `Bloqueado (<a class="text-success cambiar-estado" href="#" data-cajero="${idCajero}" data-estado="${estado}">Desbloquear</a>)`);
      });
      $('.EstadoCajero .cambiar-estado').each(function() {
        $(this).click(function(evt) {
          const estado = Number($(this).attr('data-estado'));
          evt.preventDefault();
          const estadoNuevo = estado ? 0 : 1;
          $.post('../controllers/ActualizarCajeroController.php', {
            estado: estadoNuevo,
            idcajero: $(this).attr('data-cajero')
          }, () => {
            window.location.reload();
          });
        });
      });
    });
  </script>
</body>
</html>
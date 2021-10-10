<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/normalize.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/stylesVariables.css">
  <title>Banco/Verificar</title>
  <?php
    include('../db/conection.php');
    
    $querysUrl = $_SERVER['QUERY_STRING'];
    $queryEmail = htmlspecialchars($_GET["email"]);
    $queryHash = htmlspecialchars($_GET["hash"]);
    // echo $queryEmail;

    $sql = "SELECT idusuario FROM usuario WHERE email = '$queryEmail' and hash = '$queryHash'";

    if($resultado = $conexion->query($sql)){
      if($resultado->num_rows == 0) {
        $textEstadoOperacion = "Error: Es un token incorrecto/el usuario no ha sido registrado";
        echo "<script>alert('Error: Es un token incorrecto/el usuario no ha sido registrado');</script>";
      } else {
          $result = $resultado->fetch_object();
          $sqlUpdate = "UPDATE usuario SET estado = 1, hash = '' WHERE idusuario = '$result->idusuario'";
          if ($resultadoUpdate = $conexion->query($sqlUpdate)) {
            if($resultadoUpdate >= 1) {
              $textEstadoOperacion = "Cuenta Verificada exitosamente! Ya puede Iniciar Sesión";
              echo "<script>alert('Cuenta Verificada exitosamente! Ya puede Iniciar Sesión');</script>";
            }
          }
      }
    } else {
        printf("Error: %s\n", $sql->error); 
    } 
  ?>
</head>

<body>
  <div class="session">
    <div class="left" style="width: 100%;">
      <img class="logo mt-5" src="../assets/logo.png" style="height: 40%;" />
      <div class="logo mt-5">
        <p style="height: 40px; margin: auto; font-size: 20px; color: #fff; opacity: 1;"><?php echo $textEstadoOperacion; ?></p>
        <a href="../index.php" class="btn btn-primary" style="height: 40px; margin: auto;">Ya tienes cuenta? Iniciar Sesión</a>
      </div>
    </div>
    <!-- <form method="POST" action="" class="log-in"> 
      <h4>Banca <span>en Linea</span></h4>
      <p>Bienvenido(a) a banca en linea:</p>
      <div class="floating-label">
        <input placeholder="Email" type="email" name="email" id="email" autocomplete="off" required>
      </div>
      <div class="floating-label">
        <input placeholder="Password" type="password" name="password" id="password" autocomplete="off" required>
      </div>
      <a href="./views/registrarUsuario.php" class="discretes">No tienes cuenta? Regístrate</a>
      <input type="submit" name="login" class="buttonLogin" value="Ingresar">
    </form> -->
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
</body>
</html>
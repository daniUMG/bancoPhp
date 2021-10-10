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
  <title>Banca/Registrar</title>
</head>

<body>
  <div class="session">
    <div class="left">
      <img class="logo mt-5" src="../assets/logo.png" />    
    </div>
    <form method="POST" action="" class="log-in" id="formulario"> 
      <h4>Registrarse</h4>
      <p>Ingrese sus datos</p>
      <div class="floating-label">
        <input type="text" id="nombre" name="nombre" placeholder="Ingresar nombre" autocomplete="off" required>
      </div>
      <div class="floating-label">
        <input type="text" id="apellido" name="apellido" placeholder="Ingresar apellido" autocomplete="off" required>
      </div>
      <div class="floating-label">
        <input type="email" id="email" name="email" placeholder="Ingresar correo" autocomplete="off" required>
      </div>
      <div class="floating-label">
        <input type="text" id="telefono" name="telefono" placeholder="Ingresar número de teléfono" autocomplete="off">
      </div>
      <div class="floating-label">
        <input type="password" id="password" name="password" placeholder="Contraseña" autocomplete="off" required>
      </div>
      <div class="floating-label">
        <input type="password" id="confirmar" name="confirmar" placeholder="Confirmar contraseña" autocomplete="off" required>
      </div>
      <a href="../index.php" class="discretes">Ya tienes cuenta? Iniciar Sesión</a>
      <input type="submit" id="registrar" name="registrar" class="buttonLogin" value="Registrarse">
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
      $('#formulario').submit(function(evt) {
        evt.preventDefault();
        if ($('#password').val() != $('#confirmar').val()) {
          alert('Las contraseñas no coinciden');
          return;
        }

        $.post('registrarUsuario.php', {
          nombre: $('#nombre').val(),
          apellido: $('#apellido').val(),
          email: $('#email').val(),
          telefono: $('#telefono').val(),
          password: $('#password').val(),
        }, (datos) => {
          alert('Usuario registrado exitosamente!');
          // console.log(datos);
          window.location.replace('../index.php');
        });
      });
    </script>
    <?php
      include('../controllers/RegistrarUsuarioController.php');
      include('../config/urlsession.php');
    ?>
</body>

</html>
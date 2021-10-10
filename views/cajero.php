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
    <title>Banca en Linea/Transacciones</title>
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
                  <h2>Cajero de <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></h2>
                </div>
              </div>
              <div>
                <h2 class="titulo-2">Realizar transaccion:</h2>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <div class="input-group mb-3">
                        <span class="input-group-text txtinput" id="inputGroup-sizing-default">Fecha:</span>
                        <input type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="fecha">
                      </div>
                      <div class="input-group mb-3">
                        <span class="input-group-text txtinput" id="inputGroup-sizing-default">Numero de cuenta:</span>
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="cuenta">
                      </div>
                      <div class="input-group mb-3">
                        <span class="input-group-text txtinput" id="inputGroup-sizing-default">Monto: Q.</span>
                        <input type="number" step="any" placeholder="00.00" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="monto">
                      </div>
                      <div class="input-group mb-3">
                        <span class="input-group-text txtinput" id="inputGroup-sizing-default">Tipo transaccion:</span>
                        <select class="form-select" aria-label="Default select example" name="transaccion-tipo">
                          <option value="1">Deposito</option>
                          <option value="2">Retiro</option>
                        </select>
                      </div>
                      <div class="input-group mb-3">
                        <span class="input-group-text txtinput" id="inputGroup-sizing-default">ID Tercero:</span>
                        <input type="number" class="form-control" aria-label="Sizing example input"  aria-describedby="inputGroup-sizing-default" name="idTercero">
                      </div>
                      <div class="input-group mb-3">
                        <span class="input-group-text txtinput" id="inputGroup-sizing-default">ID Cajero:</span>
                        <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="idCajero">
                      </div>
                    <button type="submit" class="btn btn-primary" name="btn-transaccion">Enviar</button>
                  </form>
            </div>
          </div>
        </main>
      </div>
    </div>
  </div>

  <?php
    include('../controllers/TransaccionController.php');
  ?>
</body>
</html>
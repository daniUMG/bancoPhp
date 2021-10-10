<?php
  include('../config/urlsession.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Banca en Linea/Panel de usuario</title>
    <?php
      $mysqli = new mysqli('localhost', 'root', '', 'banco');
      if ($mysqli -> connect_errno) {
          // La conexión falló
          echo "Lo sentimos, este sitio web está experimentando problemas.";
          echo "Errno: " . $mysqli -> connect_errno . "\n";
          exit;
      }
      $terceros = $mysqli -> query("SELECT t.iddestino, t.alias, t.monto_max, t.cantidad_max, t.transferencias 
                                    from usuario_tercero t, usuario u where u.idUsuario = t.idorigen and
                                    t.idorigen = 1"); // Cambiar por usuario conectado
    ?>
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
                                <h2>Panel de <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></h2>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6 col-12">
                                <h3>Lista de terceros</h3>
                                <button type="button" class="btn btn-warning" id="AgregarTercero">Agregar cuenta</button>
                                <form id="FormTercero" class="mt-2 d-none">
                                    <div class="form-group">
                                        <label for="cuenta">No. de cuenta</label>
                                        <input type="number" class="form-control" required id="cuenta" name="cuenta"
                                            placeholder="Ingresar no. de cuenta">
                                    </div>
                                    <div class="form-group">
                                        <label for="alias">Alias</label>
                                        <input type="text" class="form-control" required id="alias" name="alias"
                                            placeholder="Ingresar alias de la cuenta">
                                    </div>
                                    <div class="form-group">
                                        <label for="monto">Monto máximo</label>
                                        <input type="number" class="form-control" required id="monto" name="monto"
                                            placeholder="Ingresar monto">
                                    </div>
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad máxima de transacciones mensuales</label>
                                        <input type="number" class="form-control" required id="cantidad" name="cantidad"
                                            placeholder="Ingresar cantidad">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                </form>
                                <?php
                                  if ($terceros) {
                                    if ($terceros->num_rows != 0) {
                                      printf("<div class='table-responsive mt-2'><table class='table'><thead>
                                        <tr>
                                          <th scope='col'>#</th>
                                          <th scope='col'>Alias</th>
                                          <th scope='col'>Monto máximo</th>
                                        </tr>
                                        </thead>
                                      <tbody>");
                                      while ($obj = $terceros -> fetch_object()) {
                                        printf("<tr>
                                        <td>%d</td>
                                        <td>%s</td>
                                        <td>Q. %d</td>
                                        </tr>", $obj -> iddestino, $obj -> alias, $obj -> monto_max);
                                      }
                                      printf("</tbody></table></div>");
                                    }
                                    else {
                                      printf("<p class='mt-2'>No tienes cuentas de terceros agregadas</p>");
                                    }
                                  }
                                ?>
                            </div>
                            <div class="col-md-6 col-12">
                                <h3>Transferencia a cuenta</h3>
                                <form id="FormTransferencia" class="mt-2">
                                    <div class="form-group">
                                        <label for="cuentaO">Cuenta origen</label>
                                        <select class="form-control" required id="cuentaO" name="cuentaO">
                                            <?php
                                            $cuentas = $mysqli -> query("SELECT * from cuenta_usuario where idUsuario = 1"); // Cambiar por usuario conectado
                                            if ($cuentas) {
                                              if ($cuentas->num_rows != 0) {
                                                $cuentas->data_seek(0);
                                                printf("<option value=''>Seleccionar</option>");
                                                while ($obj = $cuentas -> fetch_object()) {
                                                  printf("<option data-monto='%d' value='%d'>%s</option>", $obj -> monto, $obj -> NoCuenta, $obj -> NombreCuenta);
                                                }
                                              }
                                              else {
                                                printf("<option value=''>Es necesario crear una cuenta</option>");
                                              }
                                            }
                                          ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cuentaT">No. de cuenta destino</label>
                                        <select class="form-control" required id="cuentaT" name="cuentaT">
                                            <?php
                                            if ($terceros) {
                                              if ($terceros->num_rows != 0) {
                                                $terceros->data_seek(0);
                                                printf("<option value=''>Seleccionar</option>");
                                                while ($obj = $terceros -> fetch_object()) {
                                                  printf("<option value='%d'>%s</option>", $obj -> iddestino, $obj -> alias);
                                                }
                                              }
                                              else {
                                                printf("<option value=''>Sin cuentas de terceros</option>");
                                              }
                                            }
                                          ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="montoT">Monto</label>
                                        <input type="number" class="form-control" required id="montoT" name="montoT"
                                            placeholder="Ingresar monto">
                                    </div>
                                    <button type="submit" class="btn btn-success">Transferir</button>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <h3 class="mb-2">Estado de cuentas</h3>
                                <?php
                                  if ($cuentas) {
                                    if ($cuentas->num_rows != 0) {
                                      $cuentas->data_seek(0);
                                      while ($obj = $cuentas -> fetch_object()) {
                                        printf("<p>Monto de cuenta %d - %s: <b>%d</b></p>", $obj -> NoCuenta, $obj -> NombreCuenta, $obj -> monto);
                                      }
                                    }
                                    else {
                                      printf("<p>No tienes ninguna cuenta creada</p>");
                                    }
                                  }
                                  $operaciones = $mysqli -> query("SELECT o.`idOperacion`,  DATE_FORMAT(o.`fecha`, '%d/%m/%y %T') fecha, o.`NoCuenta`, o.`monto`, t.`nombre`, op.`tipo`, IFNULL(o.`id_cajero`, '—') id_cajero, IFNULL(o.`id_tercero`, '—') id_tercero
                                                 FROM `operacion` o, cuenta_usuario c, tipo_transaccion t, tipo_operacion op WHERE o.NoCuenta = c.NoCuenta and c.idUsuario = 1 
                                                 and t.idTipoTrans = o.tipo_transaccion and op.idtipo = o.tipo_operacion order by o.idOperacion desc"); // Cambiar por usuario conectado
                                  if ($operaciones) {
                                    if ($operaciones->num_rows != 0) {
                                      printf("<div class='table-responsive mt-2'><table class='table'><thead>
                                        <tr>
                                          <th scope='col'>#</th>
                                          <th scope='col'>Fecha</th>
                                          <th scope='col'># Cuenta</th>
                                          <th scope='col'>Monto</th>
                                          <th scope='col'>Tipo de transacción</th>
                                          <th scope='col'>Tipo de operación</th>
                                          <th scope='col'>Cajero</th>
                                          <th scope='col'>Cuenta de tercero</th>
                                        </tr>
                                        </thead>
                                      <tbody>");
                                      while ($obj = $operaciones -> fetch_object()) {
                                        printf("<tr>
                                        <td>%d</td>
                                        <td>%s</td>
                                        <td>%d</td>
                                        <td>Q. %d</td>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>%s</td>
                                        </tr>", $obj -> idOperacion, $obj -> fecha, $obj -> NoCuenta, $obj -> monto, $obj -> nombre, $obj -> tipo, $obj -> id_cajero, $obj -> id_tercero);
                                      }
                                      printf("</tbody></table></div>");
                                    }
                                    else {
                                      printf("<p class='mt-2'>No tienes cuentas de terceros agregadas</p>");
                                    }
                                  }
                                ?>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <?php $mysqli->close(); ?>
    <script>
    $(function() {
        $('#AgregarTercero').click(() => {
            $('#FormTercero').toggleClass('d-none');
        });
        $('#FormTercero').submit((evt) => {
            evt.preventDefault();
            $.get('../db/consultas.php', {
                tabla: 'cuenta_usuario'
            }, (datos) => {
                const filas = JSON.parse(datos);
                let contador = 0;
                for (const fila of filas) {
                    if (fila.NoCuenta == $('#cuenta').val()) {
                        contador++;
                    }
                }
                if (contador) {
                    $.post('agregarTercero.php', {
                        cuenta: $('#cuenta').val(),
                        alias: $('#alias').val(),
                        monto: $('#monto').val(),
                        cantidad: $('#cantidad').val(),
                    }, (datos) => {
                        alert('Cuenta de tercero agregada');
                        console.log(datos);
                        window.location.reload();
                    });
                } else {
                    alert('La cuenta no existe');
                }
            });
        });
        $('#FormTransferencia').submit((evt) => {
            evt.preventDefault();
            $.get('../db/consultas.php', {
                tabla: 'usuario_tercero',
                condiciones: `iddestino = ${$('#cuentaT').val()} and idorigen = 1` // Cambiar por usuario conectado
            }, (data) => {
                const tercero = JSON.parse(data);
                if (tercero.monto_max < Number($('#montoT').val())) {
                    alert(
                        'El valor es mayor que el monto máximo permitido de transferencia para esta cuenta');
                    return;
                }
                if (tercero.cantidad_max <= tercero.transferencias) {
                    alert('Se ha superado el máximo de transferencias permitidas al mes');
                    return;
                }
                $.post('transferenciaTercero.php', {
                    cuenta: $('#cuentaT').val(),
                    origen: $('#cuentaO').val(),
                    monto: Number($('#montoT').val()),
                }, (data) => {
                    alert('Transferencia completada');
                    window.location.reload();
                });
            });
        });
    });
    </script>
</body>

</html>
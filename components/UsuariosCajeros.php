<?php
  	include('../db/conection.php');
    $cajeros = $conexion -> query("SELECT * from cajero");
    if ($cajeros) {
        if ($cajeros->num_rows != 0) {
          printf("<div class='table-responsive mt-2'><table class='table'><thead>
            <tr>
              <th scope='col'>#</th>
              <th scope='col'>Nombre</th>
              <th scope='col'>Usuario</th>
              <th scope='col'>Clave</th>
              <th scope='col'>Estado</th>
            </tr>
            </thead>
          <tbody>");
          while ($obj = $cajeros -> fetch_object()) {
            printf("<tr>
            <td class='td-idcajero'>%d</td>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            <td class='EstadoCajero' data-estado='%d'></td>
            </tr>", $obj -> idcajero, $obj -> nombre, $obj -> usuario, $obj -> clave, $obj -> estado);
          }
          printf("</tbody></table></div>");
        }
        else {
          printf("<p class='mt-2'>No existen usuarios cajeros</p>");
        }
      }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>





    <div id="Clientes">
        <table border="1">
            <thead>
                <tr>

                    <th>Pedido</th>
                    <th>Fecha pago</th>
                    <th>Monto</th>
                    <th>Metodo pago</th>
                    <th>Estado pago</th>
                    <th>Pedido pago</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $conn = $conn = include_once __DIR__ . '/../../libraries/Database.php';

                $query = "SELECT ID_PAGO, ID_PEDIDO, FECHA_PAGO, MONTO, DIRECCION, METODO_PAGO, ESTADO_PAGO, PAGO_PEDIDO FROM PAGOS";
                $statement = oci_parse($conn, $query);

                if (!oci_execute($statement)) {
                    $e = oci_error($statement);
                    die("Error al ejecutar la consulta: " . $e['message']);
                }


                $row_count = 0;
                while ($row = oci_fetch_array($statement, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    $row_count++;
                    echo "<tr>
                        
                        <td>{$row['ID_PAGO']}</td>
                        <td>{$row['ID_PEDIDO']}</td>
                        <td>{$row['FECHA_PAGO']}</td>
                        <td>{$row['MONTO']}</td>
                        <td>{$row['DIRECCION']}</td>
                        <td>{$row['METODO_PAGO']}</td>
                        <td>{$row['ESTADO_PAGO']}</td>
                        <td>{$row['PAGO_PEDIDO']}</td>
                        <td>
                            <button class=\"btn-editar\"><i class=\"fas fa-edit\"></i>  Editar</button>
                        </td>
                        <td>
                            
                            <form method=\"post\" action=\"/Tablas/PagosCtrl/delete.php\" onsubmit=\"return confirm('¿Estás seguro de eliminar el pago?');\">
                                    <input type=\"hidden\" name=\"id_pago\" value=\"{$row['ID_PAGO']}\">
                                    <button type=\"submit\" class=\"btn-eliminar\">Eliminar</button>
                                </form>
                        </td>

                      </tr>";
                }


                if ($row_count === 0) {
                    echo "<tr><td colspan='3'>No hay pagos registrados</td></tr>";
                }

                oci_free_statement($statement);
                oci_close($conn);
                ?>

            </tbody>

        </table>

    </div>

    <a href="/Tablas/PagosCtrl/AgregarPago.php">
        <button>Agregar Pago</button>
    </a>




</body>

</html>
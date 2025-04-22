<!DOCTYPE html>
<html lang="en">

<?php
include("head.php")
?>

<body>



    <header>
        <?php include("menu.php") ?>
    </header>


    <div class="jumbotron jumbotron-flud text-center">

        <div id="Facturas">
            <table border="1">
                <thead>
                    <tr>

                        <th>Pedido</th>
                        <th>Fecha factura</th>
                        <th>Total</th>
                        <th>Estado factura</th>
                        <th>Factura del pedido</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $conn = $conn = include_once __DIR__ . '/../../libraries/Database.php';



                    $query = "BEGIN pkg_facturas.obtener_facturas(:cursor); END;";
                    $statement = oci_parse($conn, $query);
                    $cursor = oci_new_cursor($conn);
                    oci_bind_by_name($statement, ':cursor', $cursor, -1, OCI_B_CURSOR);

                    if (!oci_execute($statement)) {
                        $e = oci_error($statement);
                        die("Error al ejecutar la consulta: " . $e['message']);
                    }

                    oci_execute($cursor);

                    $row_count = 0;
                    while ($row = oci_fetch_array($statement, OCI_ASSOC + OCI_RETURN_NULLS)) {
                        $row_count++;
                        echo "<tr>
                        
                        <td>{$row['PEDIDO']}</td>
                        <td>{$row['FECHA_FACTURA']}</td>
                        <td>{$row['TOTAL']}</td>
                        <td>{$row['ESTADO_FACTURA']}</td>
                        <td>
                            <form method=\"post\" action=\"/Tablas/ClientesCtrl/EditarCliente.php\" onsubmit=\"return confirm('¿Estás seguro de editar este usuario?');\">
                                    <input type=\"hidden\" name=\"id_cliente\" value=\"{$row['ID_CLIENTE']}\">
                                    <button type=\"submit\" class=\"btn-editar\">Editar</button>
                                </form>
                        </td>
                        <td>
                            
                            <form method=\"post\" action=\"/Tablas/ClientesCtrl/delete.php\" onsubmit=\"return confirm('¿Estás seguro de eliminar este usuario?');\">
                                    <input type=\"hidden\" name=\"id_cliente\" value=\"{$row['ID_CLIENTE']}\">
                                    <button type=\"submit\" class=\"btn-eliminar\">Eliminar</button>
                                </form>
                        </td>

                      </tr>";
                    }


                    if ($row_count === 0) {
                        echo "<tr><td colspan='3'>No hay facturas registradas</td></tr>";
                    }

                    oci_free_statement($statement);
                    oci_close($conn);
                    ?>

                </tbody>

            </table>



            <a href="/Tablas/FacturasCtrl/AgregarFactura.php">
                <button>Agregar Factura</button>
            </a>

        </div>
    </div>


    <footer>
        <?php include("footer.php") ?>
    </footer>

</body>

</html>
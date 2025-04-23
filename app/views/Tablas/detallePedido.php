<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>

<body>
<header>
    <?php include("menu.php"); ?>
</header>

<div class="jumbotron jumbotron-flud text-center">
    <div id="Detalles de Pedido">
        <table border="1">
            <thead>
                <tr>
                    <th>Id Pedido</th>
                    <th>Id Producto</th>
                    
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Eliminar</th>
                    <th>Editar</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $conn = include_once __DIR__ . '/../../libraries/Database.php';

                $query = "BEGIN pkg_detalle_pedido.obtener_detalles(:cursor); END;";
                $statement = oci_parse($conn, $query);
                $cursor = oci_new_cursor($conn);
                oci_bind_by_name($statement, ':cursor', $cursor, -1, OCI_B_CURSOR);

                if (!oci_execute($statement)) {
                    $e = oci_error($statement);
                    die("Error al ejecutar el paquete: " . $e['message']);
                }

                oci_execute($cursor);

                $row_count = 0;
                while ($row = oci_fetch_array($cursor, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    $row_count++;
                    echo "<tr>
                            <td>{$row['ID_PEDIDO']}</td>
                            <td>{$row['ID_PRODUCTO']}</td>
                            
                            <td>{$row['CANTIDAD']}</td>
                            <td>{$row['PRECIO_UNITARIO']}</td>
                            <td>{$row['SUBTOTAL']}</td>

                            <td>
                                <form method=\"post\" action=\"/Tablas/DetallesCtrl/EditarEvento.php\" onsubmit=\"return confirm('¿Estás seguro de editar este evento?');\">
                                    <input type=\"hidden\" name=\"id_detalle\" value=\"{$row['ID_DETALLE']}\">
                                    <button type=\"submit\" class=\"btn-editar\">Editar</button>
                                </form>
                            </td>
                            <td>
                                <form method=\"post\" action=\"/Tablas/DetallesCtrl/delete.php\" onsubmit=\"return confirm('¿Estás seguro de eliminar este evento?');\">
                                    <input type=\"hidden\" name=\"id_detalle\" value=\"{$row['ID_DETALLE']}\">
                                    <button type=\"submit\" class=\"btn-eliminar\">Eliminar</button>
                                </form>
                            </td>
                        </tr>";
                }

                if ($row_count === 0) {
                    echo "<tr><td colspan='6'>No hay eventos registrados</td></tr>";
                }

                oci_free_statement($statement);
                oci_free_statement($cursor);
                oci_close($conn);
                ?>
            </tbody>
        </table>

        <br>
        <a href="/Tablas/DetallesCtrl/AgregarDetalle.php">
            <button>Agregar Evento</button>
        </a>
    </div>
</div>

<footer>
    <?php include("footer.php"); ?>
</footer>

</body>
</html>

<!DOCTYPE html> 
<html lang="en">

<?php include("head.php") ?>

<body>
<header>
    <?php include("menu.php") ?>
</header>

<div class="jumbotron jumbotron-flud text-center">
    <div id="Inventario">
        <table border="1">
            <thead>
                <tr>
                    <th>Código Inventario</th>
                    <th>Nombre del Producto</th>
                    <th>Cantidad Disponible</th>
                    <th>Fecha de Actualización</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $conn = include_once __DIR__ . '/../../libraries/Database.php';

            $refCursor = oci_new_cursor($conn);

            $stmt = oci_parse($conn, 'BEGIN pkg_inventario.obtener_inventario(:cursor); END;');
            oci_bind_by_name($stmt, ':cursor', $refCursor, -1, OCI_B_CURSOR);

            if (!oci_execute($stmt)) {
                $e = oci_error($stmt);
                die("Error al ejecutar el procedimiento: " . $e['message']);
            }
            
            if (!oci_execute($refCursor)) {
                $e = oci_error($refCursor);
                die("Error al ejecutar el cursor: " . $e['message']);
            }

            $productos = [];
            $stmtProductos = oci_parse($conn, "SELECT id_producto, nombre FROM productos");
            oci_execute($stmtProductos);
            while ($prod = oci_fetch_array($stmtProductos, OCI_ASSOC + OCI_RETURN_NULLS)) {
                $productos[$prod['ID_PRODUCTO']] = $prod['NOMBRE'];
            }

            $row_count = 0;
            while ($row = oci_fetch_array($refCursor, OCI_ASSOC + OCI_RETURN_NULLS)) {
                $row_count++;
                $nombreProducto = isset($productos[$row['ID_PRODUCTO']]) ? $productos[$row['ID_PRODUCTO']] : 'Desconocido';

                echo "<tr>
                        <td>{$row['ID_INVENTARIO']}</td>
                        <td>{$nombreProducto}</td>
                        <td>{$row['CANTIDAD_DISPONIBLE']}</td>
                        <td>{$row['FECHA_ACTUALIZACION']}</td>
                      </tr>";
            }

            if ($row_count === 0) {
                echo "<tr><td colspan='4'>No hay inventario registrado</td></tr>";
            }

            oci_free_statement($stmt);
            oci_free_statement($refCursor);
            oci_free_statement($stmtProductos);
            oci_close($conn);
            ?>

            </tbody>
        </table>
    </div>
</div>

<footer>
<?php include("footer.php") ?>
</footer>

</body>
</html>

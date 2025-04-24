<?php
$conn = include_once __DIR__ . '/../../libraries/Database.php';

$query = "BEGIN pkg_facturas.obtener_facturas(:cursor); END;";
$statement = oci_parse($conn, $query);
$cursor = oci_new_cursor($conn);
oci_bind_by_name($statement, ':cursor', $cursor, -1, OCI_B_CURSOR);

oci_execute($statement);
oci_execute($cursor);
?>

<!DOCTYPE html>
<html lang="es">
<?php
include("head.php")
?>
<body>
<header>
        <?php include("menu.php") ?>
    </header>
    <div class="jumbotron jumbotron-flud text-center">
    <div id="Clientes">
    <h2>Facturas</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID Factura</th>
                <th>ID Pedido</th>
                <th>Fecha Factura</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = oci_fetch_array($cursor, OCI_ASSOC + OCI_RETURN_NULLS)) {
                echo "<tr>
                    <td>{$row['ID_FACTURA']}</td>
                    <td>{$row['ID_PEDIDO']}</td>
                    <td>{$row['FECHA_FACTURA']}</td>
                    <td>{$row['TOTAL']}</td>
                    <td>{$row['ESTADO_FACTURA']}</td>
                    <td>
                        <form method='post' action='/Tablas/FacturasCtrl/EditarFactura.php'>
                            <input type='hidden' name='id_factura' value='{$row['ID_FACTURA']}'>
                            <button type='submit'>Editar</button>
                        </form>
                    </td>
                    <td>
                        <form method='post' action='/Tablas/FacturasCtrl/delete.php' onsubmit=\"return confirm('¿Estás seguro de eliminar esta factura?');\">
                            <input type='hidden' name='id_factura' value='{$row['ID_FACTURA']}'>
                            <button type='submit'>Eliminar</button>
                        </form>
                    </td>
                </tr>";
            }
            oci_free_statement($statement);
            oci_free_statement($cursor);
            oci_close($conn);
            ?>
        </tbody>
    </table>
    <br>
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

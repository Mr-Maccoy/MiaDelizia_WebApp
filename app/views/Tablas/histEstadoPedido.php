<?php
$conn = include_once __DIR__ . '/../../libraries/Database.php';

$query = "BEGIN pkg_historial_estado.obtener_historiales(:cursor); END;";
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
    <h2>Historial de Estado de Pedidos</h2>
    <div id="Clientes">
    <table border="1">
        <thead>
            <tr>
                <th>ID Historial</th>
                <th>ID Pedido</th>
                <th>Estado</th>
                <th>Fecha Estado</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = oci_fetch_array($cursor, OCI_ASSOC + OCI_RETURN_NULLS)) {
                echo "<tr>
                    <td>{$row['ID_HISTORIAL']}</td>
                    <td>{$row['ID_PEDIDO']}</td>
                    <td>{$row['ESTADO']}</td>
                    <td>{$row['FECHA_ESTADO']}</td>
                    <td>
                        <form method='post' action='/Tablas/HistorialCtrl/EditarHistorial.php'>
                            <input type='hidden' name='id_historial' value='{$row['ID_HISTORIAL']}'>
                            <button type='submit'>Editar</button>
                        </form>
                    </td>
                    <td>
                        <form method='post' action='/Tablas/HistorialCtrl/delete.php' onsubmit=\"return confirm('¿Estás seguro de eliminar este registro?');\">
                            <input type='hidden' name='id_historial' value='{$row['ID_HISTORIAL']}'>
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
    </div>

    <br>
    <a href="/Tablas/HistorialCtrl/AgregarHistorial.php">
        <button>Agregar Historial</button>
    </a>
    </div>
    <footer>
<?php include("footer.php") ?>
</footer>
</body>
</html>

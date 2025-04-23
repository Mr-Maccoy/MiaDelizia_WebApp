<?php
$conn = include_once __DIR__ . '/../../libraries/Database.php';

$query = "BEGIN pkg_auditoria.obtener_auditoria(:cursor); END;";
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
    <h2>Registros de Auditoría</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tabla</th>
                <th>Operación</th>
                <th>ID Registro</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Detalle</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = oci_fetch_array($cursor, OCI_ASSOC + OCI_RETURN_NULLS)) {
                echo "<tr>
                    <td>{$row['ID_AUDITORIA']}</td>
                    <td>{$row['TABLA']}</td>
                    <td>{$row['OPERACION']}</td>
                    <td>{$row['ID_REGISTRO']}</td>
                    <td>{$row['USUARIO']}</td>
                    <td>{$row['FECHA_OPERACION']}</td>
                    <td>{$row['DETALLE']}</td>
                </tr>";
            }
            oci_free_statement($statement);
            oci_free_statement($cursor);
            oci_close($conn);
            ?>
        </tbody>
    </table>
    </div>
    <footer>
<?php include("footer.php") ?>
</footer>
</body>
</html>

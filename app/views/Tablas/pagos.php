
<?php
$conn = include_once __DIR__ . '/../../libraries/Database.php';

$query = "BEGIN pkg_pagos.obtener_pagos(:cursor); END;";
$statement = oci_parse($conn, $query);
$cursor = oci_new_cursor($conn);
oci_bind_by_name($statement, ':cursor', $cursor, -1, OCI_B_CURSOR);

oci_execute($statement);
oci_execute($cursor);
?>


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
    <div id="Pagos">
        <table border="1">
        <h2>Listado de Pagos</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID Pago</th>
                <th>ID Pedido</th>
                <th>Fecha Pago</th>
                <th>Monto</th>
                <th>Método</th>
                <th>Estado</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = oci_fetch_array($cursor, OCI_ASSOC + OCI_RETURN_NULLS)) {
                echo "<tr>
                    <td>{$row['ID_PAGO']}</td>
                    <td>{$row['ID_PEDIDO']}</td>
                    <td>{$row['FECHA_PAGO']}</td>
                    <td>{$row['MONTO']}</td>
                    <td>{$row['METODO_PAGO']}</td>
                    <td>{$row['ESTADO_PAGO']}</td>
                    <td>
                        <form method='post' action='/Tablas/PagoCtrl/EditarPago.php'>
                            <input type='hidden' name='id_pago' value='{$row['ID_PAGO']}'>
                            <button type='submit'>Editar</button>
                        </form>
                    </td>
                    <td>
                        <form method='post' action='/Tablas/PagoCtrl/delete.php' onsubmit=\"return confirm('¿Deseas eliminar este pago?');\">
                            <input type='hidden' name='id_pago' value='{$row['ID_PAGO']}'>
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
    <a href="/Tablas/PagoCtrl/AgregarPago.php">
        <button>Agregar Pago</button>
    </a>

    </div>

<footer>
<?php include("footer.php") ?>
</footer>

</body>

</html>
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
<div id="Pedidos">
    <table border="1">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>ID Cliente</th>
                <th>Fecha de Pedido</th>
                <th>Estado del Pedido</th>
                <th>Fecha de Entrega</th>
                <th>Tipo de Envío</th>
                <th>Monto Total</th>
                <th>Editar</th>
                <th>Eliminar</th>

            </tr>
        </thead>
        <tbody>

        <?php
        $conn = include_once __DIR__ . '/../../libraries/Database.php';

         $query = "BEGIN pkg_pedidos.obtener_pedidos(:cursor); END;";
         $statement = oci_parse($conn, $query);
        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($statement, ':cursor', $cursor, -1, OCI_B_CURSOR);
        
        if (!oci_execute($statement)) {
        $e = oci_error($statement);
        die("Error al ejecutar la consulta: " . $e['message']);
        }   
        oci_execute($cursor);
        
        $row_count = 0;

        while ($row = oci_fetch_array($cursor, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $row_count++;
            echo "<tr>

            <td>{$row['ID_PEDIDO']}</td>
            <td>{$row['ID_CLIENTE']}</td>
            <td>{$row['FECHA_PEDIDO']}</td>
            <td>{$row['ESTADO_PEDIDO']}</td>
            <td>{$row['FECHA_ENTREGA']}</td>
            <td>{$row['TIPO_ENVIO']}</td>
            <td>{$row['MONTO_TOTAL']}</td>
            <td>
  
 <form method=\"post\" action=\"/Tablas/PedidosCtrl/EditarPedido.php\" onsubmit=\"return confirm('¿Estás seguro de editar este pedido?');\">
<input type=\"hidden\" name=\"id_pedido\" value=\"{$row['ID_PEDIDO']}\">
<button type=\"submit\" class=\"btn-editar\">Editar</button>
</form>
</td>
<td>
<form method=\"post\" action=\"/Tablas/PedidosCtrl/delete.php\" onsubmit=\"return confirm('¿Estás seguro de eliminar este pedido?');\">


<input type=\"hidden\" name=\"id_pedido\" value=\"{$row['ID_PEDIDO']}\">
<button type=\"submit\" class=\"btn-eliminar\">Eliminar</button>
</form>
</td>
</tr>";
 }

if ($row_count === 0) {
echo "<tr><td colspan='9'>No hay pedidos registrados</td></tr>";
 }

 oci_free_statement($statement);
 oci_free_statement($cursor);
 oci_close($conn);
?>

                </tbody>
            </table>
        </div>

        <a href="/Tablas/PedidosCtrl/AgregarPedido.php">
            <button>Agregar Pedido</button>
        </a>
    </div>

    <footer>
        <?php include("footer.php") ?>
    </footer>

</body>

</html>

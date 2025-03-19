<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pedidos</title>
</head>
<body>
    
<div id="Pedidos">
    <table border="1">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Fecha del Pedido</th>
                <th>Estado</th>
                <th>Fecha de Entrega</th>
                <th>Tipo de Envío</th>
                <th>Monto Total</th>
            </tr>
        </thead>
        <tbody>

        <?php
        $conn = include_once __DIR__ . '/../../libraries/Database.php';

        $query = "SELECT C.NOMBRE AS CLIENTE, P.FECHA_PEDIDO, P.ESTADO_PEDIDO, 
                         P.FECHA_ENTREGA, P.TIPO_ENVIO, P.MONTO_TOTAL 
                  FROM PEDIDOS P
                  JOIN CLIENTES C ON P.ID_CLIENTE = C.ID_CLIENTE";

        $statement = oci_parse($conn, $query);

        if (!oci_execute($statement)) { 
            $e = oci_error($statement);
            die("Error al ejecutar la consulta: " . $e['message']);
        }

        $row_count = 0;
        while ($row = oci_fetch_array($statement, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $row_count++;
            echo "<tr>
                    <td>{$row['CLIENTE']}</td>
                    <td>{$row['FECHA_PEDIDO']}</td>
                    <td>{$row['ESTADO_PEDIDO']}</td>
                    <td>{$row['FECHA_ENTREGA']}</td>
                    <td>{$row['TIPO_ENVIO']}</td>
                    <td>{$row['MONTO_TOTAL']}</td>
                  </tr>";
        }

        if ($row_count === 0) {
            echo "<tr><td colspan='6'>No hay pedidos registrados</td></tr>";
        }

        oci_free_statement($statement); 
        oci_close($conn); 
        ?>

        </tbody>
    </table>
</div>

</body>
</html>
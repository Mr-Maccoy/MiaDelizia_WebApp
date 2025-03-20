<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
</head>

<body>

<div id="Inventario">
    <table border="1">
        <thead>
            <tr>
                <th>Código Inventario</th>
                <th>Nombre del Producto</th>
                <th>Cantidad</th>
                <th>Fecha de Ingreso</th>
            </tr>
        </thead>
        <tbody>

        <?php
        $conn = include_once __DIR__ . '/../../libraries/Database.php';

        $query = "SELECT I.ID_INVENTARIO, P.NOMBRE AS NOMBRE_PRODUCTO, I.CANTIDAD, I.FECHA_INGRESO
                  FROM INVENTARIO I
                  LEFT JOIN PRODUCTOS P ON I.ID_PRODUCTO = P.ID_PRODUCTO";

        $statement = oci_parse($conn, $query);

        if (!oci_execute($statement)) { 
            $e = oci_error($statement);
            die("Error al ejecutar la consulta: " . $e['message']);
        }

        $row_count = 0;
        while ($row = oci_fetch_array($statement, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $row_count++;
            echo "<tr>
                    <td>{$row['ID_INVENTARIO']}</td>
                    <td>{$row['NOMBRE_PRODUCTO']}</td>
                    <td>{$row['CANTIDAD']}</td>
                    <td>{$row['FECHA_INGRESO']}</td>
                  </tr>";
        }

        if ($row_count === 0) {
            echo "<tr><td colspan='4'>No hay inventario registrado</td></tr>";
        }

        oci_free_statement($statement); 
        oci_close($conn); 
        ?>

        </tbody>
    </table>
</div>

</body>
</html>

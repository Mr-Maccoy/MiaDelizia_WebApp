<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
</head>

<body>

<div id="Eventos">
    <table border="1">
        <thead>
            <tr>
                <th>Nombre del Evento</th>
                <th>Fecha</th>
                <th>Ubicación</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>

        <?php
        $conn = include_once __DIR__ . '/../../libraries/Database.php';

        $query = "SELECT NOMBRE_EVENTO, FECHA_EVENTO, UBICACION, DESCRIPCION FROM EVENTOS";
        $statement = oci_parse($conn, $query);

        if (!oci_execute($statement)) { 
            $e = oci_error($statement);
            die("Error al ejecutar la consulta: " . $e['message']);
        }

        $row_count = 0;
        while ($row = oci_fetch_array($statement, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $row_count++;
            echo "<tr>
                    <td>{$row['NOMBRE_EVENTO']}</td>
                    <td>{$row['FECHA_EVENTO']}</td>
                    <td>{$row['UBICACION']}</td>
                    <td>{$row['DESCRIPCION']}</td>
                  </tr>";
        }

        if ($row_count === 0) {
            echo "<tr><td colspan='4'>No hay eventos registrados</td></tr>";
        }

        oci_free_statement($statement); 
        oci_close($conn); 
        ?>

        </tbody>
    </table>
</div>
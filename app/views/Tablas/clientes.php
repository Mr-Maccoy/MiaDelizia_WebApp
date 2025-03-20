<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    




<div id="Clientes">
    <table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Direccion</th>
            <th>Tipo</th>
            <th>Fecha de Registro</th>
            <th>Nacimiento</th>
        </tr>
    </thead>
    <tbody>

    <?php
    $conn = $conn = include_once __DIR__ . '/../../libraries/Database.php';

    $query = "SELECT NOMBRE, TELEFONO, CORREO_ELECTRONICO, DIRECCION, TIPO_CLIENTE, FECHA_REGISTRO_CLIENTE, FECHA_NACIMIENTO FROM CLIENTES";
    $statement = oci_parse($conn, $query);

    if (!oci_execute($statement)) { 
        $e = oci_error($statement);
        die("Error al ejecutar la consulta: " . $e['message']);
    }


            $row_count = 0; 
            while ($row = oci_fetch_array($statement, OCI_ASSOC+OCI_RETURN_NULLS)) {
                $row_count++;
                echo "<tr>
                        <td>{$row['NOMBRE']}</td>
                        <td>{$row['TELEFONO']}</td>
                        <td>{$row['CORREO_ELECTRONICO']}</td>
                        <td>{$row['DIRECCION']}</td>
                        <td>{$row['TIPO_CLIENTE']}</td>
                        <td>{$row['FECHA_REGISTRO_CLIENTE']}</td>
                        <td>{$row['FECHA_NACIMIENTO']}</td>
                        <td>
                            <button class=\"btn-editar\"><i class=\"fas fa-edit\"></i>  Editar</button>
                        </td>
                        <td>
                            <button class=\"btn-eliminar\"><i class=\"fas fa-edit\"></i>  Eliminar</button>
                        </td>
                      </tr>";
            }

            
            if ($row_count === 0) {
                echo "<tr><td colspan='3'>No hay usuarios registrados</td></tr>";
            }

    oci_free_statement($statement); 
    oci_close($conn); 
    ?>

    </tbody>

</table>

    </div>

    <button>Agregar</button>

</body>
</html>
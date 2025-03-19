<!DOCTYPE html>
<html lang="en">

<?php
include("inc/head.php")
?>

<body>

    <header>
        <a href="AgregarCliente.php">Agregar Cliente</a>
    </header>

    <div id="Users">
        <table border="1">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Salario</th>
                </tr>
            </thead>
            <tbody>



                <?
                $conn = include_once __DIR__ . '/../libraries/Database.php';

                $query = "SELECT FIRST_NAME, LAST_NAME, SALARY FROM HR.EMPLOYEES";
                $statement = oci_parse($conn, $query);

                if (!oci_execute($statement)) {
                    $e = oci_error($statement);
                    die("Error al ejecutar la consulta: " . $e['message']);
                }


                $row_count = 0;
                while ($row = oci_fetch_array($statement, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    $row_count++;
                    echo "<tr>
                       <td>{$row['FIRST_NAME']}</td>
                        <td>{$row['LAST_NAME']}</td>
                        <td>{$row['SALARY']}</td>
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

</body>

</html>
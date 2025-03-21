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
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $conn = $conn = include_once __DIR__ . '/../../libraries/Database.php';

                $query = "SELECT ID_CLIENTE, NOMBRE, TELEFONO, CORREO_ELECTRONICO, DIRECCION, TIPO_CLIENTE, FECHA_REGISTRO_CLIENTE, FECHA_NACIMIENTO FROM CLIENTES";
                $statement = oci_parse($conn, $query);

                if (!oci_execute($statement)) {
                    $e = oci_error($statement);
                    die("Error al ejecutar la consulta: " . $e['message']);
                }


                $row_count = 0;
                while ($row = oci_fetch_array($statement, OCI_ASSOC + OCI_RETURN_NULLS)) {
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
                            <form method=\"post\" action=\"/Tablas/ClientesCtrl/EditarCliente.php\" onsubmit=\"return confirm('¿Estás seguro de editar este usuario?');\">
                                    <input type=\"hidden\" name=\"id_cliente\" value=\"{$row['ID_CLIENTE']}\">
                                    <button type=\"submit\" class=\"btn-editar\">Editar</button>
                                </form>
                        </td>
                        <td>
                            
                            <form method=\"post\" action=\"/Tablas/ClientesCtrl/delete.php\" onsubmit=\"return confirm('¿Estás seguro de eliminar este usuario?');\">
                                    <input type=\"hidden\" name=\"id_cliente\" value=\"{$row['ID_CLIENTE']}\">
                                    <button type=\"submit\" class=\"btn-eliminar\">Eliminar</button>
                                </form>
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
    </div>

    <a href="/Tablas/ClientesCtrl/AgregarCliente.php">
        <button>Agregar Cliente</button>
    </a>


    <footer>
<?php include("footer.php") ?>
</footer>

</body>

</html>
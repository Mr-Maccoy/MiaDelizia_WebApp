<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>





    <div id="Categorias">
        <table border="1">
            <thead>
                <tr>

                    <th>Nombre</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $conn = $conn = include_once __DIR__ . '/../../libraries/Database.php';

                $query = "SELECT ID_CATEGORIA,NOMBRE_CATEGORIA,DESCRIPCION_CATEGORIA  FROM CATEGORIAS";
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
                        <td>{$row['DESCRIPCION']}</td>
                        <td>
                            <button class=\"btn-editar\"><i class=\"fas fa-edit\"></i>  Editar</button>
                        </td>
                        <td>
                            
                            <form method=\"post\" action=\"/Tablas/CategoriasCtrl/delete.php\" onsubmit=\"return confirm('¿Estás seguro de eliminar esta categoria?');\">
                                    <input type=\"hidden\" name=\"id_categoria\" value=\"{$row['ID_CATEGORIA']}\">
                                    <button type=\"submit\" class=\"btn-eliminar\">Eliminar</button>
                                </form>
                        </td>

                      </tr>";
                }


                if ($row_count === 0) {
                    echo "<tr><td colspan='3'>No hay categorias registradas</td></tr>";
                }

                oci_free_statement($statement);
                oci_close($conn);
                ?>

            </tbody>

        </table>

    </div>

    <a href="/Tablas/CategoriasCtrl/AgregarCategoria.php">
        <button>Agregar Categoria</button>
    </a>




</body>

</html>
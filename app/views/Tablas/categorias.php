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
    <div id="Categorias">
        <table border="1">
            <thead>
                <tr>

                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $conn = include_once __DIR__ . '/../../libraries/Database.php';

                $query = "BEGIN pkg_categorias.obtener_categorias(:cursor); END;";
                $statement = oci_parse($conn, $query);
                $cursor = oci_new_cursor($conn);
                oci_bind_by_name($statement, ':cursor', $cursor, -1, OCI_B_CURSOR);


                if (!oci_execute($statement)) {
                    $e = oci_error($statement);
                    die("Error al ejecutar la consulta: " . $e['message']);
                }
                oci_execute($cursor);


                $row_count = 0;
                while ($row = oci_fetch_array($statement, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    $row_count++;
                    echo "<tr>
                        
                        <td>{$row['nombre_categoria']}</td>
                        <td>{$row['descripcion_categoria']}</td>
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
                oci_free_statement($cursor);
                oci_close($conn);
                ?>

            </tbody>

        </table>

    </div>

    <a href="/Tablas/CategoriasCtrl/AgregarCategoria.php">
        <button>Agregar Categoria</button>
    </a>

            </div>
    <footer>
<?php include("footer.php") ?>
</footer>

</body>

</html>
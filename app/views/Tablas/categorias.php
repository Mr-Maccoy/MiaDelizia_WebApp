
<?php
// Visualización: categorias.php
$conn = include_once __DIR__ . '/../../libraries/Database.php';

$query = "BEGIN pkg_categorias.obtener_categorias(:cursor); END;";
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
    <div id="Categorias">
    <h2>Listado de Categorías</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = oci_fetch_array($cursor, OCI_ASSOC + OCI_RETURN_NULLS)) {
                echo "<tr>
                    <td>{$row['ID_CATEGORIA']}</td>
                    <td>{$row['NOMBRE_CATEGORIA']}</td>
                    <td>{$row['DESCRIPCION_CATEGORIA']}</td>
                    <td>
                        <form method='post' action='/Tablas/CategoriasCtrl/EditarCategoria.php'>
                            <input type='hidden' name='id_categoria' value='{$row['ID_CATEGORIA']}'>
                            <button type='submit'>Editar</button>
                        </form>
                    </td>
                    <td>
                        <form method='post' action='/Tablas/CategoriasCtrl/delete.php' onsubmit=\"return confirm('¿Eliminar esta categoría?');\">
                            <input type='hidden' name='id_categoria' value='{$row['ID_CATEGORIA']}'>
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
    <a href="/Tablas/CategoriasCtrl/AgregarCategoria.php">
        <button>Agregar Categoría</button>
    </a>

            </div>
    <footer>
<?php include("footer.php") ?>
</footer>

</body>

</html>
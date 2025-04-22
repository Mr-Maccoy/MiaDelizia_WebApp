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

<div id="Productos">
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Disponibilidad</th>
                <th>Categoría</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>

        <?php
        $conn = include_once __DIR__ . '/../../libraries/Database.php';

        $query = "BEGIN pkg_productos.obtener_productos(:cursor); END;";
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
            <td>{$row['NOMBRE']}</td>
            <td>{$row['DESCRIPCION']}</td>
            <td>{$row['PRECIO']}</td>
            <td>{$row['DISPONIBILIDAD']}</td>
            <td>{$row['ID_CATEGORIA']}</td>
            <td>


            <form method=\"post\" action=\"/Tablas/ProductosCtrl/EditarProducto.php\" onsubmit=\"return confirm('¿Estás seguro de editar este producto?');\">
            <input type=\"hidden\" name=\"id_producto\" value=\"{$row['ID_PRODUCTO']}\">
            <button type=\"submit\" class=\"btn-editar\">Editar</button>
            </form>
            </td>
            <td>


            <form method=\"post\" action=\"/Tablas/ProductosCtrl/delete.php\" onsubmit=\"return confirm('¿Estás seguro de eliminar este producto?');\">
            <input type=\"hidden\" name=\"id_producto\" value=\"{$row['ID_PRODUCTO']}\">
            <button type=\"submit\" class=\"btn-eliminar\">Eliminar</button>
            </form>
            </td>
            </tr>";
             }

            if ($row_count === 0) {
                echo "<tr><td colspan='7'>No hay productos registrados</td></tr>";
                 }
                
                oci_free_statement($statement);
                oci_free_statement($cursor);
                oci_close($conn);
                ?>
                
                </tbody>
                </table>
                </div>

                <a href="/Tablas/ProductosCtrl/AgregarProducto.php">
<button>Agregar Producto</button>
</a>
</div>

<footer>
<?php include("footer.php") ?>
</footer>

</body>

</html>
                         
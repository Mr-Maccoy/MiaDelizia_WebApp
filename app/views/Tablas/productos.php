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
            </tr>
        </thead>
        <tbody>

        <?php
        $conn = include_once __DIR__ . '/../../libraries/Database.php';

        $query = "SELECT P.NOMBRE, P.DESCRIPCION, P.PRECIO, 
                         CASE P.DISPONIBILIDAD WHEN 'S' THEN 'Sí' ELSE 'No' END AS DISPONIBILIDAD, 
                         C.NOMBRE_CATEGORIA 
                  FROM PRODUCTOS P
                  LEFT JOIN CATEGORIAS C ON P.ID_CATEGORIA = C.ID_CATEGORIA";

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
                    <td>{$row['DESCRIPCION']}</td>
                    <td>{$row['PRECIO']}</td>
                    <td>{$row['DISPONIBILIDAD']}</td>
                    <td>{$row['NOMBRE_CATEGORIA']}</td>
                  </tr>";
        }

        if ($row_count === 0) {
            echo "<tr><td colspan='5'>No hay productos registrados</td></tr>";
        }

        oci_free_statement($statement); 
        oci_close($conn); 
        ?>

        </tbody>
    </table>
</div>
    </div>
    <footer>
<?php include("footer.php") ?>
</footer>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
</head>
<body>
    <h1>Editar Categoría</h1>

    <?php
    $conn = include_once __DIR__ . '/../../libraries/Database.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT NOMBRE_CATEGORIA, DESCRIPCION_CATEGORIA FROM CATEGORIAS WHERE ID_CATEGORIA = :id";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ':id', $id);

        if (!oci_execute($statement)) {
            $e = oci_error($statement);
            die("Error al obtener la categoría: " . $e['message']);
        }

        $categoria = oci_fetch_assoc($statement);
        oci_free_statement($statement);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        $query = "UPDATE CATEGORIAS SET NOMBRE_CATEGORIA = :nombre, DESCRIPCION_CATEGORIA = :descripcion WHERE ID_CATEGORIA = :id";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ':id', $id);
        oci_bind_by_name($statement, ':nombre', $nombre);
        oci_bind_by_name($statement, ':descripcion', $descripcion);

        if (!oci_execute($statement)) {
            $e = oci_error($statement);
            die("Error al actualizar la categoría: " . $e['message']);
        }

        echo "Categoría actualizada exitosamente.";
        oci_free_statement($statement);
        oci_close($conn);
    }
    ?>

    <form action="EditarCategoria.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $categoria['NOMBRE_CATEGORIA']; ?>" required>
        <br>
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" value="<?php echo $categoria['DESCRIPCION_CATEGORIA']; ?>" required>
        <br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
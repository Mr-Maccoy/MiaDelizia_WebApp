<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Categoría</title>
</head>
<body>
    <h1>Agregar Categoría</h1>
    <form action="AgregarCategoria.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" required>
        <br>
        <button type="submit">Agregar</button>
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = include_once __DIR__ . '/../../libraries/Database.php';
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        $query = "INSERT INTO CATEGORIAS (NOMBRE_CATEGORIA, DESCRIPCION_CATEGORIA) VALUES (:nombre, :descripcion)";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ':nombre', $nombre);
        oci_bind_by_name($statement, ':descripcion', $descripcion);

        if (!oci_execute($statement)) {
            $e = oci_error($statement);
            die("Error al agregar la categoría: " . $e['message']);
        }

        echo "Categoría agregada exitosamente.";
        oci_free_statement($statement);
        oci_close($conn);
    }
    ?>
</body>
</html>
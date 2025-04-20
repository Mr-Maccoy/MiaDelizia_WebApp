<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_evento = (int)$_POST['id_evento'];

$query = "BEGIN pkg_eventos.obtener_evento_por_id(:id_evento, :cursor); END;";
$statement = oci_parse($conn, $query);

$cursor = oci_new_cursor($conn);

oci_bind_by_name($statement, ':id_evento', $id_evento, -1, SQLT_INT);
oci_bind_by_name($statement, ':cursor', $cursor, -1, OCI_B_CURSOR);

oci_execute($statement);

oci_execute($cursor);
$row = oci_fetch_assoc($cursor);

oci_free_statement($statement);
oci_free_statement($cursor);
oci_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento</title>
</head>

<body>
    <div class="Edit">
        <h2>Editar Evento</h2>
        <form action="update_evento.php" method="post">
            <input type="hidden" name="id_evento" value="<?= $id_evento ?>">

            <label>Nombre del Evento:</label>
            <input type="text" name="nombre_evento" value="<?= $row['NOMBRE_EVENTO'] ?>" required><br><br>

            <label>Fecha del Evento:</label>
            <input type="date" name="fecha_evento" value="<?= date('Y-m-d', strtotime($row['FECHA_EVENTO'])) ?>" required><br><br>

            <label>Ubicación:</label>
            <input type="text" name="ubicacion" value="<?= $row['UBICACION'] ?>"><br><br>

            <label>Descripción:</label>
            <input type="text" name="descripcion" value="<?= $row['DESCRIPCION'] ?>"><br><br>

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>

</html>

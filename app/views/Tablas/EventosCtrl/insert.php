<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_evento = $_POST['nombre_evento'];
    $fecha_evento = $_POST['fecha_evento']; 
    $ubicacion = $_POST['ubicacion'];
    $descripcion = $_POST['descripcion'];

    $query = "BEGIN pkg_eventos.insertar_evento(:nombre, TO_DATE(:fecha, 'YYYY-MM-DD'), :ubicacion, :descripcion); END;";
    $stmt = oci_parse($conn, $query);

    oci_bind_by_name($stmt, ':nombre', $nombre_evento);
    oci_bind_by_name($stmt, ':fecha', $fecha_evento);
    oci_bind_by_name($stmt, ':ubicacion', $ubicacion);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);

    if (oci_execute($stmt)) {
        oci_commit($conn);
        echo "Registro agregado correctamente.";
        header("Location: /../Tablas/eventos.php?success=1");
    } else {
        $e = oci_error($stmt);
        echo "Error al agregar el evento: " . $e['message'];
    }

    oci_free_statement($stmt);
    oci_close($conn);
}
?>

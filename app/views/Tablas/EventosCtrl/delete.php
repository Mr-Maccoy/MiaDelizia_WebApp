<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_evento = $_POST['id_evento'];

    // Hcaer llamado del procedimiento del paquete //
    $query = "BEGIN pkg_eventos.eliminar_evento(:id_evento); END;";
    $stmt = oci_parse($conn, $query);

    oci_bind_by_name($stmt, ':id_evento', $id_evento, -1, SQLT_INT);

    if (oci_execute($stmt)) {
        echo "Evento eliminado correctamente.";
        header("Location: /../Tablas/eventos.php?success=1");
    } else {
        $e = oci_error($stmt);
        echo "❌ Error al eliminar el evento: " . $e['message'];
    }

    oci_free_statement($stmt);
    oci_close($conn);
}
?>


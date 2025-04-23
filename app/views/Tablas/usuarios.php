<?php
// Visualización de usuarios
$conn = include_once __DIR__ . '/../../libraries/Database.php';

$query = "BEGIN pkg_usuarios.obtener_usuarios(:cursor); END;";
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
    <div class="container">
    <h1 class="display-3">Usuarios Registrados</h1>
    
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Rol</th>
                <th>Nombre de Usuario</th>
                <th>Email</th>
                <th>Creado</th>
                <th>Modificado</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = oci_fetch_array($cursor, OCI_ASSOC + OCI_RETURN_NULLS)) {
                echo "<tr>
                    <td>{$row['ID_USUARIO']}</td>
                    <td>{$row['NOMBRE_ROL']}</td>
                    <td>{$row['NOMBRE_USUARIO']}</td>
                    <td>{$row['EMAIL']}</td>
                    <td>{$row['FECHA_CREACION']}</td>
                    <td>{$row['FECHA_MODIFICACION']}</td>
                    <td>
                        <form method='post' action='/Tablas/UsuariosCtrl/EditarUsuario.php'>
                            <input type='hidden' name='id_usuario' value='{$row['ID_USUARIO']}'>
                            <button type='submit'>Editar</button>
                        </form>
                    </td>
                    <td>
                        <form method='post' action='/Tablas/UsuariosCtrl/delete.php' onsubmit=\"return confirm('¿Eliminar este usuario?');\">
                            <input type='hidden' name='id_usuario' value='{$row['ID_USUARIO']}'>
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
    <a href="/Tablas/UsuariosCtrl/AgregarUsuario.php">
        <button>Agregar Usuario</button>
    </a>
    </div>
    </div>

    <footer>
<?php include("footer.php") ?>
</footer>
</body>
</html>
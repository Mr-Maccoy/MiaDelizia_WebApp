<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="Insert">
        <h2>Agregar Registros</h2>
        <form action="insert.php" method="post">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br><br>

        <label for="correo">Correo:</label>
        <input type="text" name="correo" required><br><br>

        <label for="telefono">Telefono:</label>
        <input type="number" name="telefono" required><br><br>

        <input type="submit" value="Agregar">

        </form>
    </div>
</body>
</html>
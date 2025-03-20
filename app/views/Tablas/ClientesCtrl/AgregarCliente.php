<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="Insert">
        <h2>Agregar Cliente</h2>
        <form action="insert.php" method="post">

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required><br><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" required><br><br>

            <label for="correo">Correo Electrónico:</label>
            <input type="email" name="correo" id="correo" required><br><br>

            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion" required><br><br>

            <label for="tipo">Tipo de Cliente:</label>
            <select name="tipo" id="tipo" required>
                <option value="NUEVO">Nuevo</option>
                <option value="RECURRENTE">Recurrente</option>
                <option value="VIP">VIP</option>
            </select><br><br>

            <label for="nacimiento">Fecha de Nacimiento:</label>
            <input type="date" name="nacimiento" id="nacimiento" required><br><br>

            <button type="submit">Agregar Cliente</button>
        </form>






    </div>
</body>

</html>
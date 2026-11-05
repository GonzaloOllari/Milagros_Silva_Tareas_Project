<?php 

require "conexion.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
</head>
<body>
    <form action="crear_usuario.php" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="usuario" placeholder="Simona" maxlength="80">

        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" placeholder="Rodriguez" maxlength="80">

        <label for="dni">DNI</label>
        <input type="text" id="dni" name="dni" inputmode="numeric" pattern="[0-9]{7,8}" maxlength="8" placeholder="23463778" required>
        
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" maxlength="254" placeholder="Simona123@gmail.com" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>

        <label for="reingreso_contrasena">Reingresar Contraseña:</label>
        <input type="password" id="reingreso_contrasena" name="reingreso_contrasena" required>

        <button type="submit">Registrar estudiante</button>>
    </form>
</body>
</html>
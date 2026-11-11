<?php
require_once __DIR__.'/conexion.php';

$errores=[];
$mensaje='';
$usuario='';
$contrasena='';
$reingreso_contrasena='';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $contrasena = trim($_POST['contrasena'] ?? '');
    $reingreso_contrasena = trim($_POST['reingreso_contrasena'] ?? '');

if ($usuario === '') {
    $errores[] = 'El usuario es obligatorio.';
}
if ($contrasena === '') {
    $errores[] = 'La contraseña es obligatoria.';
}
if ($reingreso_contrasena === '') {
    $errores[] = 'Debe reingresar la contraseña.';
}
if ($contrasena !== '' && $reingreso_contrasena !== '' && $contrasena !== $reingreso_contrasena) {
    $errores[] = 'Las contraseñas no coinciden.';
}
if ($contrasena === '' || !preg_match('/^[0-9]{7,8}$/', $contrasena)) {
    $errores[] = 'La contraseña debe tener mínimo 8 números.';
}

if (empty($errores)) {
    try {
        $sql = 'INSERT INTO estudiantes (usuario, contrasena, reingreso_contrasena) VALUES (:usuario, :contrasena, :reingreso_contrasena)';
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            'usuario' => $usuario,
            'contrasena' => $contrasena,
            'reingreso_contrasena' => $reingreso_contrasena,
        ]);
            $mensaje = 'Usuario registrado correctamente.';
// limpiar variables para evitar reenvíos visibles
            $usuario = ''; 
            $contrasena = '';
            $reingreso_contrasena = '';

        }catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $errores[] = 'Ese nombre de usuario ya está registrado.';
            } else {
                error_log($e->getMessage());
                $errores[] = 'No existe una cuenta con esos datos, registrarse';
            }
        }
    }
}

function escapar(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Iniciar Sesión</h2>

    <!-- Mensaje de éxito -->
    <?php if ($mensaje !== ''): ?>
        <p class="mensaje"><?= escapar($mensaje) ?></p>
    <?php endif; ?>

    <!-- Lista de errores -->
    <?php if (!empty($errores)): ?>
        <ul class="errores">
            <?php foreach ($errores as $error): ?>
                <li><?= escapar($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

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

</body>
</html>
<?php
session_start();
require "conexion.php";

if (isset($_SESSION['usuario_id'])) {
    header("Location: dashboard.php");
    exit;
}

$errores  = [];
$nombre   = "";
$apellido = "";
$correo   = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre   = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $correo   = trim($_POST['correo'] ?? '');
    $password = $_POST['password'] ?? '';
    $repetir  = $_POST['repetir'] ?? '';

    if ($nombre === '')   $errores[] = "El nombre es obligatorio.";
    if ($apellido === '') $errores[] = "El apellido es obligatorio.";
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) $errores[] = "Ingresá un correo válido.";

    if (strlen($password) < 8
        || !preg_match('/[A-Z]/', $password)
        || !preg_match('/[a-z]/', $password)
        || !preg_match('/[0-9]/', $password)
        || !preg_match('/[^A-Za-z0-9]/', $password)) {
        $errores[] = "La contraseña debe tener mínimo 8 caracteres, mayúscula, minúscula, número y símbolo.";
    }
    if ($password !== $repetir) $errores[] = "Las contraseñas no coinciden.";

    if (empty($errores)) {
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);

        if ($stmt->fetch()) {
            $errores[] = "Ya existe una cuenta con ese correo.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare(
                "INSERT INTO usuarios (nombre, apellido, correo, password) VALUES (?, ?, ?, ?)"
            );
            $stmt->execute([$nombre, $apellido, $correo, $hash]);

            header("Location: index.php?registrado=1");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="card">
        <h1>Crear Cuenta</h1>

        <?php foreach ($errores as $e): ?>
            <p class="alerta alerta-error"><?= htmlspecialchars($e) ?></p>
        <?php endforeach; ?>

        <form id="formRegistro" action="register.php" method="POST" novalidate>
            <div class="campo">
                <input type="text" id="nombre" name="nombre" placeholder="Nombre"
                       value="<?= htmlspecialchars($nombre) ?>" required>
                <small class="msg-error" id="errorNombre"></small>
            </div>

            <div class="campo">
                <input type="text" id="apellido" name="apellido" placeholder="Apellido"
                       value="<?= htmlspecialchars($apellido) ?>" required>
                <small class="msg-error" id="errorApellido"></small>
            </div>

            <div class="campo">
                <input type="email" id="correo" name="correo" placeholder="Correo @gmail.com"
                       value="<?= htmlspecialchars($correo) ?>" required>
                <small class="msg-error" id="errorCorreo"></small>
            </div>

            <div class="campo">
                <input type="password" id="password" name="password" placeholder="Contraseña" required>
                <small class="msg-error" id="errorPassword"></small>
            </div>

            <div class="campo">
                <input type="password" id="repetir" name="repetir" placeholder="Repetir contraseña" required>
                <small class="msg-error" id="errorRepetir"></small>
            </div>

            <button type="submit">Crear Cuenta</button>
        </form>

        <div class="opciones">
            <a href="index.php">¿Ya tenés cuenta? Iniciar sesión</a>
        </div>
    </main>

    <script src="js/register.js"></script>
</body>
</html>